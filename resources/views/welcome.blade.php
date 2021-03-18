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
                        <div class="movieCard mt-8">
                            <a href="#">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" title="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150" />
                            </a>

                            <div class="mt-2">
                                <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">{{ $movie['title'] }}</a>

                                <div class="flex items-center text-gray-400 text-sm mt-1">
                                    <svg class="fill-current text-yellow-600 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                                    <span class="ml-1">{{ $movie['vote_average'] * 10 }}%</span>
                                    <span class="mx-2">|</span>
                                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                                </div>

                                <div class="div text-gray-400 text-sm">
                                    @foreach ($movie['genre_ids'] as $genre)
                                        {{ $genres->get($genre) }}@if (! $loop->last), @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
                        <div class="movieCard mt-8">
                            <a href="#">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" title="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150" />
                            </a>

                            <div class="mt-2">
                                <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">{{ $movie['title'] }}</a>

                                <div class="flex items-center text-gray-400 text-sm mt-1">
                                    <svg class="fill-current text-yellow-600 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                                    <span class="ml-1">{{ $movie['vote_average'] * 10 }}%</span>
                                    <span class="mx-2">|</span>
                                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                                </div>

                                <div class="div text-gray-400 text-sm">
                                    @foreach ($movie['genre_ids'] as $genre)
                                        {{ $genres->get($genre) }}@if (! $loop->last), @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
