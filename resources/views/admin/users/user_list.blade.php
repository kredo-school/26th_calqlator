@extends('layouts.admin')

@section('title', 'UserList')

@section('content')
<div class="m-5 px-5">
    <div class="row">          
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="me-4 mb-0"><i class="fa-regular fa-user"></i> User List</h2>
                

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
        <table class="table text-center mb-0">
            <thead class="userlist">
                <tr>
                  <th>ID</th>
                  <th>FIRST NAME</th>
                  <th>LAST NAME</th>
                  <th>USER NAME</th>
                  <th>EMAIL</th>
                  <th></th>
                </tr>
            </thead>
        <tbody>
           @foreach($users as $user)                    
               <tr>
                  <td class="text-center">{{ $user->id }}</td>
                  <td>{{ $user->first_name }}</td>
                  <td>{{ $user->last_name }}</td>
                  <td>{{ $user->user_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                </div>
               </td>        
               </tr>
             @endforeach                  
        </tbody>
    </table>
 </div>
 </div>
</div>

<div class="d-flex justify-content-center mt-4">             
</div>

</div>

@endsection

