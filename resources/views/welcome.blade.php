@extends('partials._layout')

@section('title')
    <title>Movies App | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16 popularMovies">
                <h2 class="uppercase tracking-wider text-lg font-bold text-yellow-600">Popular Movies</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                    @foreach ($popularMovies as $movie)
                        <x-movie-card :movie="$movie" :genres="$genres" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16 nowPlayingMovies">
                <h2 class="uppercase tracking-wider text-lg font-bold text-yellow-600">Now Playing Movies</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                    @foreach ($nowPlayingMovies as $movie)
                        <x-movie-card :movie="$movie" :genres="$genres" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
