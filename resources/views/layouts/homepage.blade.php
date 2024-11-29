<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="//fonts.bunny.net">-->
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <!--<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
    <link href="{{ asset('css/fonts2.css') }}" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}">

</head>
<body>
    <div id="app">
        @include('user-guest-navbar')
        <main class="py-4">
                @yield('content')
        </main>
       @include('user-guest-footer')
    </div>
</body>
</html>