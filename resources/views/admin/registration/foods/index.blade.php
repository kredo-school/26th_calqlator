@extends('layouts.admin')

@section('title', 'Food Registration')

@section('content')
    <div class="px-5 mt-5 ms-5">
        <div class="row">
            <div class="col-auto mb-2">
                <h3 class="mb-0 fw-bold">Food Registration</h3>
            </div>
            <div class="col px-0">
                <a onclick=add() class="btn btn-sm click"><i class="fa-regular fa-plus"></i></a>
            </div>
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf

            <div id="input_row">
                <div class="row mt-4">
                    <label class="form-label fs-5 fw-bold green">No.1</label>
                    <div class="col-2 me-2">
                        <label for="name" class="form-label fw-bold">Food Name</label>
                        <input type="text" name="item_name" id="name" class="form-control custom-border" placeholder="ex) Banana" autofocus>
                        @error('item_name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2 me-2">
                        <label for="image" class="form-label fw-bold">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2 me-2">
                        <label for="calory" class="form-label fw-bold">Foods Calory</label>
                        <div class="input-group d-flex align-items-center">
                            <input type="number" name="calories" id="calory" class="form-control custom-border w-50" placeholder="ex) 40">
                            <span class="input-group-append">kcal</span>
                        </div>
                        @error('calory')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2">
                        <label for="amount" class="form-label fw-bold">Per Amount</label>
                        <div class="input-group">
                            <input type="number" name="amount" id="amount" class="form-control custom-border" placeholder="ex) 1">
                            <select class="input-group-append form-select ms-2" aria-label="Default select example">
                                <option selected disabled>Select unite</option>
                                <option value="g">g</option>
                                <option value="ml">ml</option>
                                <option value="quantity">quantity</option>
                                <option value="one_meal">one meal</option>
                            </select>
                        </div>
                        @error('amount')
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
    <script src="{{ asset('js/registration.js') }}" defer></script>
@endsection
