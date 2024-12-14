@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-register.css') }}">

<div class="container">
    <div class="row justify-content-end align-items-center pt-5">
        <div class="col-md-8 signup-area justify-content-center">
            <h2 class="text-center display-1 licorice-regular ">Sign up</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row mb-3 mt-5 me-5">
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-5 text-end">
                                <label for="first-name" class="form-label text-end">First Name</label>
                            </div>
                            <div class="col">
                                <input name="first_name" id="first-name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required autocomplete="name" autofocus tabindex="1">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        

                        <div class="row align-items-center mt-5">
                            <div class="col-5 text-end">
                                <label for="username" class="form-label text-end">Username</label>
                            </div>
                            <div class="col">
                                <input name="username" id="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" tabindex="3">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                       

                        <div class="row align-items-center mt-5">
                            <div class="col-5 text-end">
                                <label for="password" class="form-label text-end">Password</label>
                            </div>
                            <div class="col">
                                <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" tabindex="5">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="col-md-6 right-column">
                        <div class="row align-items-center">
                            <div class="col-5 text-end">
                                <label for="last-name" class="form-label text-end">Last Name</label>
                            </div>
                            <div class="col">
                                <input name="last_name" id="last-name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="name" autofocus tabindex="2">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                       

                        <div class="row align-items-center mt-5">
                            <div class="col-5 text-end">
                                <label for="email" class="form-label text-end">Email</label>
                            </div>
                            <div class="col">
                                <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" tabindex="4">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        

                        <div class="row align-items-center mt-5">
                            <div class="col-5 text-end">
                                <label for="password-confirm" class="form-label text-end">Confirm Password</label>
                            </div>
                            <div class="col">
                                <input name="password_confirmation" id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" tabindex="6">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-0 mt-5 p-0 text-center">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn signup-btn px-5 py-2" tabindex="7">
                            Sign up
                        </button>
                    </div>

                    <p class="mt-2 bottom-text">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
