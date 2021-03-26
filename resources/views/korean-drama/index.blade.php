@extends('partials._layout')

@section('title')
    <title>Korean Drama Shows | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16 popularTvShows">
                <h2 class="uppercase tracking-wider text-lg font-bold text-yellow-600">Popular Shows</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                    @foreach ($searchResults as $tvShow)
                        <x-tv-card :tvShow="$tvShow" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
            path: '/korean-drama/page/@{{#}}',
            append: '.tvShowCard',
            status: '.page-load-status'
        });
    </script>
@endsection
