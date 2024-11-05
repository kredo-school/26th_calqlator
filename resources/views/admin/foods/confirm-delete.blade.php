@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-dark">
                    <h5 class="mb-0">Delete the food</h5>
                </div>

                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                    </div>

                    <h5 class="mb-4">Are you sure you want to delete?</h5>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="background-color: #28a745; color: white; width: 30%;">Name</th>
                                    <td>{{ $food->name }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #28a745; color: white;">Calory</th>
                                    <td>{{ $food->calory }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #28a745; color: white;">Amount</th>
                                    <td>{{ $food->amount }} {{ $food->unit }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        
                        <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-header {
        background-color: #28a745 !important;
    }

    .table th {
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .text-warning {
        color: #ffc107 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = 'Deleting...';
    });
</script>
@endpush