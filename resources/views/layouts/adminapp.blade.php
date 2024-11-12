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

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
    <body>
        <div id="app">
            <main class="py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        {{-- [SOON] Admin Controls --}}
                        {{-- @if (request()->is('admin/*')) --}}
                            <div class="col-3">
                                <div class="list-group">
                                    {{-- Menu Bar --}}
                                    <h3 class="text-center list-group-item">Menu Bar</h3>

                                    {{-- User List --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-regular fa-user"></i>User List
                                    </a>

                                    {{-- Food List --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-bowl-food"></i>Food List
                                    </a>

                                    {{-- Exercise List --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-dumbbell"></i>Exercise List
                                    </a>

                                    {{-- FAQ List --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-clipboard-question"></i>FAQ List
                                    </a>

                                    {{-- Food Confirmation --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-burger"></i>Food Confirmation
                                    </a>

                                    {{-- Exercise Confirmation --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-person-running"></i>Exercise Confirmation
                                    </a>

                                    {{-- Food Registration --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-egg"></i>Food Registration
                                    </a>

                                    {{-- Exercise Registration --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-solid fa-person-swimming"></i>Exercise Registration
                                    </a>

                                    {{-- FAQ Registration --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-regular fa-circle-question"></i>FAQ Registration
                                    </a>

                                    {{-- Chat Page --}}
                                    <a href="" class="list-group-item">
                                        <i class="fa-regular fa-comment-dots"></i>Chat Page
                                    </a>

                                    </a>
                                </div>
                            </div> 
                        @endif
            
                        <div class="col-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>   
</html>