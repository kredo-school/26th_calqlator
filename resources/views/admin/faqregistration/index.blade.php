@extends('layouts.faqregistration')

@section('title', 'Admin: FAQregistration')

@section('content')
<form action="{{ route('admin.faqregistration.store')}}" method="POST">
    @csrf
    <div class="container mt-5 w-75">
        <div class="row">
            <div class="col-auto mb-2">
                <h3 class="mb-0 fw-bold">FAQ Registration</h3>
            </div>
            <div class="col px-0">
                <button type="button" id="add-faq" class="btn btn-outline-0 btn-lg">
                    <i class="fa-solid fa-circle-plus text-danger"></i>
                </button>
            </div>
            <div class="col-4"></div>
            <div class="col-2 mt-3 form-group">
                <button type="submit" class="btn text-success btn-outline-success px-4">Save</button>
            </div>
        </div>
        <div id="faqs-container">
            <div class="faq-item">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-4 form-group">
                        <label for="question-0" class="form-label">Question</label>
                        <textarea name="faqs[0][question]" id="question-0" rows="6" class="form-control" required></textarea>
                    </div>
                    <div class="col-4 form-group">
                        <label for="answer-0" class="form-label">Answer</label>
                        <textarea name="faqs[0][answer]" id="answer-0" rows="6" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-2 mt-3 form-group">
                        <button type="button" class="remove-faq" style="display:none;">delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/faqregistrationPlus.js')}}"></script>
@endsection