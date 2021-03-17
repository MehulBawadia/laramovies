<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
</head>
<body class="bg-gray-900 text-white font-sans">
    @include('partials._nav')

    @yield('content')

    @include('partials._footer')
</body>
</html>