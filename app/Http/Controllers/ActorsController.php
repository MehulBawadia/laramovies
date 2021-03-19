<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($pageNumber = 1)
    {
        // 204 is http staus code for no content or end of content
        abort_if($pageNumber > 500, 204);

        $popularActors = Http::withToken(config('services.tmdb.token'))
                            ->get(config('services.tmdb.base_url') . '/person/popular?page=' . $pageNumber)
                            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $pageNumber);

        return view('actors.index', $viewModel);
    }
}
