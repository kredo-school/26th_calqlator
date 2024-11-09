@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-green">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center ">
                                    <i class="fa-solid fa-users"></i>
                                    <p class="fs-3 mb-0">Users</p>
                                </div>
                                <div class="col d-flex align-items-center ">
                                    {{ $users->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-yellow">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center ">
                                    <i class="fa-solid fa-plate-wheat"></i>
                                    <p class="fs-3 mb-0">Foods</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    {{ $foods->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-blue">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-person-running"></i>
                                    <p class="fs-3 mb-0">Exercises</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    {{ $exercises->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-red">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-circle-question"></i>
                                    <p class="fs-3 mb-0 mt-1">FAQ</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    {{ $faqs->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-4 border-yellow">
                        <div class="card-body my-3 mx-2">
                            <div class="row text-center">
                                <div class="col text-center">
                                    <p class="fs-3 mb-0">Food Confirmation</p>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col fa-stack">
                                    <i class="fa-solid fa-comment fa-stack-2x size"></i>
                                    <p class="text-white m-0 fa-stack-1x pt-2">{{ $faqs->count() }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-4 border-blue">
                        <div class="card-body my-3 mx-2">
                            <div class="row text-center">
                                <div class="col text-center ">
                                    <p class="fs-3 mb-0">Exercise Confirmation</p>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col fa-stack">
                                    <i class="fa-solid fa-comment fa-stack-2x size"></i>
                                    <p class="text-white m-0 fa-stack-1x pt-2">{{ $faqs->count() }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-4 border-green">
                        <div class="card-body my-3 mx-2">
                            <div class="row text-center">
                                <div class="col text-center">
                                    <p class="fs-3 mb-0">Exercise Confirmation</p>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col fa-stack">
                                    <i class="fa-solid fa-comment fa-stack-2x size"></i>
                                    <p class="text-white m-0 fa-stack-1x pt-2">{{ $faqs->count() }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-3">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
                    <div class="card shadow border-0 bg-yellow circle">
                        <div class="card-body my-3 mx-auto text-white">
                            <div class="row">
                                <div class="col text-center">
                                    <i class="fa-solid fa-plate-wheat"></i>
                                    <p class="fs-3 mb-0">Food Registration</p>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
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
                <a href="#" class="text-decoration-none fw-bold display-5 d-block">
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
