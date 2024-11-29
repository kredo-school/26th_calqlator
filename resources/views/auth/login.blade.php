@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-login.css') }}">

<div class="container">
    <div class="row justify-content-start align-items-center pt-5">
        <div class="col-md-6 login-area justify-content-center">
            <h2 class="text-center display-1 licorice-regular ">Login</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3 pt-5 me-5 justify-content-center">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-5 text-end">
                                        <label for="email" class="form-label text-end">Email</label>
                                    </div>
                                    <div class="col-5">
                                        <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
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
                                    <div class="col-5">
                                        <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-5 p-0 text-center">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <button type="submit" class="btn login-btn px-5 py-2">
                                        Login
                                    </button>
                                </div>
                            </div>
                            <p class="mt-2 bottom-text">Are you new here? <a href="{{ route('register') }}">Sign up</a></p>
                            <div class="forgot-password">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
