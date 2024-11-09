@extends('layouts.admin')

@section('title','Food List')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2><i class="fa-solid fa-utensils"></i>Food List</h2>

        <!-- food list table -->
        <div class="foodlist-table">
            <table class="table text-center mb-0">
                <thead class="foodlist">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Calories</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                    <td>id</td>
                    <td>Name</td>
                    <td>Calories</td>
                    <td>Amount</td>
                    <td>
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-food" >
                            <i class="fa-solid fa-circle-check"></i> Edit
                        </button>
                        <button class="btn p-0 ps-5 text-danger" data-bs-toggle="modal" data-bs-target="#delete-food">
                            <i class="fa-solid fa-circle-minus"></i> Delete
                        </button>
                                            
                    <!-- pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection