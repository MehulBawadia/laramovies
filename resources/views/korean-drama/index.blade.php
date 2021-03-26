@extends('partials._layout')

@section('title')
    <title>Korean Drama Shows | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="border-b border-gray-800">
        <div class="container mx-auto">
            <div class="px-8 py-16 popularTvShows">
                <h2 class="uppercase tracking-wider text-lg font-bold text-yellow-600">Popular Shows</h2>

                <select name="year" id="year" class="my-8 border text-gray-100 bg-gray-500 py-2 px-2 w-1/4 focus:outline-none">
                    <option value="">Select Year</option>
                    @foreach (collect(range(1990, date('Y')))->sortDesc() as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <select name="genre" id="genre" class="my-8 border text-gray-100 bg-gray-500 py-2 px-2 w-1/4 focus:outline-none">
                    <option value="">Select Genre</option>
                    @foreach ($genres as $id => $genre)
                        <option value="{{ $id }}">{{ $genre }}</option>
                    @endforeach
                </select>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 htmlResult">
                    @include('korean-drama.fetch')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var path = '/korean-drama/page/@{{#}}';
        let $infScroll = $('.grid').infiniteScroll({
            path: path,
            append: '.tvShowCard',
            status: '.page-load-status'
        });

        var selectedYear = $('select[name="year"]').find('option:selected').val();
        var selectedGenre = $('select[name="genre"]').find('option:selected').val();

        $('select[name="year"]').on('change', function (e) {
            e.preventDefault();

            selectedYear = $(this).val();

            var path = '/korean-drama/page/@{{#}}';
            if (selectedYear !== "") {
                path += '/' + selectedYear;
            }

            if (selectedGenre !== "") {
                path += '/' + selectedGenre;
            }

            $infScroll.infiniteScroll('destroy');

            $.ajax({
                url: '/korean-drama/fetch/' + $(this).val() + "/" + selectedGenre,
                type: 'GET',
                success: function (res) {
                    $('.htmlResult').html(res.htmlResult);

                    let $infScroll = $('.grid').infiniteScroll({
                        path: path,
                        append: '.tvShowCard',
                        status: '.page-load-status'
                    });
                },
            });
        });

        $('select[name="genre"]').on('change', function (e) {
            e.preventDefault();

            selectedGenre = $(this).val();

            var path = '/korean-drama/page/@{{#}}';
            if (selectedYear == "") {
                selectedYear = new Date().getFullYear();
            }
            path += "/" + selectedYear;

            if (selectedGenre !== "") {
                path += '/' + selectedGenre;
            }

            $infScroll.infiniteScroll('destroy');

            $.ajax({
                url: '/korean-drama/fetch/' + selectedYear + '/' + selectedGenre,
                type: 'GET',
                success: function (res) {
                    $('.htmlResult').html(res.htmlResult);

                    let $infScroll = $('.grid').infiniteScroll({
                        path: path,
                        append: '.tvShowCard',
                        status: '.page-load-status'
                    });
                },
            });
        });
    </script>
@endsection
