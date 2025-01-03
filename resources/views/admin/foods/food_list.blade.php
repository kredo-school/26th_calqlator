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
            <div class="sortable-table">
              <table class="table text-center mb-0 foodlist" id="admin-table">
                <thead class="foodlist">
                    <tr>
                        <th class="sortable-table" style="width: 10%" id="id-header">ID<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 35%" id="name-header">Name<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 10%" id="calories-header">Calories<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 35%" id="amount-header">Amount<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 30%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($foods as $food)
                    <tr>

                    <td class="text-center">{{ $food->id }}</td>
                    <td>{{ $food->item_name }}</td>
                    <td>{{ $food->calories }}</td>
                    <td>{{ $food->amount }}</td>
                    <td>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#edit-food{{ $food->id }}" ><i class="fas fa-pencil"></i> 
                        </button>
                        <button class="btn p-0 ps-3 text-danger" data-bs-toggle="modal" data-bs-target="#delete-food{{ $food->id }}">
                            <i class="fa-solid fa-circle-minus"></i>
                        </button>
                        @include('admin.foods.modals.actions')
                    </div>
                </td>
            </tr>
            @endforeach
                </tbody>
              </table>
                                            
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection