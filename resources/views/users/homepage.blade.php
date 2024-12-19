@extends('layouts.user-homepage')

@section('title', 'Homepage')

@section('content')
    <div class="row scrollable">
        <div class="left-side">
            <div class="row mb-5 mx-3 icon-area">
                <div class="col-5 p-0">
                    <div class="row justify-content-center">
                        <img src="{{asset('/assets/images/today2.png')}}" class="today-img" alt="today">
                    </div>
                    <div class="row">
                        <img src="{{asset('/assets/images/santa3.png')}}" alt="character" class="character-img ">
                    </div>
                </div>
                <div class="col-7 p-0 border border-1 border-dark rounded-3 bg-white">
                    <div class="text-center">
                        <h2 class="h1 mt-5 mb-5 mb-0 welcome">Welcome!</h2>
                        <p class="fs-4">Today is</p>
                        <p class="fs-2 fw-bolder">{{ $titleDate }}</p>
                        <br>
                        <p class="fs-5">Let's record and keep healthy!!</p>
                    </div>
                </div>          
            </div>

            <div class="row mt-5">
                @include('users.homepage-left')
            </div>
        </div>


        <div class="mx-3 ms-auto right-side">
            @include('users.homepage-right')
        </div>
    </div>
@endsection
