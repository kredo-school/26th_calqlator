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

    <link rel="stylesheet" href="{{ asset('css/nav-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/foodReg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/exerciseReg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/userlist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/foodlist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/exerciselist.css') }}">    <link rel="stylesheet" href="{{ asset('css/chatpage.css') }}">

    <script src="{{asset('js/fontawesome.js')}}" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm py-0 px-5">
            <a class="navbar-brand" href="{{ route('admin.home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Cal-Q-Lator" class="logo">
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
                        <li class="nav-item">
                            <a class="nav-link logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                </ul>
            </div>
        </nav>

        @if (request()->is('admin/home'))
            <div class="col">
                @yield('content')
            </div>
        @else
            <main class="py-3">
                <div class="row mx-3">
                    <div class="col-auto p-0">
                        <div class="list-group text-center rounded-0">
                            <a href="{{route('admin.home')}}" class="list-group-item {{ request()->is('/admin/home*') ? 'active' : '' }} menu">
                                <h3 class="m-0">Menu Bar</h3>
                            </a>
                            <a href="{{ route('admin.users.list')}}" class="list-group-item {{ request()->is('/admin/user/list*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user"></i> User List <i class="fa-solid fa-table-list"></i>
                            </a>
                            <a href="{{route('admin.foods.food_list')}}" class="list-group-item {{ request()->is('/admin/food/list*') ? 'active' : '' }}">
                                <i class="fa-solid fa-utensils"></i> Food List <i class="fa-solid fa-table-list"></i>
                            </a>
                            <a href="{{route('admin.exercises.list')}}" class="list-group-item {{ request()->is('/admin/exercise/list*') ? 'active' : '' }}">
                                <i class="fa-solid fa-dumbbell"></i> Exercise List <i class="fa-solid fa-table-list"></i>
                            </a>
                            <a href="{{ route('admin.faqlist.index')}}" class="list-group-item {{ request()->is('/admin/faqlist/index*') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-question"></i> FAQ List <i class="fa-solid fa-table-list"></i>
                            </a>
                            <a href="{{ route('admin.food.confirmation')}}" class="list-group-item {{ request()->is('/admin/food/confirmation*') ? 'active' : '' }}">
                                <i class="fa-solid fa-burger"></i> Food Confirmation <i class="fa-solid fa-square-check"></i>
                            </a>
                            <a href="{{ route('admin.exercise.confirmation')}}" class="list-group-item {{ request()->is('/admin/exercise/confirmation*') ? 'active' : '' }}">
                                <i class="fa-solid fa-person-running"></i> Exercise Confirmation <i class="fa-solid fa-square-check"></i>                        
                            </a>
                            <a href="{{ route('admin.food.registration.index')}}" class="list-group-item {{ request()->is('/admin/food/registration*') ? 'active' : '' }}">
                                <i class="fa-solid fa-carrot"></i> Food Registeration <i class="fa-solid fa-square-plus"></i>
                            </a>
                            <a href="{{ route('admin.exercise.registration.index')}}" class="list-group-item {{ request()->is('admin/exercise/registration*') ? 'active' : '' }}">
                                <i class="fa-solid fa-person-walking"></i> Exercise Registeration <i class="fa-solid fa-square-plus"></i>
                            </a>
                            <a href="{{ route('admin.faqregistration.index')}}" class="list-group-item {{ request()->is('/admin/faqregistration/index*') ? 'active' : '' }}">
                                <i class="fa-solid fa-person-circle-question"></i> FAQ Registeration <i class="fa-solid fa-square-plus"></i>
                            </a>
                            <a href="{{ route('chat.adminChat')}}" class="list-group-item {{ request()->is('/admin/chat*') ? 'active' : '' }} list-group-item-action">
                                <i class="fa-solid fa-comments"></i> Chat Page
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        @yield('content')
                    </div>
                </div>
            </main>
        @endif
    </div>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/dataTables.js')}}"></script>
<script>
$(document).ready(function() {
    $('#admin-table').DataTable({
        paging: true,
        pageLength: 10,
        searching: false,
        ordering: true,
    });
});
</script>
<script src="{{ asset('assets/js/sort.js') }}"></script>
</body>
</html>
