@extends('partials._layout')

@section('title')
    <title>Search | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16 search">
                <h2 class="uppercase tracking-wider text-lg font-bold text-yellow-600">Search Shows</h2>

                <form action="{{ route('postSearch') }}" method="POST">
                    @csrf

                    <div class="mt-5">
                        <input type="text" name="query" class="border w-full text-gray-100 bg-gray-500 py-2 px-2 focus:outline-none" placeholder="Movie or TV Show name" value="{{ session('formData')['query'] }}" />
                    </div>

                    <div class="flex items-center gap-6 mt-5">
                        <div class="w-1/4 mt-5">
                            <select name="movie_or_tv" id="movie_or_tv" class="border text-gray-100 bg-gray-500 py-2 px-2 w-full focus:outline-none" value="">
                                <option value="" {{ session('formData')['movie_or_tv'] == ""  ? 'selected' : '' }}>Select Movie/Tv</option>
                                <option value="movie" {{ session('formData')['movie_or_tv'] == "movie" ? 'selected' : '' }}>Movie</option>
                                <option value="tv" {{ session('formData')['movie_or_tv'] == "tv" ? 'selected' : '' }}>TV Show</option>
                            </select>
                        </div>
                        <div class="w-1/4 mt-5">
                            <select name="country" id="country" class="border text-gray-100 bg-gray-500 py-2 px-2 w-full focus:outline-none">
                                <option value="" {{ session('formData')['country'] == "" ? 'selected' : '' }}>Select Country</option>
                                <option value="ko" {{ session('formData')['country'] == "kr" ? 'selected' : '' }}>Korean</option>
                                <option value="in" {{ session('formData')['country'] == "in" ? 'selected' : '' }}>India</option>
                            </select>
                        </div>
                        <div class="w-1/4 mt-5">
                            <select name="genre" id="genre" class="border text-gray-100 bg-gray-500 py-2 px-2 w-full focus:outline-none">
                                <option value="" {{ session('formData')['genre'] = "" ? 'selected' : '' }}>Select Genre</option>
                                @foreach ($genres as $id => $genre)
                                    <option value="{{ $id }}" {{ session('formData')['genre'] == $id ? 'selected' : '' }}>{{ $genre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/4 mt-5">
                            <select name="year" id="year" class="border text-gray-100 bg-gray-500 py-2 px-2 w-full focus:outline-none">
                                <option value="">Select Year</option>
                                @foreach (collect(range(1990, date('Y')))->sortDesc() as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="mt-8 bg-gray-800 py-2 w-full border-0 hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Search</button>
                </form>
            </div>

            <div class="px-8 py-16 results">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                    @foreach ($searchResults as $result)
                        <x-tv-card :tvShow="$result" :genres="$genres" />
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
            path: '/search/page/@{{#}}',
            append: '.tvShowCard',
            status: '.page-load-status'
        });
    </script>
@endsection
