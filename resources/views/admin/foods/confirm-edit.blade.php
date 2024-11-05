@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #28a745;">
                    <h5 class="mb-0">Confirm Edit</h5>
                </div>

                <div class="card-body">
                    <h5 class="mb-4 text-center">Please confirm the changes below:</h5>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="background-color: #28a745; color: white; width: 20%;">Field</th>
                                    <th style="background-color: #28a745; color: white; width: 40%;">Current Value</th>
                                    <th style="background-color: #28a745; color: white; width: 40%;">New Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="background-color: #f8f9fa;">Name</th>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ session('temp_data.name') }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa;">Calory</th>
                                    <td>{{ $food->calory }}</td>
                                    <td>{{ session('temp_data.calory') }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa;">Amount</th>
                                    <td>{{ $food->amount }} {{ $food->unit }}</td>
                                    <td>{{ session('temp_data.amount') }} {{ session('temp_data.unit') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <!-- 編集画面に戻る -->
                        <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-secondary">
                            Back to Edit
                        </a>

                        <!-- 更新を確定 -->
                        <form action="{{ route('admin.foods.update', $food->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- 一時保存データを隠しフィールドとして送信 -->
                            <input type="hidden" name="name" value="{{ session('temp_data.name') }}">
                            <input type="hidden" name="calory" value="{{ session('temp_data.calory') }}">
                            <input type="hidden" name="amount" value="{{ session('temp_data.amount') }}">
                            <input type="hidden" name="unit" value="{{ session('temp_data.unit') }}">
                            
                            <button type="submit" class="btn text-white" style="background-color: #28a745;">
                                Confirm Update
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

    .table th, .table td {
        vertical-align: middle;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .table th {
        font-weight: bold;
    }

    /* 値が変更された場合のハイライト */
    td:last-child:not(:empty) {
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    // 更新ボタンクリック時の二重送信防止
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = 'Updating...';
    });

    // 変更された値のハイライト
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const currentValue = row.children[1].textContent.trim();
            const newValue = row.children[2].textContent.trim();
            if (currentValue !== newValue) {
                row.children[2].style.backgroundColor = '#fff3cd';
            }
        });
    });
</script>
@endpush