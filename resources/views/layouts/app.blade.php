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
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ asset('css/fonts-googleapis.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatpage.css') }}">

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">
       @include('user-guest-navbar')
       @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
       @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
       @endif
        <main class="main-content">
            @yield('content')    
        </main>
        @include('user-guest-footer')
    </div>
    <script src="{{ asset('js/signup.js') }}" defer></script>
</body>
</html>