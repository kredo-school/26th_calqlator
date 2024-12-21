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
            <div class="sortable-table">
            <table class="table text-center mb-0 exerciselist" id="admin-table">
                <thead class="exerciselist">
                    <tr>
                        <th class="sortable-table" style="width: 10%" id="id-header">ID<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 30%; " id="name-header">Name<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 30%" id="calories-header">Calories/10 min<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                        <th class="sortable-table" style="width: 30%"></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($exercises as $exercise) 
                
                    <tr>
                    <td class="text-center">{{ $exercise->id }}</td>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->calories }}</td>
                    <td>
                    <div class="d-flex justify-content-center gap-1">
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#edit-exercise{{ $exercise->id }}" ><i class="fas fa-pencil"></i> 
                        </button>


                        <button class="btn p-0 ps-2 text-danger" data-bs-toggle="modal" data-bs-target="#delete-exercise{{ $exercise->id }}">
                            <i class="fa-solid fa-circle-minus"></i>
                        </button>
                        @include('admin.exercises.modals.actions')
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
@endsection