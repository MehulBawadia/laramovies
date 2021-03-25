<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index()
    {
        session()->forget(['searchResults', 'formData']);

        $genres = $this->genres();

        return view('search', compact('genres'));
    }

    public function search()
    {
        session()->forget(['formData', 'searchResults']);

        $formData = request()->all();

        $genres = $this->genres();

        $searchUrl = config('services.tmdb.base_url') . '/search/' . $formData['movie_or_tv'];

        $append = "";
        if ($formData['movie_or_tv'] == 'movie') {
            $append = '&region='.$formData['movie_or_tv'];
        }

        $searchResults = Http::withToken(config('services.tmdb.token'))
                            ->get($searchUrl . '?query=' . $formData['query'] . $append)
                            ->json()['results'];

        $results = collect($searchResults)->filter(function ($res) use ($formData, $genres) {
            if ($formData['movie_or_tv'] == 'tv' && isset($res['origin_country'][0])) {
                return strtolower($res['origin_country'][0]) == strtolower($formData['country']);
            }

            return $res;
        });

        if ($formData['genre'] != null) {
            $results = $results->filter(function ($res) use ($formData) {
                return in_array($formData['genre'], $res['genre_ids']);
            });
        }

        $results = $this->format($results);

        session([
            'formData' => $formData,
            'searchResults' => $results
        ]);

        return view('search', compact('genres'));
    }

    private function genres()
    {
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/genre/movie/list')
                            ->json()['genres'];

        $genres = collect($genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        $tvGenres = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/genre/tv/list')
                            ->json()['genres'];

        $tvGenres = collect($tvGenres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return $genres->merge($tvGenres)->unique()->sort();
    }

    private function format($tv)
    {
        return collect($tv)->map(function ($show) {
            $formattedGenres = collect($show['genre_ids'])->mapWithKeys(function ($genre) {
                return [$genre => $this->genres(session('formData')['movie_or_tv'])->get($genre)];
            });

            $releaseDate = $show['first_air_date'] ?? $show['release_date'];

            return collect($show)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500' . $show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($releaseDate)->format('M d, Y'),
                'genres' => $formattedGenres->implode(', '),
            ]);
        });
    }
}
