@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/guest-home.css') }}">

<div class="welcome">
    <div class="ms-5">
        <h1 class="display-1 title">Welcome</h1>
        <h2 class="display-3 title">to</h2>
        <img class="welcome-logo" src="../assets/images/logo.png" alt="logo">
    </div>
</div>

@endsection
