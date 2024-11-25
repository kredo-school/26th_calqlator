<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Licorice&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/datalabels.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('assets/css/user-homepage.css') }}">

</head>
<body>
    <div id="app">
        {{-- navbar --}}

        <main class="py-4">
                @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/calories-chart.js') }}"></script>
    <script src="{{ asset('js/workout-chart.js') }}"></script>
    <script src="{{ asset('js/protein-chart.js') }}"></script>
    <script src="{{ asset('js/fat-chart.js') }}"></script>
    <script src="{{ asset('js/carbs-chart.js') }}"></script>
</body>
</html>

