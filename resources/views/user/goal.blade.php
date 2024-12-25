@extends('layouts.app')

@section('title', 'Goal')

@section('content')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}">

<div class="container">
<div class="row">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="row justify-content-start align-items-center">
      <h2 class="text-start display-1 licorice-regular ">Your Goal</h2>
    </div>
</div>

        <div class="col-md-9 goal-area justify-content-center">
            <form method="POST" action="{{ route('user.goal.update') }}">
                @csrf
                @method('PATCH')
                <div class="row ms-3 mb-2 mt-4 me-3">
                    <div class="col text-start">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <label for="goal" class="form-label h5 text-md-start">{{ __('What is your goal?') }}</label>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                  <?php
                                    $goal = optional($user_information)->goal;
                                    $lose_weight_selected = $goal === '1' ? 'selected' : '';
                                    $maintain_weight_selected = $goal === '2' ? 'selected' : '';
                                    $gain_weight_selected = $goal === '3' ? 'selected' : '';
                                      // $lose_weight_selected = $user_information->goal === '1' ? 'selected' : '';
                                      // $maintain_weight_selected = $user_information->goal === '2' ? 'selected' : '';
                                      // $gain_weight_selected = $user_information->goal === '3' ? 'selected' : '';
                                  ?>
                                  <select id="goal" name="goal" class="form-control form-select-lg">
                                      <option {{ $lose_weight_selected }} value="1">1: Lose weight</option>
                                      <option {{ $maintain_weight_selected }} value="2">2: Maintain weight</option>
                                      <option {{ $gain_weight_selected }} value="3">3: Gain weight</option>
                                  </select>
                              </div>
                              @error('goal')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                        </div>

                        <div class="row align-items-center mt-5">
                            <div class="col-5 text-start">
                                <label for="activity_level" class="form-label h5 text-md-start">{{ __('Activity Level : ') }}</label>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <?php
                                  $activity_level = isset($user_information) ? $user_information->activity_level : null;
                                  $low_selected = $activity_level === '1' ? 'selected' : '';
                                  $medium_selected = $activity_level === '2' ? 'selected' : '';
                                  $high_selected = $activity_level === '3' ? 'selected' : '';
                                    // $low_selected = $user_information->activity_level === '1' ? 'selected' : '';
                                    // $medium_selected = $user_information->activity_level === '2' ? 'selected' : '';
                                    // $high_selected = $user_information->activity_level === '3' ? 'selected' : '';
                                ?>
                                <select id="activity_level" name="activity_level" class="form-control form-select-lg">
                                    <option {{ $low_selected }} value="1">1: Low</option>
                                    <option {{ $medium_selected }} value="2">2: Medium</option>
                                    <option {{ $high_selected }} value="3">3: High</option>
                                </select>
                              </div>
                                @error('activity_level')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row align-items-center mt-5">
                            <div class="col-5 text-start">
                                <label for="how_to_lose" class="form-label h5 text-md-start">{{ __('How to achieve your goal?') }}</label>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <?php
                                  $how_to_lose = isset($user_information) ? $user_information->how_to_lose : null;

                                  $meal_selected = $how_to_lose === '1' ? 'selected' : '';
                                  $half_and_half_selected = $how_to_lose === '2' ? 'selected' : '';
                                  $workout_selected = $how_to_lose === '3' ? 'selected' : '';
                                    // $meal_selected = $user_information->how_to_lose === '1' ? 'selected' : '';
                                    // $half_and_half_selected = $user_information->how_to_lose === '2' ? 'selected' : '';
                                    // $workout_selected = $user_information->how_to_lose === '3' ? 'selected' : '';
                                ?>
                                <select id="how_to_lose" name="how_to_lose" class="form-control form-select-lg">
                                    <option {{ $meal_selected }} value="1">1: Meal</option>
                                    <option {{ $half_and_half_selected }} value="2">2: Half Meal & Half Workout</option>
                                    <option {{ $workout_selected }} value="3">3: Workout</option>
                                </select>
                              </div>
                              @error('how_to_lose')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                              @enderror
                            </div>
                        </div>
                        <div class="d-flex align-items-center container mt-5">
                          <div class="col-5 d-flex align-items-center">
                              <label for="update_weight" class="col-5 h5 text-md-start">{{ __("What's your current weight (kg) ?") }}</label><br>
                                <div class="col-4">
                                  <div class="form-group">
                                    <input type="number" name="latest_weight" id="latest_weight" value="{{ old('weight', $latest_weight) }}" min="30"  max="250" step="0.1" class="form-control form-select-lg">
                                    @error('update_weight')
                                      <p class="mb-0 text-danger small">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                          </div>
                          <div class="col-3 h5 ms-4">
                            <p>Current BMI = <span class="fw-bold"> {{ $bmi }} </span>
                            </p>
                          </div>

                          <div class="col-4 col h5 ms-4">
                            <p>Current BMI Judge= <span class="fw-bold"> {{ $bmi_judgement }} </span>
                            </p>
                          </div>
                        </div>

                        <div class="d-flex align-items-center container mt-5">
                          <div class="col-5 d-flex align-items-center">
                              <label for="goal_weight" class="col-5 h5 text-md-start">{{ __("What's your goal weight (kg) ?") }}</label><br>
                                <div class="col-4">
                                  <div class="form-group">
                                    <input type="number" name="goal_weight" id="goal_weight" value="{{ $user_information ? $user_information->goal_weight : '' }}" min="30"  max="250" step="0.1" class="form-control form-select-lg">
                                    @error('goal_weight')
                                      <p class="mb-0 text-danger small">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                          </div>
                          <div class="col-3 h5 ms-4">
                            <p>Goal BMI = <span class="fw-bold"> {{ $goal_bmi }} </span>
                            </p>
                          </div>

                          <div class="col-4 col h5 ms-4">
                            <p>Goal BMI Judge= <span class="fw-bold"> {{ $goal_bmi_judgement }} </span>
                            </p>
                          </div>
                        </div>

                        <div class="row align-items-center mt-5">
                          <div class="col-7 h5 text-md-start">
                            <p>When do you want to achieve your goal?</p>
                          </div>
                          <label for="goal_date" class="col-1 h5 text-md-start">{{ __('by ')  }}</label>
                          <div class="col-md-3">
                            <div class="form-group">
                              <input type="date" name="goal_date" id="goal_date" value="{{ old('goal_date', $user_information ? $user_information->goal_date : '') }}" class="form-control form-select-lg">
                                @error('goal_date')
                                  <p class="mb-0 text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row mb-2 mt-5 me-4">
                          <div class="col-md-3  offset-md-3">
                            <a href="{{ route('user.profile')}}" class="btn btn-secondary fw-bold mt-3 px-5">BACK</a>
                          </div>
                          <div class="col-md-3 offset-md-1">
                            @if (Route::has('user.goal.update'))
                              <a class="btn btn-warning fw-bold text-white mt-3 px-5" data-bs-toggle="modal" data-bs-target="#goal-change">{{ __('SAVE') }}
                              </a>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @include('user.modal.goal-change')
            </form>
        </div>
      </div>
    </div>
</div>
@endsection