@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- search form -->
        <div class="col-12 mb-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                <input type="text" 
                       name="search" 
                       class="form-control me-2" 
                       placeholder="Search by name, username, or email..." 
                       value="{{ $search }}">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form>
        </div>

        <!-- user list table -->
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white" style="background-color: #28a745;">
                    <h5 class="mb-0">User List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color: #28a745; color: white;">ID</th>
                                    <th style="background-color: #28a745; color: white;">First Name</th>
                                    <th style="background-color: #28a745; color: white;">Last Name</th>
                                    <th style="background-color: #28a745; color: white;">Username</th>
                                    <th style="background-color: #28a745; color: white;">Email</th>
                                    <th style="background-color: #28a745; color: white;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <!-- 編集ボタン -->
                                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    Edit
                                                </a>
                                                
                                                <!-- 削除ボタン -->
                                                <a href="{{ route('admin.users.confirm-delete', $user->id) }}" 
                                                   class="btn btn-sm btn-danger">
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No users found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- ページネーション -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 成功メッセージ表示 -->
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
    .card-header {
        background-color: #28a745 !important;
    }

    .table th {
        vertical-align: middle;
    }

    .table td {
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

    /* ページネーションのスタイル */
    .pagination {
        margin-bottom: 0;
    }

    .page-link {
        color: #28a745;
    }

    .page-item.active .page-link {
        background-color: #28a745;
        border-color: #28a745;
    }

    /* 検索フォームのスタイル */
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    // トーストメッセージの自動非表示
    setTimeout(function() {
        $('.toast').toast('hide');
    }, 3000);
</script>
@endpush