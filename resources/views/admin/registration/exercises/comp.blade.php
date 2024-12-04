@extends('layouts.admin')

@section('title', 'Complete')

@section('content')
    <div class="container mt-5">
        <div class="card bg-white">
            <div class="card-header bg-white border-0">
                <h3 class="display-2 text-center fw-bold mt-4">Complete!</h3>
            </div>
            <div class="card-body d-flex justify-content-center my-4">
                <div class="bg-yellow w-75">
                    <p class="fs-2 text-center fw-bold pt-5">The following exercise have been added</p>
                    <div class="card-text my-5">
                        @if (session('status') == 'success')
                            @foreach (session('names') as $index => $name)
                                <div class="row">
                                    <div class="col text-end fs-2">{{ $name }}</div>
                                    <div class="col text-start fs-2">{{ session('calories')[$index] }} kcal</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 d-flex justify-content-center mb-4">
                <a href="{{ route('admin.exercise.registration.index') }}" class="btn btn-save">Back</a>
            </div>
        </div>
    </div>
@endsection
