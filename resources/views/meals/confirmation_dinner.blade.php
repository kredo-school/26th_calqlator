<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Confirmation Dinner</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/meal.style.css') }}">
</head>
<body>
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
        <ul class="navbar-nav ml-auto">
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle shadow-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           Menu 
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
  <div class="container mt-5">
    <div class="underline-container">
      <h2 class="underline text-left">Meal Confirmation Dinner</h2>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Item</th>
            <th>Calories</th>
            <th>Amount</th>
            <th>Time eaten</th>
            <th>Protein</th>
            <th>Carbohydrate</th>
            <th>Lipid</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($meals as $meal)
            <tr>
              <td>{{ $meal->item }}</td>
              <td>{{ $meal->calories }} kcal</td>
              <td>{{ $meal->amount }}</td>
              <td>{{ $meal->time_eaten->format('H:i') }}</td>
              <td>{{ $meal->protein }} kcal</td>
              <td>{{ $meal->carbohydrate }} kcal</td>
              <td>{{ $meal->lipid }} kcal</td>
              <td>{{ $meal->date }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="8" class="text-center font-weight-bold">Total Calories:{{ $totalCalories }} kcal</td>

          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  @include('user-guest-footer')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
