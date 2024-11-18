@extends('layouts.admin')

@section('title','Foodlist')

@section('content')
<div class="m-5 px-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0"><i class="fa-solid fa-utensils"></i> Food List</h2>

                <!-- search form-->
                <div class="search-container">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search name..." 
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
                        <th style="width: 20%">ID</th>
                        <th style="width: 25%">Name</th>
                        <th style="width: 25%">Calories</th>
                        <th style="width: 25%">Amount</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($foods as $food)
                    <tr>

                    <td class="text-center">{{ $food->id }}</td>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->calories }}</td>
                    <td>{{ $food->amount }}</td>
                    <td>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-food" ><i class="fas fa-pencil"></i> 
                        </button>
                        <button class="btn p-0 ps-3 text-danger" data-bs-toggle="modal" data-bs-target="#delete-food">
                            <i class="fa-solid fa-circle-minus"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
                                            
                    <!-- pagination -->
                    <div class="d-flex justify-content-center mt-4">  
                        {{ $foods->links() }}           
                      </div>    
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection