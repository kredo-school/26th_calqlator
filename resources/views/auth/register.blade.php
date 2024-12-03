@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-register.css') }}">

<div class="container">
    <div class="row justify-content-end align-items-center">
        <div class="col-md-8">

            <div>
                <h2 class="text-center h1">Sign up</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first-name" class="form-label text-end">First Name</label>
                            <input name="first_name" id="first-name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="username" class="form-label text-end">Username</label>
                            <input name="username" id="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="password" class="form-label text-end">Password</label>
                            <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        

                        <div class="col-md-6">
                            <label for="last-name" class="form-label text-end">Last Name</label>
                            <input name="last_name" id="last-name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="email" class="form-label text-end">Email</label>
                            <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="password-confirm" class="form-label text-end">Confirm Password</label>
                            <input name="password_confirmation" id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            
                        </div>

                        <div class="row mb-0 mt-3">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn signup-btn px-5 py-2">
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
