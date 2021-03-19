<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesListModel;
use Illuminate\Support\Facades\Http;
use App\ViewModels\SingleMovieViewModel;

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

        $viewModel = new MoviesListModel($popularMovies, $nowPlayingMovies, $genres);

        return view('welcome', $viewModel);
    }

    public function show($movieId)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.base_url') . '/movie/' . $movieId . '?append_to_response=credits,videos,images')
                    ->json();

        $viewModel = new SingleMovieViewModel($movie);

        return view('show', $viewModel);
    }
}
