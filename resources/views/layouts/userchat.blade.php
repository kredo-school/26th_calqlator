<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cal-Q-Lator')}}  | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/user-nav-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/signup.js') }}" defer></script>
</head>
<body>
    <div id="app">
        @include('user-guest-navbar')
        <main class="main-content py-1">
                @yield('content')
        </main>
        @include('user-guest-footer')
    </div>
</body>
</html>
