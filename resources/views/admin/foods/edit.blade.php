@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #28a745;">
                    <h3 class="mb-0">Edit the Food</h3>
                    <h5>Are you sure you want to edit?</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.foods.update', $food->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="form-label" style="color: #28a745; font-weight: bold;">Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $food->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Calory Input -->
                        <div class="mb-4">
                            <label for="calory" class="form-label" style="color: #28a745; font-weight: bold;">Calory</label>
                            <input type="number" 
                                   class="form-control @error('calory') is-invalid @enderror" 
                                   id="calory" 
                                   name="calory" 
                                   value="{{ old('calory', $food->calory) }}"
                                   required>
                            @error('calory')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Amount Input -->
                        <div class="mb-4">
                            <label for="amount" class="form-label" style="color: #28a745; font-weight: bold;">Amount</label>
                            <div class="input-group">
                                <input type="number" 
                                   class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" 
                                   name="amount" 
                                   value="{{ old('amount', $food->amount) }}"
                                   required>
                                <select class="form-select @error('unit') is-invalid @enderror"
                                    name="unit"
                                    id="unit"
                                    style="max-width: 150px;">
                                  <option value="g" {{ old('unit', $food->unit) == 'g' ? 'selected' : '' }}>g</option>
                                  <option value="quantity" {{ old('unit', $food->unit) == 'quantity' ? 'selected' : '' }}>quantity</option>
                                  <option value="ml" {{ old('unit', $food->unit) == 'ml' ? 'selected' : '' }}>ml</option>
                                  <option value="one meal" {{ old('unit', $food->unit) == 'one meal' ? 'selected' : '' }}>one meal</option>
                            </select>
                        </div>
                            @error('amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn text-white" style="background-color: #28a745;">
                                Update Food
                            </button>
                        </div>
                    </form>
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
    
    .form-label {
        color: #28a745 !important;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
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
    // 数値入力フィールドの最小値を0に設定
    document.getElementById('calory').setAttribute('min', '0');
    document.getElementById('amount').setAttribute('min', '0');
</script>
@endpush