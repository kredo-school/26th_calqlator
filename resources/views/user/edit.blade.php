@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">

<div class="container mt-5">
  <form method="POST" id="edit-form" action="{{ route('user.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
    <div class="row">
        

          <div class="col-3"><!--left col-->
              <div class="card h-100">
                  <div class="card-body">
                      <div class="account-settings">
                          <div class="user-profile">
                              {{-- image --}}
                              @if(Auth::user()->avatar)
                              <img src="{{ Auth::user()->avatar}}" alt="" class="avatar rounded-circle image-lg" style=" display: block; margin-left: auto; margin-right: auto;">
                              @else
                              <i class="far fa-circle-user fa-10x"></i>
                              @endif

                              <h4 class="mb-0 mt-0">{{ Auth::user()->name }}</h4>

                              <div class="row mt-4 mx-auto">
                                  <input type="file" name="avatar" class="form-control">
                                  <p class="mb-0 form-text">
                                      Available formats are <br>.jpeg, .jpg, .png, .gif only <br>
                                      Maximum file size is 1048 KB
                                  </p>
                                  @error('avatar')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-9"><!--right col-->
              <div class="card h-100">
                  <div class="card-header fw-bold">
                      <h4>
                          {{ __('Personal Details') }}
                          <h4>
                  </div>
                  <div class="card-body">
                      <div class="col-9">
                          <div class="row mt-3">
                              <label for="username" class="col-2 form-label text-md-start">{{ __('Username:') }}</label>
                              <div class="col-8">
                                  <input type="text" name="username" id="username" value="{{ old('username', Auth::user()->username) }}" class="form-control">
                                  @error('username')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                              </div>
                          </div>

                          <div class="row mt-4">
                              <label for="first_name" class="col-2 form-label text-md-start">{{ __('First Name:') }}</label>
                              <div class="col-4">
                                  <input type="text" name="first_name" id="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="form-control">
                                  @error('first_name')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                              </div>

                              <label for="last_name" class="col-2 form-label text-md-start">{{ __('Last Name:') }}</label>
                              <div class="col-4">
                                  <input type="text" name="last_name" id="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="form-control">
                                  @error('last_name')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                              </div>
                          </div>

                          <div class="row mt-4">
                              <label for="birthday" class="col-2 form-label text-md-start">{{ __('Date of Birth:') }}</label>
                              <div class="col-4">
                                  <div class="form-group">
                                      <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user_birthday) }}" class="form-control">
                                      @error('birthday')
                                      <p class="mb-0 text-danger small">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <label for="gender" class="col-2 form-label text-md-start">{{ __('Gender:') }}</label>
                              <div class="col-4">
                                  <div class="form-group">
                                      <?php 
                                          $male_selected = $user_gender === 'Male' ? 'selected' : '';
                                          $female_selected = $user_gender === 'Female' ? 'selected' : '';
                                      ?>
                                      <select id="gender" name="gender" class="form-control">
                                          <option {{ $male_selected }}>Male</option>
                                          <option {{ $female_selected }}>Female</option>
                                      </select>
                                  </div>
                                  @error('gender')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                              </div>
                          </div>

                          <div class="row mt-4">
                              <label for="height" class="col-2 form-label text-md-start">{{ __('Height (cm):') }} </label>
                              <div class="col-4">
                                  <div class="form-group">
                                      <input type="number" name="height" id="height" value="{{ old('height', $user_height) }}" min="100" max="250" step="0.1" class="form-control">
                                      @error('height')
                                      <p class="mb-0 text-danger small">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <label for="weight" class="col-2 form-label text-md-start">{{ __('Weight (kg):') }}</label>
                              <div class="col-4">
                                  <div class="form-group">
                                      <input type="number" name="weight" id="weight" value="{{ old('weight', $current_weight) }}" min="30" max="250" step="0.1" class="form-control">
                                      @error('weight')
                                      <p class="mb-0 text-danger small">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>
                          </div>

                          <div class="row mt-5">
                              <label for="email" class="col-2 form-label text-md-start">{{ __('Email:') }}</label>
                              <div class="col-6 offset-md-0">
                                <p>{{ Auth::user()->email }}</p>
                              </div>
                              <div class="col-3 offset-md-1">
                                  @if (Route::has('password.request'))
                                  <a class="btn btn-link" id="current-email" data-bs-toggle="modal" data-bs-target="#change-email">
                                      {{ __('Change Email') }}
                                  </a>
                                  @endif
                              </div>
                              <!-- @include('user.modal.change-email') -->
                          </div>
                          <div class="row mt-4">
                              <label for="password" class="col-2 form-label text-md-start">{{ __('Password:') }}</label>
                              <div class="col-6 offset-md-0">
                                <p> ******** </p>
                              </div>
                              <div class="col-3 offset-md-1">
                                  @if (Route::has('password.request'))
                                  <a class="btn btn-link" id="current-password" data-bs-toggle="modal" data-bs-target="#change-password">
                                      {{ __('Change Password') }}
                                  </a>
                                  @endif
                              </div>
                          </div>
                          <div class="row mt-4">
                              <div class="col-3  offset-3">
                                  <a href="{{ route('user.profile')}}" class="btn btn-secondary fw-bold mt-3 px-5">BACK</a>
                              </div>
                              <div class="col-3 offset-1">
                                  @if (Route::has('user.update'))
                                  <a class="btn btn-warning fw-bold text-white mt-3 px-5" data-bs-toggle="modal" data-bs-target="#save-change">
                                      {{ __('SAVE') }}
                                  </a>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
  </form>
  @include('user.modal.change-email')
  @include('user.modal.change-password')
  @include('user.modal.save-change')
</div>
@if(isset($has_error))
<script>
  var has_error_js = true;
</script>
@else
<script>
  var has_error_js = false;
</script>
@endif
<script src={{ asset('js/profile-edit-form.js') }}></script>
@endsection