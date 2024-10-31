@extends('layouts.admin')

@section('title', 'Food Confirmation')

@section('content')
<div class="m-5 px-5">
    <div class="row">
        <div class="col-9">
            <h2>Food Confirmation</h2>

            <div class="confirmation-table">
                <table class="table text-center mb-0">
                    <thead class="food-confirmation">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Calories</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending_foods as $food)
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td>{{ $food->item_name }}</td>
                                <td>{{ $food->calories }}</td>
                                <td>{{ $food->amount }}</td>
                                <td>
                                    <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-food{{$food->id}}" >
                                        <i class="fa-solid fa-circle-check"></i> Confirm
                                    </button>

                                    <button class="btn p-0 ps-5 text-danger" data-bs-toggle="modal" data-bs-target="#delete-food{{$food->id}}">
                                        <i class="fa-solid fa-circle-minus"></i> Delete
                                    </button>
                                    @include('admin.confirmation.modals.food-actions')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-3 justify-content-center p-0">
                <form action="{{ route('admin.food.confirmation')}}" method="get">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-auto p-0">
                            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm m-0 p-0 w-100" placeholder="search foods...">
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-sm btn-border border-secondary text-secondary mx-auto">Search</button>
                        </div>
                    </div>
                </form>
            
            <div class="confirmation-table">
                <table class="table text-center mb-0" >
                    <thead class="food-confirmation">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Calories</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($search_foods as $food)
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td>{{ $food->item_name }}</td>
                                <td>{{ $food->calories }}</td>
                                <td>{{ $food->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{ $pending_foods->links() }}
@endSection