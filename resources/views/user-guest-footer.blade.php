<link rel="stylesheet" href="{{ asset('css/user-navbar.css') }}">

<footer class=" navbar navbar-expand-md d-flex flex-wrap justify-content-between align-items-center py-3 m-0 border-top">
    <p class="mb-0 text-start ps-5">Copyright &copy; {{ date('Y') }} {{ config('app.name') }}</p>

    <ul class="nav justify-content-end pe-5 ms-auto">
        <li class="nav-item">
            <a href="{{route('user.faq')}}" class="nav-link px-2">FAQ</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link px-2">Manual</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link px-2">Contact</a>
        </li>
    </ul>
</footer>