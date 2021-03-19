<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {
        // return collect($tv)->map(function ($show) {
        //     return $show;
        // })->dump();
        return collect($tv)->map(function ($tvShow) {
            $formattedGenres = collect($tvShow['genre_ids'])->mapWithKeys(function ($genre) {
                return [$genre => $this->genres()->get($genre)];
            });

            return collect($tvShow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $formattedGenres->implode(', '),
            ])->only([
                'id', 'poster_path', 'vote_average', 'first_air_date', 'genre_ids', 'name', 'genres', 'overview',
            ]);
        })->dump();
    }
}
