@extends('layouts.homepage')

@section('title', 'Homepage')

@section('content')
    <div class="row scrollable">
        <div class="left-side">
            <div class="row mb-5 mx-3 icon-area">
                <div class="col-5 p-0">
                    <div class="row justify-content-center">
                        <img src="assets/images/today2.png" class="today-img" alt="today">
                    </div>
                    <div class="row">
                        <img src="assets/images/character.png" alt="character" class="character-img ">
                    </div>
                </div>
                <div class="col-7 p-0 border border-1 border-dark rounded-3 bg-white">
                </div>                
            </div>

            <div class="row mt-5">
                <div class="border border-2 border-dark rounded-1 bg-white left-box">
                    <div class="row mt-1">
                        <div class="col-4">
                        </div>
                        <div class="col-8 border-bottom border-1 border-dark">
                            <a href="" class="text-center">Today's Condition</a>
                        </div>
                    </div>

                    {{-- <div class="row mt-3">
                        <div class="col-6 border-bottom border-2 border-dark">
                            <h3 class="text-start mb-0 fw-bolder">Total Calories</h3>
                        </div>
                        <div class="" style="height: 70px">
                            <img src="" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 border-bottom border-2 border-dark mt-0">
                            <h3 class="text-start mb-0 fw-bolder">Total Workout</h3>
                        </div>
                        <div class="" style="height: 70px">
                            <img src="" alt="">
                        </div>
                    </div> --}}
                    

                </div>
            </div>
        </div>


        <div class="mx-3 ms-auto right-side" >
            <div>
                <img src="assets/images/mealworkout.png" alt="meal&workout" class="meal-work-img">
            </div>

            <div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
                <div class="row p-0">
                    <div class="col-3 border-end border-1 border-dark text-center">
                        <h4 class="h5 fw-bolder mt-4">Breakfast</h4>
                        <img src="" alt="">
                        <p>Time</p>
                    </div>
                    <div class="col justify-content-center text-center">
                        <table class="table border-bottom border-1 border-dark mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Calories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- @if() --}}
                            {{-- @forelse() --}}
                                <tbody>
                                    <tr>
                                        <td>image</td>
                                        <td>item name</td>
                                        <td>amount</td>
                                        <td>calories</td>
                                        <td><i class="fa-solid fa-circle-minus text-danger"></i></td>
                                    </tr>
                                </tbody>
                            {{-- @else --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4">Please enter your meal</td>
                                        <td>
                                            <a href="" class="btn btn-sm text-decoration-none">
                                                <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            {{-- @endforelse --}}
                        </table>
                            {{-- @if() --}}
                                <a href="" class="btn btn-sm">
                                    <i class="fa-solid fa-circle-plus"></i> Add
                                </a>
                            {{-- @endif --}}
                    </div>
                </div>
                <div class="row border-top border-1 border-dark p-0">
                    <p class="text-center fw-bolder my-1">Total kcal</p>
                </div>
            </div>

            <div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
                <div class="row p-0">
                    <div class="col-3 border-end border-1 border-dark text-center">
                        <h4 class="h5 fw-bolder mt-4">Lunch</h4>
                        <img src="" alt="">
                        <p>Time</p>
                    </div>
                    <div class="col justify-content-center text-center">
                        <table class="table border-bottom border-1 border-dark mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Calories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- @forelse() --}}
                                <tbody>
                                    <tr>
                                        <td>image</td>
                                        <td>item name</td>
                                        <td>amount</td>
                                        <td>calories</td>
                                        <td><i class="fa-solid fa-circle-minus text-danger"></i></td>
                                    </tr>
                                </tbody>
                            {{-- @else --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4">Please enter your meal</td>
                                        <td>
                                            <a href="" class="btn btn-sm text-decoration-none">
                                                <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            {{-- @endforelse --}}
                        </table>

                        {{-- @if() --}}
                            <a href="" class="btn btn-sm">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="row border-top border-1 border-dark p-0">
                    <p class="text-center fw-bolder my-1">Total kcal</p>
                </div>
            </div>

            <div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
                <div class="row p-0">
                    <div class="col-3 border-end border-1 border-dark text-center">
                        <h4 class="h5 fw-bolder mt-4">Dinner</h4>
                        <img src="" alt="">
                        <p>Time</p>
                    </div>
                    <div class="col justify-content-center text-center">
                        <table class="table border-bottom border-1 border-dark mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Calories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- @forelse() --}}
                                <tbody>
                                    <tr>
                                        <td>image</td>
                                        <td>item name</td>
                                        <td>amount</td>
                                        <td>calories</td>
                                        <td><i class="fa-solid fa-circle-minus text-danger"></i></td>
                                    </tr>
                                </tbody>
                            {{-- @else --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4">Please enter your meal</td>
                                        <td>
                                            <a href="" class="btn btn-sm text-decoration-none">
                                                <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            {{-- @endforelse --}}
                        </table>

                        {{-- @if() --}}
                            <a href="" class="btn btn-sm">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="row border-top border-1 border-dark p-0">
                    <p class="text-center fw-bolder my-1">Total kcal</p>
                </div>
            </div>

            <div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
                <div class="row p-0">
                    <div class="col-3 border-end border-1 border-dark text-center">
                        <h4 class="h5 fw-bolder mt-4">Snack</h4>
                        <img src="" alt="">
                    </div>
                    <div class="col justify-content-center text-center">
                        <table class="table border-bottom border-1 border-dark mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Calories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- @forelse() --}}
                                <tbody>
                                    <tr>
                                        <td>image</td>
                                        <td>item name</td>
                                        <td>amount</td>
                                        <td>calories</td>
                                        <td><i class="fa-solid fa-circle-minus text-danger"></i></td>
                                    </tr>
                                </tbody>
                            {{-- @else --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4">Please enter snacks you ate</td>
                                        <td>
                                            <a href="" class="btn btn-sm text-decoration-none">
                                                <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            {{-- @endforelse --}}
                        </table>

                        {{-- @if() --}}
                            <a href="" class="btn btn-sm">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="row border-top border-1 border-dark p-0">
                    <p class="text-center fw-bolder my-1">Total kcal</p>
                </div>
            </div>

            <div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
                <div class="row p-0">
                    <div class="col-3 border-end border-1 border-dark text-center">
                        <h4 class="h5 fw-bolder mt-4">Supplement</h4>
                        <img src="" alt="">
                    </div>
                    <div class="col justify-content-center text-center">
                        <table class="table border-bottom border-1 border-dark mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Calories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- @forelse() --}}
                                <tbody>
                                    <tr>
                                        <td>image</td>
                                        <td>item name</td>
                                        <td>amount</td>
                                        <td>calories</td>
                                        <td><i class="fa-solid fa-circle-minus text-danger"></i></td>
                                    </tr>
                                </tbody>
                            {{-- @else --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4">Please enter the supplement you took</td>
                                        <td>
                                            <a href="" class="btn btn-sm text-decoration-none">
                                                <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            {{-- @endforelse --}}
                        </table>

                        {{-- @if() --}}
                            <a href="" class="btn btn-sm">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="row border-top border-1 border-dark p-0">
                    <p class="text-center fw-bolder my-1">Total kcal</p>
                </div>
            </div>

            <div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
                <div class="row p-0">
                    <div class="col-3 border-end border-1 border-dark text-center">
                        <h4 class="h5 fw-bolder mt-4">Workout</h4>
                        <img src="" alt="">
                    </div>
                    <div class="col justify-content-center text-center">
                        <table class="table border-bottom border-1 border-dark mb-0">
                            <thead>
                                <tr>
                                    <th>Exercise</th>
                                    <th>Time</th>
                                    <th>Calories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            {{-- @forelse() --}}
                                <tbody>
                                    <tr>
                                        <td>Exercise name</td>
                                        <td>exercise time</td>
                                        <td>calories</td>
                                        <td><i class="fa-solid fa-circle-minus text-danger"></i></td>
                                    </tr>
                                </tbody>
                            {{-- @else --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4">Please enter your workout menu</td>
                                        <td>
                                            <a href="" class="btn btn-sm text-decoration-none">
                                                <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            {{-- @endforelse --}}
                        </table>

                        {{-- @if() --}}
                            <a href="" class="btn btn-sm">
                                <i class="fa-solid fa-circle-plus"></i> Add
                            </a>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="row border-top border-1 border-dark p-0">
                    <p class="text-center fw-bolder my-1">Total kcal</p>
                </div>
            </div>
        </div>
    </div>
@endsection
