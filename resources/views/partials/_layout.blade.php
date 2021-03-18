<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />

    <livewire:styles>
</head>
<body class="bg-gray-900 text-white font-sans">
    @include('partials._nav')

    @yield('content')

    @include('partials._footer')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <livewire:scripts>
</body>
</html>
