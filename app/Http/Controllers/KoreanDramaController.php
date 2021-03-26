<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class KoreanDramaController extends Controller
{
    public function index($pageNumber = 1)
    {
        abort_if($pageNumber > 500, 204);

        $searchResults = Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.base_url') . '/discover/tv?with_original_language=ko&page=' . $pageNumber)
                    ->json()['results'];

        $genres = $this->genres();
        $searchResults = $this->format($searchResults);

        return view('korean-drama.index', compact('genres', 'searchResults', 'pageNumber'));
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
                return [$genre => $this->genres()->get($genre)];
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
