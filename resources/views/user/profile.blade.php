@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">

    <div class="container">
        <div class="row justify-content-center profile-area">
            <div class="float-left">
                <div class="d-flex flex-column align-items-center m-5">
                    {{-- image --}}
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/avatar/'.Auth::user()->avatar)}}" alt="" class="avatar rounded-circle image-lg">
                    @else 
                        <i class="far fa-circle-user fa-10x"></i>
                    @endif
                </div>
            </div>

            <div class="float-right">

                <div class="start-date mt-3">
                    <h2 class="fw-bold">{{ Auth::user()->username }}</h2>
                    <h5>Start Date: {{ $user->created_at->format('d M, Y')}}</h5>
                </div>

                <div class="personal-details">
                    <table class="details">
                        <thead>
                            <tr>
                                <th>Age:</th>
                                <th>Height:</th>
                                <th>Current<br>Weight:</th>
                                <th>BMI:</th>
                                <th>BMI Judge:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $age }}</td>
                                <td>{{ $user->height }}</td>
                                <td>{{ $latest_weight }}</td>
                                <td>{{ $bmi }}</td>
                                <td>{{ $bmi_judgement }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="personal-table">
                <table class="table" style="border-collapse: collapse;">
                    <tr>
                        <td class="text-lg" style="border: none;">Weight change:  
                        <span class="{{ $weight_difference == 0 ? 'text-black' : ($weight_difference < 0 ? 'text-danger' : 'text-primary') }}">
                            {{ $weight_difference }}
                        </span> kg 
                        </td>
                        <td style="border: none;">
                        <div class="col-md-7 offset-md-1">
                            <a href="{{ route('weight')}}" class="btn progress-btn fw-bold btn-lg px-5 py-2">Progress</a>
                        </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-lg" style="border: none;">
                            Goal: 
                            @if($user->goal == 1)
                                <span>Lose Weight</span>
                            @elseif($user->goal == 2)
                                <span>Maintain Weight</span>
                            @elseif($user->goal == 3)
                                <span>Gain Weight</span>
                            @else
                                <span>No goal set</span>
                            @endif
                        </td>
                        <td style="border: none;">   
                        <div class="col-md-7 offset-md-1">
                            <a href="{{ route('user.goal')}}" class="btn goal-btn fw-bold btn-lg px-5 py-2">Your Goal</a>
                        </div>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
            <form action="{{ route('user.update')}}" method="post" enctype="multipart/form-data" style="text-align: right">
                    @csrf 
                    @method('PATCH')

                    <a href="{{ route('user.edit')}}" class="btn btn-link text-primary"><span class="text-lg">Edit Profile<span></a>
                    <i class="fa-solid fa-pen-to-square fa-2x text-primary mt-1"></i>
            </form> 
        </div>
    </div>
@endsection