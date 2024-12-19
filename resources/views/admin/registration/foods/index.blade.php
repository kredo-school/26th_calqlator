@extends('layouts.admin')

@section('title', 'Food Registration')

@section('content')
    <div class="container mt-5 w-75">
        <div class="row">
            <div class="col-auto mb-2">
                <h3 class="mb-0 fw-bold">Food Registration</h3>
            </div>
            <div class="col px-0">
                <a onclick=add() class="btn btn-sm click"><i class="fa-regular fa-plus"></i></a>
            </div>
        </div>
        <form action="{{ route('admin.food.registration.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div id="input_row">
                <div class="row mt-4">
                    <label class="form-label fs-5 fw-bold green">No.1</label>
                    <div class="col-3">
                        <label for="name" class="form-label fw-bold">Food Name</label>
                        <input type="text" name="item_name[]" id="name" class="form-control custom-border" placeholder="ex) Banana" autofocus required>
                        @error('item_name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="image" class="form-label fw-bold">Image</label>
                        <input type="file" name="image[]" id="image" class="form-control" aria-describedby="image">
                        <div id="image" class="form-text text-muted">
                            <p class="my-0">Allowed formats: jpeg, jpg, png, gif.</p>
                            <p class="my-0">Maximum file size is 1048kb.</p>
                        </div>
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2">
                        <label for="calory" class="form-label fw-bold">Foods Calory</label>
                        <div class="input-group d-flex align-items-center">
                            <input type="number" name="calories[]" id="calory" class="form-control custom-border w-50" placeholder="ex) 40" required>
                            <span class="input-group-append">kcal</span>
                        </div>
                        @error('calory')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="amount" class="form-label fw-bold">Per Amount</label>
                        <input type="text" name="amount[]" id="amount" class="form-control custom-border" placeholder="ex) 1 per" aria-describedby="amount" required>
                        <small id="amount" class="form-text text-muted">Please also input the unit of measurement for the amount of ingredients.</small>
                        @error('amount')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn del-btn" onclick="del(this)">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-save fw-bold mt-5 btn-lg">Save</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/foodReg.js') }}" defer></script>
@endsection
