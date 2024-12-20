    <link rel="stylesheet" href="{{ asset('css/user-navbar.css') }}">

    <nav class="navbar navbar-expand-md py-0 px-5" role="navigation">
        @guest
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('/assets/images/logo.png') }}" alt="Cal-Q-Lator" class="logo">
            </a>
        @else
            <a class="navbar-brand" href="{{ route('user.home', $date=now()->format('Y-m-d')) }}">
                <img src="{{ asset('/assets/images/logo.png') }}" alt="Cal-Q-Lator" class="logo">
            </a>
        @endguest

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
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
                    <li class="nav-item">
                        <a class="nav-link calendar-link" href="{{ route('user.calendar') }}">
                            C<img src="{{asset('/images/a-img.png')}}" alt="a" class="a-img">lend<img src="{{asset('/images/a-img.png')}}" alt="a" class="a-img">r
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle shadow-none" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               Menu 
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                             <a href="{{route('user.home',$date=now()->format('Y-m-d'))}}" class="dropdown-item">
                                Home
                            </a>
                             <a href="{{route('user.profile')}}" class="dropdown-item calendar-link">
                                My P<img src="{{asset('/images/a-img.png')}}" alt="a" class="dropdown-a-img">ge
                            </a>
                             <a href="{{route('user.edit')}}" class="dropdown-item calendar-link">
                                User Inform<img src="{{asset('/images/a-img.png')}}" alt="a" class="dropdown-a-img">tion
                            </a>

                            <hr class="dropdown-divider">

                            <a class="nav-link logout" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> 

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>