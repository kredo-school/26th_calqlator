@extends('layouts.admin')

@section('title', 'FAQ List')

@section('content')
<h2>
    <i class="fa-regular fa-circle-question"></i> FAQ List
</h2>
<form action="" style="width: 300px" class="float-end">
    <input type="search" name="search" placeholder="Search question..." class="form-control form-control-sm">
</form>
<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-warning text-secondary">
        <tr>
            <th>ID</th>
            <th>Questions</th>
            <th>Answer</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_faqs as $faq)
            <tr>
                <td>{{ $faq->id }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>
                    <button class="btn text-success" {{-- data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}"--}}>
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </td>
                <td>
                    <button class="btn text-danger" {{--data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}"--}}>
                        <i class="fa-solid fa-circle-minus"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endSection