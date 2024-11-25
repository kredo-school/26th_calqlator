@extends('layouts.admin')

@section('title', 'Exercise Confirmation')

@section('content')
<div class="mt-5 px-5">
    <div class="row">
        <div class="left-side m-0 p-0">
            <h2>Exercise Confirmation</h2>

            <div class="confirmation-table sortable-table">
                <table class="table text-center mb-0 " id="admin-table">
                    <thead class="exercise-confirmation">
                        <tr>
                            <th id="id" class="sortable">ID <span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                            <th id="item_name" class="sortable">Name <span class="sort-arrow"> <i class="fas fa-sort"></i></span></th>
                            <th id="calories" class="sortable">Calories / 10min <span class="sort-arrow"> <i class="fas fa-sort"></i></span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending_exercises as $exercise)
                            <tr>
                                <td>{{ $exercise->id }}</td>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->calories }}</td>
                                <td>
                                    <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-exercise{{$exercise->id}}" >
                                        <i class="fa-solid fa-circle-check"></i> Confirm
                                    </button>

                                    <button class="btn p-0 ps-5 text-danger" data-bs-toggle="modal" data-bs-target="#delete-exercise{{$exercise->id}}">
                                        <i class="fa-solid fa-circle-minus"></i> Delete
                                    </button>
                                    @include('admin.confirmation.modals.exercise-actions')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right-side justify-content-center px-2 py-0">
                <form action="{{ route('admin.exercise.confirmation')}}" method="get">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-auto p-0">
                            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm m-0 p-0 w-100" placeholder="search exercises...">
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-sm btn-border border-secondary text-secondary mx-auto">Search</button>
                        </div>
                    </div>
                </form>
            
            <div class="confirmation-table">
                <table class="table text-center mb-0" >
                    <thead class="exercise-confirmation">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Calories</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($search_exercises as $exercise)
                            <tr>
                                <td>{{ $exercise->id }}</td>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->calories }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endSection