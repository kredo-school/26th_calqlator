<div class="row border border-2 border-dark rounded-1 bg-white p-0 left-box">
    <div class="row mt-1">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-auto pe-0">
                        <a href="" class="fs-5 fw-bold text-center">Condition</a>
                    </div>
                    <div class="col text-start align-self-center fw-bold">
                        <span>  :
                            @if($condition !== null)
                                @if($condition->condition === 1)
                                😀
                                @elseif($condition->condition === 2)
                                😏
                                @elseif($condition->condition === 3)
                                😐
                                @elseif($condition->condition === 4)
                                😷
                                @elseif($condition->condition === 5)
                                😴
                                @endif
                            @else
                                No record
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                    <div class="row">
                    <div class="col-auto pe-0 align-self-center text-center">
                        <a href="" class="fs-5 fw-bold">Weight</a>
                    </div>
                    <div class="col text-start align-self-center fw-bold">
                        <span> :
                            @if($weight)
                                {{rtrim(rtrim(number_format($weight->weight,2), '0'), '.') }}kg
                            @else
                                No record 
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="m-0 mt-1">

        <input type="radio" id="page1" name="page" checked>
        <input type="radio" id="page2" name="page">
        {{-- <input type="radio" id="page3" name="page"> --}}

    <div class="container p-0 m-0">
        <div class="featured-wrapper">
            <ul class="featured-list my-3 p-0">
                <li>
                    <div>
                        <h4>Total Calories</h4>
                        <div class="chart-box">
                            <canvas id="caloriesChart"></canvas>
                        </div>
                        <p class="text-center fw-bold mb-0">
                            @if($goalCalories > $totalCalories)
                                <span class="text-primary border border-primary rounded-2 px-1">Remaining Calories</span><span class="text-primary fs-5"> {{$remainingCalories}} kcal</span>
                            @else
                                <span class="text-danger border border-danger rounded-2 px-1">Excess Calories</span><span class="text-danger fs-5"> {{$remainingCalories}} kcal</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-3">
                        <h4>Total Workout</h4>
                        <div class="chart-box">
                            <canvas id="workoutChart"></canvas>
                        </div>
                        <p class="text-center fw-bold mb-0">
                            @if($workoutGoal !== 0)
                                @if($workoutCalories > $workoutGoal)
                                    <span class="text-primary border border-primary rounded-2 px-1">Extra Calories Consumed</span><span class="text-primary fs-5"> {{$workoutCalories - $workoutGoal}} kcal</span>
                                @else
                                    <span class="text-danger border border-danger rounded-2 px-1">Remaining Calories</span><span class="text-danger fs-5"> {{$workoutGoal - $workoutCalories}} kcal</span>
                                @endif
                            @endif
                        </p>
                    </div>
                </li>

                <li>
                    <div>
                        <h4>Protien</h4>
                        <div class="chart-box">
                            <canvas id="proteinChart"></canvas>
                        </div>
                        <p class="text-center fw-bold mb-0">
                            @if($goalCalories > $totalCalories)
                                <span class="text-primary border border-primary rounded-2 px-1">Remaining Calories</span><span class="text-primary fs-5"> {{$goalCalories - $totalCalories}} kcal</span>
                            @else
                                <span class="text-danger border border-danger rounded-2 px-1">Excess Calories</span><span class="text-danger fs-5"> {{$totalCalories - $goalCalories}} kcal</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <h4>Fat</h4>
                        <div class="chart-box">
                            <canvas id="fatChart"></canvas>
                        </div>
                        <p class="text-center fw-bold mb-0">
                            @if($goalCalories > $totalCalories)
                                <span class="text-primary border border-primary rounded-2 px-1">Remaining Calories</span><span class="text-primary fs-5"> {{$goalCalories - $totalCalories}} kcal</span>
                            @else
                                <span class="text-danger border border-danger rounded-2 px-1">Excess Calories</span><span class="text-danger fs-5"> {{$totalCalories - $goalCalories}} kcal</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <h4>Carbon</h4>
                        <div class="chart-box">
                            <canvas id="carbsChart"></canvas>
                        </div>
                        <p class="text-center fw-bold mb-0">
                            @if($goalCalories > $totalCalories)
                                <span class="text-primary border border-primary rounded-2 px-1">Remaining Calories</span><span class="text-primary fs-5"> {{$goalCalories - $totalCalories}} kcal</span>
                            @else
                                <span class="text-danger border border-danger rounded-2 px-1">Excess Calories</span><span class="text-danger fs-5"> {{$totalCalories - $goalCalories}} kcal</span>
                            @endif
                        </p>
                    </div>
                        
                </li>

                {{-- <li>
                    <div>
                        <h4>Weight Graphs</h4>
                        <div>
                            <canvas id="weightChart"></canvas>
                        </div>
                    </div>
                </li> --}}
            </ul>
            <ul class="arrows">
                <li>
                    <label for="page1"></label>
                </li>
                <li>
                    <label for="page2"></label>
                </li>
                {{-- <li>
                    <label for="page3"></label>
                </li> --}}
            </ul>
            <ul class="circles">
                <li>
                    <label for="page1"></label>
                </li>
                <li>
                    <label for="page2"></label>
                </li>
                {{-- <li>
                    <label for="page3"></label>
                </li> --}}
            </ul>
        </div>
    </div> 
</div> 