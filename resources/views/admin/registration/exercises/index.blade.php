
@extends('layouts.admin')
@section('title', 'Food Registration')
@section('content')
    <div class="container mt-5 px-5 w-75">
        <div class="row">
            <div class="col-auto mb-2">
                <h3 class="mb-0 fw-bold">Exercise Registration</h3>
            </div>
            <div class="col px-0">
                <a onclick=add() class="btn btn-sm click"><i class="fa-regular fa-plus"></i></a>
            </div>
        </div>
        <form action="{{ route('admin.exercise.registration.store') }}" method="post" id="all_form" enctype="multipart/form-data">
            @csrf
            <div id="input_row">
                <div class="row mt-4">
                    <label class="form-label fs-5 fw-bold green">No.1</label>
                    <div class="col-3 me-2">
                        <label for="name" class="form-label fw-bold">Exercise Name</label>
                        <input type="text" name="name[]" id="name" class="form-control custom-border" placeholder="ex) running" autofocus required>
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-3 me-2">
                        <label for="calory" class="form-label fw-bold">Calory per 10 minutes</label>
                        <div class="input-group d-flex align-items-center">
                            <input type="number" name="calories[]" id="calory" class="form-control custom-border w-50" placeholder="ex) 40" required>
                            <span class="input-group-append">kcal</span>
                        </div>
                        @error('calory')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-1 position">
                        <button type="button" class="btn del-btn" onclick="del(this)">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-75">
                <button type="submit" class="btn btn-save fw-bold mt-5 btn-lg">Save</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/exerciseReg.js') }}" defer></script>

@endsection
