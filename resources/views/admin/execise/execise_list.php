@extends('layouts.admin')

@section('title', 'Exercise List')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <!-- 検索フォーム -->
        <div class="col-md-6">
            <form action="{{ route('admin.exercises.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Search exercises..." 
                       value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-custom">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <!-- 新規登録ボタン -->
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.exercises.create') }}" class="btn btn-custom">
                <i class="fas fa-plus"></i> Add New Exercise
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Exercise List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center header-cell" style="width: 80px;">ID</th>
                            <th class="header-cell">Exercise Name</th>
                            <th class="header-cell">Calories (10min)</th>
                            <th class="text-center header-cell" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exercises as $exercise)
                            <tr>
                                <td class="text-center">{{ $exercise->id }}</td>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->calories_per_10min }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- 編集ボタン -->
                                        <a href="{{ route('admin.exercises.edit', $exercise->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- 削除ボタン -->
                                        <button type="button" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $exercise->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- 削除確認モーダル -->
                                    <div class="modal fade" id="deleteModal{{ $exercise->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete exercise: <strong>{{ $exercise->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.exercises.destroy', $exercise->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-running fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No exercises found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ページネーション -->
    <div class="d-flex justify-content-center mt-4">
        {{ $exercises->links() }}
    </div>
</div>
@endsection