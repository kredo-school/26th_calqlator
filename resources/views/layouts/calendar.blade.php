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
    <script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        @include('user-guest-navbar')

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
                <div class="col p-0 pb-5">
                    @yield('content')
                </div>
                <div class="col-2">

                </div>
            </div>
        </main>
       @include('user-guest-footer')
    </div>
</body>
</html>
