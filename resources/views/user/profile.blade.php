@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                      @if($user->avatar)

                      {{-- image --}}
                      <img src="{{ asset('storage/avatars/'.Auth::user()->avatar)}}" alt="" class="avatar rounded-circle image-lg d-block mx-auto">
                      @else 
                      <i class="far fa-circle-user fa-10x"></i>
                      @endif
                    </div>
                    
                    <div class="col align-self-end">
                    <h2 class="h3 d-inline">{{ $user->name }}</h2>
                    <h4 class="h5 d-inline">{{ $user->email }}</h4>
                    <h4 class="h6 d-inline">{{ $user->email }}</h4>

        <form action="{{ route('user.update')}}" method="post" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')

        <label for="name" class="form-label mt-3">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="form-control">
        @error('name')
            <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror

        <label for="email" class="form-label mt-3">E-Mail Address</label>
        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
        @error('email')
            <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror

            {{-- Edit Profile --}}
            <a href="{{ route('user.edit')}}" class="btn btn-sm btn-primary mt-3 px-4">Edit Profile</a>
        </div>
    </form>
  </div>
@endsection