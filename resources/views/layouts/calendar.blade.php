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

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Cal-Q-Lator') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="row h-100">
                <div class="col-2 p-0 menu-area">
                    <ul class="list-group text-center ms-auto border border-dark">
                        <li class="list-group-item m-0 list-title">Summary</h3>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="item-left">Item Left</span>
                                <span class="item-right">Item Right</span>
                            </div>
                        </li>
                       
                    </ul>                
                </div>
                <div class="col p-0">
                    @yield('content')
                </div>
                <div class="col-2">

                </div>
            </div>
        </main>
    </div>
</body>
</html>