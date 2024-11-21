@extends('layouts.admin')

@section('title', 'FAQ List')

@section('content')
<div class="row">
    <div class="col-2"></div>
    <div class="col-auto">
        <h2>
            <i class="fa-regular fa-circle-question"></i> FAQ List
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <form action="" style="width: 300px" class="float-end">
            <input type="search" name="search" placeholder="Search question..." class="form-control form-control-sm">
        </form>
    </div>
</div>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <form action="">
            <table class="table table-hover align-middle bg-white border text-secondary">
                <thead class="small table-warning text-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
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
                                <button class="btn text-success" data-bs-toggle="modal" data-bs-target="#edit-faq-{{ $faq->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn text-danger" data-bs-toggle="modal" data-bs-target="#delete-faq-{{ $faq->id }}">
                                    <i class="fa-solid fa-circle-minus"></i>
                                </button>
                                @include('admin.faqlist.modals.actions')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@endSection