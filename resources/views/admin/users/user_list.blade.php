@extends('layouts.admin')

@section('title', 'User List')

@section('content')
<div class="m-5 px-5">
    <div class="row">          
        <div class="col-12">
            <h2><i class="fa-regular fa-user"></i> User List</h2>
                </div>

        <section class="content">
            <div class="row mb-4">
                <!-- Search form -->
                <div class="col-md-6">
                    <form action="" method="GET" class="d-flex gap-2">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Search users..." 
                               value="">
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center header-cell" style="width: 80px;">ID</th>
                                    <th class="header-cell">First Name</th>
                                    <th class="header-cell">Last Name</th>
                                    <th class="header-cell">User Name</th>
                                    <th class="header-cell">Email</th>
                                    <th class="text-center header-cell" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="text-center">id</td>
                                        <td>First Name</td>
                                        <td>Last Name</td>
                                        <td>User Name</td>
                                        <td>Email</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                           </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">No users found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                
            </div>
        </section>
    </div>
</div>

@push('styles')
<style>
    .content-wrapper {
        margin-left: 250px;
        margin-top: 60px;
        padding: 20px;
        background-color: #fffcf7;
        min-height: calc(100vh - 60px);
    }

    .header-cell {
        background-color: #c9e2ac !important;
        color: black !important;
        border: 1px solid black !important;
        vertical-align: middle;
    }
</style>
@endpush
@endsection