@extends('layouts.admin')

@section('title', 'FAQ List')

@section('content')
<div class="m-5 px-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0"><i class="fa-solid fa-dumbbell"></i> FAQ List</h2>
               
               <!-- search form-->
                <div class="search-container">
                    <form action="{{ route('admin.faqlist.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search name..." 
                                   value="">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        <!-- faq list table -->
        <div class="faqlist-table">
            <div class="sortable-table">
            <table class="table text-center mb-0 faqlist" id="admin-table">
                <thead class="faqlist">
                    <tr>
                        <th class="sortable-table" style="width: 10%" id="id-header">ID</th>
                        <th class="sortable-table" style="width: 30%; " id="name-header">QUESTION</th>
                        <th class="sortable-table" style="width: 30%" id="calories-header">ANSWER</th>
                        <th class="sortable-table" style="width: 15%"></th>
                        <th class="sortable-table" style="width: 15%"></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($list_faqs as $faq) 
                
                    <tr>
                    <td class="text-center">{{ $faq->id }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td>
                    <td>
                        <button type="button" class="btn text-success" data-bs-toggle="modal" data-bs-target="#edit-faq-{{ $faq->id }}">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn text-danger" data-bs-toggle="modal" data-bs-target="#delete-faq-{{ $faq->id }}">
                            <i class="fa-solid fa-circle-minus"></i>
                        </button>
                        @include('admin.faqlist.modals.actions')
                    </td>
              </tr>
                @endforeach
            </tbody>
        </table>
           
                   
             </div>
        </div>
    </div>
</div>
@endsection