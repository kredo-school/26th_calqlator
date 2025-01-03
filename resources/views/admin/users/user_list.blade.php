@extends('layouts.admin')

@section('title', 'UserList')

@section('content')
<div class="m-5 px-5">
    <div class="row">          
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="me-4 mb-0"><i class="fa-solid fa-user"></i> User List</h2>
                

 <!-- Search form -->
    <div class="search-container">
        <form action="" method="GET">
         <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search name..." value="">
               <button type="submit" class="btn btn-custom">
                 <i class="fas fa-search"></i>
                </button>
               </div>
            </form>
          </div>
     </div>

    <div class="user-table">
      <div class="sortable-table">
        <table class="table text-center mb-0 userlist" id="admin-table">
            <thead class="userlist">
                <tr>
                  <th id="id-header" class="sortable-table">ID<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                  <th id="fname-header" class="sortable-table">First Name<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                  <th id="lname-header" class="sortable-table">Last Name<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                  <th id="uname-header" class="sortable-table">User Name<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                  <th id="email-header" class="sortable-table">Email<span class="sort-arrow"><i class="fas fa-sort"></i></span></th>
                  <th></th>
                </tr>
            </thead>
        <tbody>
           @foreach($users as $user)                    
               <tr>
                  <td class="text-center">{{ $user->id }}</td>
                  <td>{{ $user->first_name }}</td>
                  <td>{{ $user->last_name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td></td>        
               </tr>
             @endforeach                  
        </tbody>
    </table>
     
  </div>

</div>

@endsection

