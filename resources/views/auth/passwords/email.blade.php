@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-login.css') }}">

<div class="container">
    <div class="row justify-content-start align-items-center mt-5 pt-5">
        <div class="col-md-6 login-area justify-content-center">
            <h2 class="text-center display-1 licorice-regular ">Enter you email</h2>

                    <form method="POST" action="{{ route('find.user.reset.id') }}">
                        @csrf
                        <div class="row mb-3 mt-5 me-5 justify-content-center">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-5 text-end">
                                        <label for="email" class="form-label text-end">Email</label>
                                    </div>
                                    <div class="col-6">
                                        <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-5 mb-3 p-0 text-center justify-content-center">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <button type="submit" class="btn login-btn px-5 py-2">
                                        Go to password reset
                                    </button>
                                </div>
                            </div>
                            <p class="mt-2 mb-0 bottom-text">Go back to <a href="{{ route('login') }}">Login</a></p>
                            <p class="mt-2 mb-0 bottom-text">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
