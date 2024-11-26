<div class="row border border-2 border-dark rounded-1 bg-white p-0 left-box">
    <div class="row mt-1">
        <div class="col-4">
        </div>
        <div class="col-8 pe-0 border-bottom border-1 border-dark">
            <a href="{{route('user.everyday.condition')}}" class="text-center fs-5">Today's Condition</a>
            @if($condition->condition === 1)
                <span class="condition-icon" value="smiley1" >😀</span>
            @elseif($condition->condition === 2)
                <span class="condition-icon" value="smiley2" >😏</span>
            @elseif($condition->condition === 3)
                <span class="condition-icon" value="smiley3" >😐</span>
            @elseif($condition->condition === 4)
                <span class="condition-icon" value="smiley4" >😷</span>
            @elseif($condition->condition === 5)
                <span class="condition-icon" value="smiley5" >😴</span>
            @endif
            {{-- @foreach($condition->icon as $icon)
                <span class="condition-icon" value="{{$icon->icon}}" >{{$icon->icon}}</span>
            @endforeach --}}
        </div>
    </div>

        <input type="radio" id="page1" name="page">
        <input type="radio" id="page2" name="page" checked>
        <input type="radio" id="page3" name="page">

    <div class="container p-0 m-0">
        <div class="featured-wrapper">
            <ul class="featured-list my-3 p-0">
                <li>
                    <div>
                        <h4>Total Calories</h4>
                        <div class="chart-box">
                            <canvas id="caloriesChart"></canvas>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h4>Total Workout</h4>
                        <div class="chart-box">
                            <canvas id="workoutChart"></canvas>
                        </div>
                    </div>
                </li>

                <li>
                    <div>
                        <h4>Protien</h4>
                        <div class="chart-box">
                            <canvas id="proteinChart"></canvas>
                        </div>
                    </div>
                    <div>
                        <h4>Carbon</h4>
                        <div class="chart-box">
                            <canvas id="carbsChart"></canvas>
                        </div>
                    </div>

                    <div>
                        <h4>Fat</h4>
                        <div class="chart-box">
                            <canvas id="fatChart"></canvas>
                        </div>
                    </div>
                </li>

                <li>
                    <div>
                        <h4>Weight Graphs</h4>
                        <div class="">
                            <canvas id="weightChart"></canvas>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="arrows">
                <li>
                    <label for="page1"></label>
                </li>
                <li>
                    <label for="page2"></label>
                </li>
                <li>
                    <label for="page3"></label>
                </li>
            </ul>
            <ul class="circles">
                <li>
                    <label for="page1"></label>
                </li>
                <li>
                    <label for="page2"></label>
                </li>
                <li>
                    <label for="page3"></label>
                </li>
            </ul>
        </div>
    </div> 
</div> 