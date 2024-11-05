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
                   @forelse ($foods as $food)
                    <tr>
                    <td>{{ $food->id }}</td>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->calory }}</td>
                    <td>{{ $food->amount }}</td>
                    <td>
                        <button class="btn p-0 text-success" data-bs-toggle="modal" data-bs-target="#confirm-food{{$food->id}}" >
                            <i class="fa-solid fa-circle-check"></i> Edit
                        </button>
                        <button class="btn p-0 ps-5 text-danger" data-bs-toggle="modal" data-bs-target="#delete-food{{$food->id}}">
                            <i class="fa-solid fa-circle-minus"></i> Delete
                        </button>
                                            
                    <!-- pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $foods->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- success page -->
@if(session('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif
@endsection

@push('styles')
<style>
    .table th {
        background-color: #28a745;
        color: black;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>
@endpush

@push('scripts')
<script>
    
    setTimeout(function() {
        $('.toast').toast('hide');
    }, 3000);
</script>
@endpush