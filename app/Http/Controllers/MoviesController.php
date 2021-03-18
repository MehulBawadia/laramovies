<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/movie/popular')
                            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/movie/now_playing')
                            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/genre/movie/list')
                            ->json()['genres'];

        $genres = collect($genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return view('welcome', compact('popularMovies', 'nowPlayingMovies', 'genres'));
    }

    public function show($movieId)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.base_url') . '/movie/' . $movieId . '?append_to_response=credits,videos,images')
                    ->json();

        return view('show', compact('movie'));
    }
}
