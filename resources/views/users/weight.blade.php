@extends('layouts.user')

@section('title', 'Weight Graph')

@section('background_image')

@section('content')

    <div class="container mt-5">

        @if ($todayWeight)
            <h2 class="text-center display-5">Current weight: {{ $todayWeight->weight }}kg</h2>
        @else
            <h2 class="text-center display-5">No weight data available for today</h2>
        @endif

        <div class="mt-3">
            <canvas id="weightChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
        <script src="{{ asset('js/weight.js') }}"></script>

        <div class="mt-5">
            <div class="col-12 d-flex justify-content-around button-group py-1">
                <button class="btn rounded click" id="btn-7d">1 week</button>
                <button class="btn rounded click" id="btn-1m">1 month</button>
                <button class="btn rounded click" id="btn-3m">3 months</button>
                <button class="btn rounded click" id="btn-6m">6 months</button>
            </div>
        </div>

    </div>
@endsection
