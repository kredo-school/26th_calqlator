@extends('layouts.admin')

@section('title','Exerciselist')

@section('content')
<div class="m-5 px-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0"><i class="fa-solid fa-dumbbell"></i> Exercise List</h2>
               
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

        <!-- exercise list table -->
        <div class="exerciselist-table">
            <table class="table text-center mb-0">
                <thead class="exerciselist">
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 25%">NAME</th>
                        <th style="width: 25%">CALORY/10 Minute</th>
                        <th style="width: 30%"></th>
                    </tr>
                </thead>
                <tbody>
                    
                
                    <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>calorie/10 minute</td>
                    <td>
                    <div class="d-flex justify-content-center gap-1">
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-food" ><i class="fas fa-pencil"></i> Edit
                        </button>
                        <button class="btn p-0 ps-2 text-danger" data-bs-toggle="modal" data-bs-target="#delete-food">
                            <i class="fa-solid fa-circle-minus"></i> Delete
                        </button>
                    </div>
                </td>
                                            
                    <!-- pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection