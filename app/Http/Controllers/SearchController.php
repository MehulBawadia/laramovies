<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function index($pageNumber = 1)
    {
        abort_if($pageNumber > 500, 204);

        session()->forget(['searchResults', 'formData']);

        $searchResults = Cache::remember('defaultResults', 5, function () {
            return Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.base_url') . '/discover/tv?with_original_language=ko&first_air_date_year=' . date('Y'))
                    ->json()['results'];
        });

        $genres = $this->genres();
        $searchResults = $this->format($searchResults);

        return view('search', compact('genres', 'searchResults', 'pageNumber'));
    }

    public function searchOld()
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

    public function search($pageNumber = 1)
    {
        abort_if($pageNumber > 500, 204);

        if (! session('formData')) {
            session(['formData' => request()->all()]);
        }

        $formData = session('formData');

        if ($formData['movie_or_tv'] == 'movie') {
            $apiUrlParams = '&release_date_year=' . $formData['year'];
        }

        if ($formData['movie_or_tv'] == 'tv') {
            $apiUrlParams = '&first_air_date_year=' . $formData['year'];
        }

        $apiUrlParams .= '&with_genres=' . $formData['genre'];

        $apiUrl = config('services.tmdb.base_url') . '/discover/'. $formData['movie_or_tv'] .'?with_original_language='.$formData['country'];
        $apiUrl .= $apiUrlParams;

        $search = Http::withToken(config('services.tmdb.token'))
            ->get($apiUrl . '&page=' . $pageNumber)
            ->json()['results'];

        $searchResults = $this->format($search);

        $genres = $this->genres();

        return view('search', compact('searchResults', 'genres', 'pageNumber'));
    }

    private function genres()
    {
        Cache::remember('tvGenres', 5, function () {
            $genres = Http::withToken(config('services.tmdb.token'))
                        ->get(config('services.tmdb.base_url') . '/genre/tv/list')
                        ->json()['genres'];

            return collect($genres)->mapWithKeys(function ($genre) {
                return [$genre['id'] => $genre['name']];
            });
        });

        Cache::remember('movieGenres', 5, function () {
            $genres = Http::withToken(config('services.tmdb.token'))
                        ->get(config('services.tmdb.base_url') . '/genre/movie/list')
                        ->json()['genres'];

            return collect($genres)->mapWithKeys(function ($genre) {
                return [$genre['id'] => $genre['name']];
            });
        });

        $genres = cache('movieGenres');
        $tvGenres = cache('tvGenres');

        return $genres->union($tvGenres)->sort();
    }

    private function format($tv)
    {
        return collect($tv)->map(function ($show) {
            $formattedGenres = collect($show['genre_ids'])->mapWithKeys(function ($genre) {
                return [$genre => $this->genres(session('formData')['movie_or_tv'])->get($genre)];
            });

            $releaseDate = $show['first_air_date'] ?? $show['release_date'];

            return collect($show)->merge([
                'poster_path' => $show['poster_path']
                                    ? 'https://image.tmdb.org/t/p/w500' . $show['poster_path']
                                    : 'https://via.placeholder.com/500x750',
                'vote_average' => $show['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($releaseDate)->format('M d, Y'),
                'genres' => $formattedGenres->implode(', '),
            ]);
        });
    }
}
