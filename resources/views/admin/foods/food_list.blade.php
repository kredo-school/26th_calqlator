@extends('layouts.admin')

@section('title','Foodlist')

@section('content')
<div class="m-5 px-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0"><i class="fa-light fa-bread-slice-butter"></i> Food List</h2>
                <div class="search-container">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search foods..." 
                                   value="">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

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
                    <td>name</td>
                    <td>calories</td>
                    <td>amount</td>
                    <td>
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-food" ><i class="fas fa-pencil"></i> Edit
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