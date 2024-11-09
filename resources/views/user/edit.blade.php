@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Personal Information') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf

                        @if(Auth::user()->avatar)
                         {{-- image --}}
                        <div class="row mt-3">
                             <img src="{{ asset('storage/avatars/'.Auth::user()->avatar)}}" alt="" class="avatar rounded-circle image-lg d-block mx-auto">
                             @else 
                             <i class="far fa-circle-user fa-10x"></i>
                             @endif

                             <form action="{{ route('user.update')}}" method="post" enctype="multipart/form-data">
                             @csrf 
                             @method('PATCH')

                             <input type="file" name="avatar" class="form-control w-auto">
                             <p class="mb-0 form-text">
                             Available formats are .jpeg, .jpg, .png, .gif only <br>
                             Maximum file size is 1048 KB
                             </p>
                             @error('avatar')
                             <p class="mb-0 te<form action="{{ route('user.update')}}" method="post" enctype="multipart/form-data">
                             @csrf 
                             @method('PATCH')

                             <input type="file" nxt-danger small">{{ $message }}</p>
                             @enderror

                        <div class="row mt-3">
                             <label for="first_name" class="col-md-2 col-form-label text-md-start">{{ __('First Name:') }}</label>
                             <div class="col-md-4">
                             <input type="text" name="first_name" id="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="form-control">
                             @error('first_name')
                               <p class="mb-0 text-danger small">{{ $message }}</p>
                             @enderror
                             </div>

                             <label for="last_name" class="col-md-2 col-form-label text-md-start">{{ __('Last Name:') }}</label>
                             <div class="col-md-4">
                             <input type="text" name="last_name" id="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="form-control">
                             @error('last_name')
                               <p class="mb-0 text-danger small">{{ $message }}</p>
                             @enderror
                             </div>

                             <label for="gender" class="col-md-2 col-form-label text-md-start">{{ __('Gender:') }}</label>
                             <div class="col-md-4">
                             <input type="text" name="gender" id="gender" value="{{ old('last_name', Auth::user()->last_name) }}" class="form-control">
                             @error('last_name')
                               <p class="mb-0 text-danger small">{{ $message }}</p>
                             @enderror
                             </div>
                        </div>

                        <div class="row mt-3">
                             <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('E-Mail Address:') }}</label>
                             <div class="col-md-7">
                             <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
                             @error('email')
                               <p class="mb-0 text-danger small">{{ $message }}</p>
                             @enderror
                             </div>
                        </div>

                        <div class="row mt-3">
                             <label for="current-password" class="col-md-4 col-form-label text-md-start">{{ __('Current Password:') }}</label>
                             <div class="col-md-7">
                                  <input id="current-password" type="password" class="form-control @error('password') is-invalid @enderror" name="current-password" required autocomplete="current-password">
                                  @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              </div>
                        </div>

                        <div class="row mt-3">
                             <label for="new-password" class="col-md-4 col-form-label text-md-start">{{ __('New Password:') }}</label>
                             <div class="col-md-7">
                                <input id="new-password" type="password" class="form-control" name="new-password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                        </div>

                        <div class="row mt-3">
                             <label for="password-confirmation" class="col-md-4 col-form-label text-md-start">{{ __('New Password Confirmation:') }}</label>

                             <div class="col-md-7">
                                  <input id="password-confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password-confirmation" required autocomplete="password-confirmation">

                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                             </div>
                         </div>
                    </form>
                </div>
            </div>
            <div class="row mb-0">
            <div class="col-md-3  offset-md-3">
              <a href="{{ route('user.profile')}}" class="btn btn-secondary fw-bold mt-3 px-5">BACK</a>
            </div>
            <div class="col-md-3 offset-md-1">
              <a href="{{ route('user.profile')}}" class="btn btn-warning fw-bold text-white mt-3 px-5">SAVE</a>
            </div>
        </div>
    </div>
  </div>
@endsection