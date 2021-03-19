<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($pageNumber = 1)
    {
        $popularActors = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/person/popular?page=' . $pageNumber)
                            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $pageNumber);

        return view('actors.index', $viewModel);
    }
}
