@extends('partials._layout')

@section('title')
    <title>Actors | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16 popularActors">
                <h2 class="uppercase tracking-wider text-lg font-bold text-yellow-600">Popular Actors</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                    @foreach ($popularActors as $actor)
                        <div class="actor mt-8">
                            <a href="#">
                                <img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>

                            <div class="mt-2">
                                <a href="#" class="text-lg hover:text-gray-300 focus:text-gray-300 focus:outline-none">{{ $actor['name'] }}</a>
                                <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                            </div>
                        </div>
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
            path: '/actors/page/@{{#}}',
            append: '.actor',
        });
    </script>
@endsection
