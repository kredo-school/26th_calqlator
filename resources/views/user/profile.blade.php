@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="background-color: #f5f5f5">
            <div class="float-left">
                <div class="d-flex flex-column align-items-center m-5">
                    {{-- image --}}
                    @if($user->avatar)
                        <img src="{{ asset('storage/avatars/'.Auth::user()->avatar)}}" alt="" class="avatar rounded-circle image-lg">
                    @else 
                        <i class="far fa-circle-user fa-10x"></i>
                    @endif
                </div>
            </div>

            <div class="float-right">

                <div class="start-date">
                    <h2 class="fw-bold">{{ $user->name }}</h2>
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
                                <td>165cm</td>
                                <td>60kg</td>
                                <td>22</td>
                                <td>Normal</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="personal-table">
                    <table class="table">
                          <tr>
                            <td class="text-lg">5.0 kg weight loss</td>
                            <td>
                                <div class="col-md-6 offset-md-1">
                                    <a href="{{ route('user.home.weight.chart')}}" class="btn btn-warning fw-bold text-white">Progress</a>
                                </div>
                            </td>
                          </tr>

                          <tr>
                            <td class="text-lg">Goal: Lose Weight</td>
                            <td>   
                                <div class="col-md-6 offset-md-1">
                                    <a href="{{ route('user.goal')}}" class="btn btn-warning fw-bold text-white">Your Goal</a>
                                </div></td>
                          </tr>
                    </table>
                </div>
            </div>
            <form action="{{ route('user.update')}}" method="post" enctype="multipart/form-data" style="text-align: right">
                    @csrf 
                    @method('PATCH')

                    <a href="{{ route('user.edit')}}" class="btn btn-link text-primary"><span class="text-lg">Edit Profile<span></a>
                    <i class="fa-solid fa-pen-to-square fa-2x text-primary mt-3"></i>
            </form>
        </div>
    </div>
@endsection