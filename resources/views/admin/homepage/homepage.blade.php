@extends('layouts.admin')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <a href="{{ route('admin.users.list') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-green">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center ">
                                    <i class="fa-solid fa-users"></i>
                                    <p class="fs-3 mb-0">Users</p>
                                </div>
                                <div class="col d-flex align-items-center ">
                                    {{ $users }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.foods.food_list') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 food-yellow">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center ">
                                    <i class="fa-solid fa-plate-wheat"></i>
                                    <p class="fs-3 mb-0">Foods</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    {{ $foods }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.exercises.list') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-blue">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-person-running"></i>
                                    <p class="fs-3 mb-0">Exercises</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    {{ $exercises }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{{ route('admin.faqlist.index') }}}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-red">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                    <p class="fs-3 mb-0 mt-1">FAQ</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    {{ $faqs }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <a href="{{ route('admin.food.confirmation') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-4 border-yellow">
                        <div class="card-body my-3 mx-2">
                            <div class="row text-center">
                                <div class="col text-center">
                                    <p class="fs-3 mb-0">Food Confirmation</p>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col fa-stack size">
                                    <i class="fa-solid fa-comment fa-stack-2x"></i>
                                    <p class="text-white m-0 fa-stack-1x">{{ $foodConfirmations }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.exercise.confirmation') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-4 border-blue">
                        <div class="card-body my-3 mx-2">
                            <div class="row text-center">
                                <div class="col text-center ">
                                    <p class="fs-3 mb-0">Exercise Confirmation</p>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col fa-stack size">
                                    <i class="fa-solid fa-comment fa-stack-2x"></i>
                                    <p class="text-white m-0 fa-stack-1x">{{ $exerciseConfirmations }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('chat.adminChat') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-4 border-green">
                        <div class="card-body my-3 mx-2">
                            <div class="row text-center">
                                <div class="col text-center">
                                    <p class="fs-3 mb-0">Chat with Users</p>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col fa-stack size">
                                    <i class="fa-solid fa-comment fa-stack-2x"></i>
                                    <p class="text-white m-0 fa-stack-1x">{{ $questions }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-3">
                <a href="{{ route('admin.food.registration.index') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 food-yellow circle">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-plate-wheat"></i>
                                    <p class="fs-3 mb-0">Food Registration</p>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.exercise.registration.index') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-blue circle">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-person-running"></i>
                                    <p class="fs-3 mb-0">Exercise Registration</p>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.faqregistration.index') }}" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-red circle">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row align-items-center">
                                <div class="col text-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                    <p class="fs-3 mb-0">FAQ Registration</p>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
