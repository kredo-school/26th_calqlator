@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-login.css') }}">

<div class="container">
    <div class="row justify-content-start align-items-center mt-5 pt-5">
        <div class="col-md-6 login-area justify-content-center">
            <h2 class="text-center display-1 licorice-regular ">Password Reset</h2>

                    <form method="POST" action="{{ route('update.password',$id) }}">
                        @csrf

                        <div class="row mb-3 mt-5 me-5 justify-content-center">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-5 text-end">
                                        <label for="password" class="form-label text-end">Password</label>
                                    </div>
                                    <div class="col-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row align-items-cente mt-5">
                                    <div class="col-5 text-end">
                                        <label for="password-confirm" class="form-label text-end">Confirm Password</label>
                                    </div>
                                <div class="col-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-5 p-0 text-center">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn reset-btn px-5 py-2">
                                    Reset Password
                                </button>
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
