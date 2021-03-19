<?php

namespace App\Http\Controllers;

use App\ViewModels\TvViewModel;
use Illuminate\Support\Facades\Http;
use App\ViewModels\SingleTvViewModel;

class TVController extends Controller
{
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/tv/popular')
                            ->json()['results'];

        $topRatedTv = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/tv/top_rated')
                            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/genre/tv/list')
                            ->json()['genres'];

        $viewModel = new TvViewModel($popularTv, $topRatedTv, $genres);

        return view('tv.index', $viewModel);
    }

    public function show($tvShowId)
    {
        $tvShow = Http::withToken(config('services.tmdb.token'))
                    ->get(config('services.tmdb.base_url') . '/tv/' . $tvShowId . '?append_to_response=credits,videos,images')
                    ->json();

        $viewModel = new SingleTvViewModel($tvShow);

        return view('tv.show', $viewModel);
    }
}
