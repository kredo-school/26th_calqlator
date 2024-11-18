<div>
    <img src="../assets/images/mealworkout.png" alt="meal&workout" class="meal-work-img">
</div>

<div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
    <div class="row p-0 custom-flex-align">
        <div class="col-3 border-end border-1 border-dark text-center">
            <h4 class="h5 fw-bolder mt-2">Breakfast</h4>
            <img src="../assets/images/breakfast1.jpg" alt="breakfast" class="icon-img">
            @if($breakfastTime && $breakfastTime->time_eaten)
                <p class="mt-2 mb-0 fs-5">{{$breakfastTime->time_eaten}}</p>
            @else
                <p class="mt-2 mb-0 fs-5">Time eaten</p>
            @endif
        </div>
        <div class="col justify-content-center text-center table-container">
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
                @forelse($breakfasts as $breakfast)
                    <tbody>
                        <tr>
                            <td>{{ $breakfast->food->image }}</td>
                            <td>{{ $breakfast->food->item_name }}</td>
                            <td>{{ number_format($breakfast->amount) }}</td>
                            <td>{{$breakfast->food->calories * $breakfast->amount}} kcal</td>
                            <td>
                                <form action="{{ route('user.breakfast.delete', $breakfast->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                 @empty
                    <tbody>
                        <tr>
                            <td colspan="4">Please enter your meal</td>
                            <td>
                                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                                    <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
            @if($breakfasts)
                <a href="" class="btn btn-sm fs-5 fw-bold">
                    <i class="fa-solid fa-circle-plus"></i> Add
                </a>
            @endif
        </div>
    </div>
    <div class="row border-top border-1 border-dark p-0">
        <p class="text-center fw-bolder my-1 fs-5">Total : {{$breakfastCalories}} kcal</p>
    </div>
</div>

<div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
    <div class="row p-0 custom-flex-align">
        <div class="col-3 border-end border-1 border-dark text-center">
            <h4 class="h5 fw-bolder mt-2">Lunch</h4>
            <img src="../assets/images/lunch2.jpg" alt="lunch" class="icon-img">
            @if($lunchTime && $lunchTime->time_eaten)
                <p class="m-0">{{$lunchTime->time_eaten}}</p>
            @else
                <p class="mt-2 mb-0 fs-5">Time eaten</p>
            @endif
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
                @forelse($lunches as $lunch)
                    <tbody>
                        <tr>
                            <td>{{ $lunch->food->image }}</td>
                            <td>{{ $lunch->food->item_name }}</td>
                            <td>{{ number_format($lunch->amount) }}</td>
                            <td>{{$lunch->food->calories * $lunch->amount}} kcal</td>
                            <td>
                                <form action="{{ route('user.lunch.delete', $lunch->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4">Please enter your meal</td>
                            <td>
                                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                                    <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
            @if($lunches)
                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                    <i class="fa-solid fa-circle-plus"></i> Add
                </a>
            @endif
        </div>
    </div>
    <div class="row border-top border-1 border-dark p-0">
        <p class="text-center fw-bolder my-1 fs-5">Total : {{$lunchCalories}} kcal</p>
    </div>
</div>

<div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
    <div class="row p-0 custom-flex-align">
        <div class="col-3 border-end border-1 border-dark text-center">
            <h4 class="h5 fw-bolder mt-2">Dinner</h4>
            <img src="../assets/images/dinner1.jpg" alt="dinner" class="icon-img">
            @if($dinnerTime && $dinnerTime->time_eaten)
                <p class="m-0">{{$dinnerTime->time_eaten}}</p>
            @else
                <p class="mt-2 mb-0 fs-5">Time eaten</p>
            @endif
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
                @forelse($dinners as $dinner)
                    <tbody>
                        <tr>
                            <td>{{ $dinner->food->image }}</td>
                            <td>{{ $dinner->food->item_name }}</td>
                            <td>{{ number_format($dinner->amount) }}</td>
                            <td>{{ $dinner->food->calories * $dinner->amount}} kcal</td>
                            <td>
                                <form action="{{ route('user.dinner.delete', $dinner->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4">Please enter your meal</td>
                            <td>
                                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                                    <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
            @if($dinners)
                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                    <i class="fa-solid fa-circle-plus"></i> Add
                </a>
            @endif
        </div>
    </div>
    <div class="row border-top border-1 border-dark p-0">
        <p class="text-center fw-bolder my-1 fs-5">Total : {{$dinnerCalories}} kcal</p>
    </div>
</div>

<div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
    <div class="row p-0 custom-flex-align">
        <div class="col-3 border-end border-1 border-dark text-center">
            <h4 class="h5 fw-bolder mt-2">Snack</h4>
            <img src="../assets/images/snack1.jpg" alt="snack" class="icon-img">
            @if($snackTime && $snackTime->time_eaten)
                <p class="mt-2 mb-0 fs-5">{{$snackTime->time_eaten}}</p>
            @else
                <p class="mt-2 mb-0 fs-5">Time eaten</p>
            @endif
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
                @forelse($snacks as $snack)
                    <tbody>
                        <tr>
                            <td>{{ $snack->food->image }}</td>
                            <td>{{ $snack->food->item_name }}</td>
                            <td>{{ number_format($snack->amount) }}</td>
                            <td>{{ $snack->food->calories * $snack->amount}} kcal</td>
                            <td>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4">Please enter snacks you ate</td>
                            <td>
                                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                                    <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>

            @if($snacks)
                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                    <i class="fa-solid fa-circle-plus"></i> Add
                </a>
            @endif
        </div>
    </div>
    <div class="row border-top border-1 border-dark p-0">
        <p class="text-center fw-bolder my-1 fs-5">Total : {{$snackCalories}} kcal</p>
    </div>
</div>

<div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
    <div class="row p-0 custom-flex-align">
        <div class="col-3 border-end border-1 border-dark text-center">
            <h4 class="h5 fw-bolder mt-2">Supplement</h4>
            <img src="../assets/images/supplement1.jpg" alt="supplement" class="icon-img">
            @if($supplementTime && $supplementTime->time_eaten)
                <p class="mt-2 mb-0 fs-5">{{$supplementTime->time_eaten}}</p>
            @else
                <p class="mt-2 mb-0 fs-5">Time taken</p>
            @endif
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
                @forelse($supplements as $supplement)
                    <tbody>
                        <tr>
                            <td>{{ $supplement->food->image }}</td>
                            <td>{{ $supplement->food->item_name }}</td>
                            <td>{{ number_format($supplement->amount) }}</td>
                            <td>{{ $supplement->food->calories * $supplement->amount}} kcal</td>
                            <td>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4">Please enter supplements you took</td>
                            <td>
                                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                                    <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>

            @if($supplements)
                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                    <i class="fa-solid fa-circle-plus"></i> Add
                </a>
            @endif
        </div>
    </div>
    <div class="row border-top border-1 border-dark p-0">
        <p class="text-center fw-bolder my-1 fs-5">Total : {{$supplementCalories}} kcal</p>
    </div>
</div>

<div class="row border border-1 border-dark rounded-1 justify-content-center m-0 mb-4 bg-white">
    <div class="row p-0 custom-flex-align">
        <div class="col-3 border-end border-1 border-dark text-center">
            <h4 class="h5 fw-bolder mt-2">Workout</h4>
            <img src="../assets/images/workout1.jpg" alt="workout" class="icon-img">
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
                @forelse($workouts as $workout)
                    <tbody>
                        <tr>
                            <td>{{ $workout->exercise->name }}</td>
                            <td>{{number_format($workout->time) }} min</td>
                            <td>{{ $workout->exercise->calories * ($workout->time)/10}} kcal</td>
                            <td>
                                <form action="{{ route('user.workout.delete', $workout->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4">Please enter your workout menu</td>
                            <td>
                                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                                    <i class="fa-solid fa-circle-plus text-dark"></i> Add
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
            @if($workouts)
                <a href="" class="btn btn-sm text-decoration-none fs-5 fw-bold">
                    <i class="fa-solid fa-circle-plus"></i> Add
                </a>
            @endif
        </div>
    </div>
    <div class="row border-top border-1 border-dark p-0">
        <p class="text-center fw-bolder my-1 fs-5">Total : {{$workoutCalories}} kcal</p>
    </div>
</div>
