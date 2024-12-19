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
                    <p class="fs-2 text-center fw-bold pt-5">The following food have been added</p>
                    <div class="card-text my-5 text-center">
                        @if (session('status') == 'success')
                            @foreach (session('item_names') as $index => $item_names)
                                <div class="row">
                                    <div class="col text-end fs-2">{{ $item_names }}</div>
                                    <div class="col text-center fs-2">{{ session('calories')[$index] }} kcal</div>
                                    @if (isset(session('images')[$index]) && session('images')[$index] != null)
                                        <div class="col text-center">
                                            <img src="{{ session('images')[$index] }}" alt="Saved Image" class="image-sm">
                                        </div>
                                    @else
                                        <div class="col text-center">
                                            <p class="my-0 fs-2">Not registered</p>
                                        </div>
                                    @endif
                                    <div class="col text-start fs-2">{{ session('amounts')[$index] }} </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 d-flex justify-content-center mb-4">
                <a href="{{ route('admin.food.registration.index') }}" class="btn btn-save">Back</a>
            </div>
        </div>
    </div>
@endsection
