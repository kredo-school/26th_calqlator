@extends('layouts.app')

@section('title', 'Goal')

@section('content')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}">

<div class="container">  
  <div class="row gutters">
    <div class="card h-100">
      <div class="card-header fw-bold"><h4>{{ __('Your Goal') }}<h4></div>
        <div class="card-body">
        <div class="account-settings">
          <div class="user-goal">
            <form method="POST" action="{{ route('user.goal') }}">
              @csrf

              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="row mt-3">
                        <label for="goal" class="col-md-2 col-form-label text-md-start">{{ __('What is your goal?') }}</label>
                            <div class="col-md-2">
                              <div class="form-group value={{ old('goal', Auth::user()->goal) }}">
                                <select id="goal" name="goal" class="form-control">
                                  <option>Lose weight</option>
                                  <option>Maintain weight</option>
                                  <option>Gain weight</option>
                                </select>
                              </div>
                              @error('gender')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                      </div>

                      <div class="row mt-3">
                        <label for="activity level" class="col-md-2 col-form-label text-md-start">{{ __('Activity Level:') }}</label>
                            <div class="col-md-2">
                              <div class="form-group value={{ old('activity_level', Auth::user()->activity_level) }}">
                                <select id="activity_level" name="activity_level" class="form-control">
                                  <option>Low : Little or no daily activity.</option>
                                  <option>Normal : Light daily activity.</option>
                                  <option>High : Physical activity throughout the day.</option>
                                </select>
                              </div>
                              @error('gender')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                      </div>

                      <div class="row mt-3">
                        <label for="how to lose" class="col-md-2 col-form-label text-md-start">{{ __('How to achieve your goal?:') }}</label>
                            <div class="col-md-2">
                              <div class="form-group value={{ old('how_to_lose', Auth::user()->how_to_lose) }}">
                                <select id="how_to_lose" name="how_to_lose" class="form-control">
                                  <option>Meal</option>
                                  <option>Half Meal & Half Workout</option>
                                  <option>Workout</option>
                                </select>
                              </div>
                              @error('gender')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                      </div>

                        <div class="row mt-3">
                            <label for="update_weight" class="col-md-2 col-form-label text-md-start">{{ __("What's your current weight?") }}</label><br>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="number" name="update_weight" id="" value="{{ old('weight', Auth::user()->weight) }}" class="form-control">
                                  @error('update_weight')
                                    <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                                </div>
                              </div>

                              <div class="col-md-4">
                                <p>BMI = {{ Auth::user()->bmi }} </p>
                              </div>
                        </div>

                        <div class="row mt-3">
                            <label for="goal_weight" class="col-md-2 col-form-label text-md-start">{{ __("What's your goal weight?") }} </label>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="number" name="goal_weight" id="goal_weight" value="{{ old('goal_weight', Auth::user()->goal_weight) }}" min="30"  max="250" step="0.1" class="form-control">
                                  @error('goal_weight')  
                                    <p class="mb-0 text-danger small">{{ $message }}</p>
                                  @enderror
                                </div>
                              </div>

                              <div class="col-md-4">
                                <p>BMI = {{ Auth::user()->bmi }} </p>
                              </div>
                        </div>

                        <div class="row mt-3">
                          <p>When do you want to achieve your goal?</p>
                          <label for="goal_date" class="col-md-2 col-form-label text-md-start">{{ __('by ')  }}</label>
                            <div class="col-md-4">
                              <div class="form-group">
                                <input type="date" name="goal_date" id="goal_date" value="{{ old('goal_date', Auth::user()->goal_date) }}" class="form-control">
                                @error('goal_date')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                        </div>

              </div>
            </form>
          </div>
          <div class="row mt-5">
            <div class="col-md-3  offset-md-3">
              <a href="{{ route('user.profile')}}" class="btn btn-secondary fw-bold mt-3 px-5">BACK</a>
            </div>
            <div class="col-md-3 offset-md-1">
              @if (Route::has('user.goal'))
                <a class="btn btn-warning fw-bold text-white mt-3 px-5" data-bs-toggle="modal" data-bs-target="#save-change">{{ __('SAVE') }}
                </a>
              @endif
            </div>
            @include('user.modal.goal-change')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection