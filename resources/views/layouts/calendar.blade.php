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

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">
    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        @include('user-guest-navbar')

        <main>
            <div class="row h-100 w-100 g-0 all-area">
                <div class="p-0 menu-area">
                    <ul class="list-group text-center border border-dark">
                        <h3 class="list-group-item m-0 list-title ">Summary of the month</h3>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="icon">😀</span>
                                <span class="count">{{$smile1}}</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="icon">😏</span>
                                <span class="count">{{$smile2}}</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="icon">😐</span>
                                <span class="count">{{$smile3}}</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="icon" >😷</span>
                                <span class="count">{{$smile4}}</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="icon">😴</span>
                                <span class="count">{{$smile5}}</span>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            <div class="d-flex">
                                <span class="icon">⭐</span>
                                <span class="count">{{$star}}</span>
                            </div>
                        </li>
                    </ul>                
                </div>
                <div class="calendar-area p-0">
                    @yield('content')
                </div>
                <div class="image-area">

                </div>
            </div>
        </main>
       @include('user-guest-footer')
    </div>
    <script src="../assets/js/jquery.js"></script>
    <script src="../js/calendar.js"></script>
</body>
</html>
