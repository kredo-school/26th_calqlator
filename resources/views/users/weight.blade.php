@extends('layouts.app')

@section('title', 'Weight Graph')

@section('background_image')

@section('content')
    {{-- <?php
        require('js/weight/function.php');
        $db = dbconnect();
        $stmt = $db->prepare("SELECT name, price FROM tests");
        $status = $stmt->execute();
        $stmt->bind_result($name, $price);
        $nameHoge = [];
        $priceHoge = [];
        while ($stmt->fetch()) { $nameHoge[] = $name; $priceHoge[] = $price; }
    ?> --}}

        <div class="col-12">
            <canvas id="weightGraph"></canvas>
        </div>

        <h2 class="text-center">Current weight: kg</h2>

        {{-- Temporary line graph. --}}
        <div>
            <canvas id="myLineChart"></canvas>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

            <script>
            var ctx = document.getElementById("myLineChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: ['8月1日', '8月2日', '8月3日', '8月4日', '8月5日', '8月6日', '8月7日'],
                datasets: [
                    {
                    data: [35, 34, 37, 35, 34, 35, 34, 25],
                    borderColor: "rgba(255,0,0,1)",
                    backgroundColor: "rgba(0,0,0,0)"
                    }
                ],
                },
                options: {
                scales: {
                    yAxes: [{
                    ticks: {
                        suggestedMax: 40,
                        suggestedMin: 0,
                        stepSize: 10,
                        callback: function(value, index, values){
                        return  value +  '度'
                        }
                    }
                    }]
                },
                }
            });
            </script>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/weight/weightGraph.js') }}"></script>

        <div class="">
            <div class="col-12 d-flex justify-content-around border rounded py-3">
                <button class="border-0 bg-light" onclick="updateChart('1w')">1週間</button>
                <button class="border-0 bg-light" onclick="updateChart('1m')">1ヶ月</button>
                <button class="border-0 bg-light" onclick="updateChart('3m')">3ヶ月</button>
                <button class="border-0 bg-light" onclick="updateChart('6m')">6ヶ月</button>
            </div>
        </div>
        
@endsection
