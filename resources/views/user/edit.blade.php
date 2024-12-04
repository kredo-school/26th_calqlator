@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
    <div class="card-body">
        <div class="account-settings">
          <div class="user-profile">
            <form method="POST" action="{{ route('user.update') }}">
              @csrf
              @if(Auth::user()->avatar)

              {{-- image --}}
                <img src="{{ asset('storage/avatars/'.Auth::user()->avatar)}}" alt="" class="avatar rounded-circle image-lg mx-auto">
                    @else 
                    <i class="far fa-circle-user fa-10x"></i>
                    @endif

                  <h4 class="mb-0 mt-0">{{ Auth::user()->name }}</h4>

                    <div class="row mt-3 mx-auto">
                      <form action="{{ route('user.update')}}" method="post" enctype="multipart/form-data">
                          @csrf 
                          @method('PATCH')

                        <input type="file" name="avatar" class="form-control">
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
                      </form>
                    </div>
          </div>
        </div>
    </div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12"><!--right col-->
<div class="card h-100">
  <div class="card-header fw-bold"><h4>{{ __('Personal Details') }}<h4></div>
	  <div class="card-body">
      <div class="row gutters">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row mt-3">
                        <label for="username" class="col-md-2 col-form-label text-start">{{ __('Username:') }}</label>
                        <div class="col-md-6">
                          <input type="name" name="name" id="name" value="{{ old('username', Auth::user()->username) }}" class="form-control">
                            @error('username')
                              <p class="mb-0 text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

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
                    </div>

                    <div class="row mt-3">
                        <label for="birthDate" class="col-md-2 col-form-label text-md-start">{{ __('Date of Birth:') }}</label>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="date" name="date_of_birth" id="birthdate" value="{{ old('birthDate', Auth::user()->birthDate) }}" class="form-control">
                              @error('birthDate')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                        <label for="gender" class="col-md-2 col-form-label text-md-start">{{ __('Gender:') }}</label>
                          <div class="col-md-2">
                            <div class="form-group">
                              <select id="gender" name="gender" class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                            </div>
                            @error('gender')
                              <p class="mb-0 text-danger small">{{ $message }}</p>
                            @enderror
                          </div>
                    </div>

                    <div class="row mt-3">
                        <label for="height" class="col-md-2 col-form-label text-md-start">{{ __('Height (cm):') }} </label>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="number" name="height" id="height" value="{{ old('height', Auth::user()->height) }}" min="100"  max="250" step="0.1" class="form-control">
                              @error('height')  
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                        <label for="weight" class="col-md-2 col-form-label text-md-start">{{ __('Weight (kg):') }}</label>
                          <div class="col-md-2">
                            <div class="form-group">
                              <input type="number" name="weight" id="weight" value="{{ old('weight', Auth::user()->weight) }}"  min="30"  max="250" step="0.1" class="form-control">
                              @error('weight')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="row mt-3">
                        <label for="email" class="col-md-2 col-form-label text-md-start">{{ __('E-Mail Address:') }}</label>
                          <div class="col-md-6 offset-md-0">
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
                            @error('email')
                              <p class="mb-0 text-danger small">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="col-md-3 offset-md-1">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" id="current-email" data-bs-toggle="modal" data-bs-target="#change-email">{{ __('Change Email') }}
                                </a>
                            @endif
                          </div>
                          @include('user.modal.change-email')
                    </div>

                    <div class="row mt-3">
                        <label for="password" class="col-md-2 col-form-label text-md-start">{{ __('Password:') }}</label>
                          <div class="col-md-6 offset-md-0">
                            <input type="password" name="password" id="password" value="{{ old('password', Auth::user()->password) }}" class="form-control">
                            @error('password')
                              <p class="mb-0 text-danger small">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="col-md-3 offset-md-1">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" id="current-password" data-bs-toggle="modal" data-bs-target="#change-password">{{ __('Change Password') }}
                                </a>
                            @endif
                          </div>
                          @include('user.modal.change-password')
                    </div>
              </div>
            </form>
          </div>
      <div class="row mt-5">
        <div class="col-md-3  offset-md-3">
          <a href="{{ route('user.profile')}}" class="btn btn-secondary fw-bold mt-3 px-5">BACK</a>
        </div>
        <div class="col-md-3 offset-md-1">
          @if (Route::has('password.request'))
            <a class="btn btn-warning fw-bold text-white mt-3 px-5" data-bs-toggle="modal" data-bs-target="#save-change">{{ __('SAVE') }}
            </a>
          @endif
        </div>
        @include('user.modal.save-change')
      </div>
    </div>
  </div>
</div>
@endsection