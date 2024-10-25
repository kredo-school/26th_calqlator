@extends('layouts.adminapp')

@section('title', 'Admin: FAQList')

@section('content')
    <form action="#">
        <div class="row my-3">
            <div class="col-2"></div>
            <div class="col-4 fw-bold">
                FAQ Registration  <i class="fa-solid fa-circle-plus text-danger"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-4">
                <label for="question" class="form-label">Question</label>
                <textarea name="question" id="question" rows="6" class="form-control"></textarea>
            </div>
            <div class="col-4">
                <label for="answer" class="form-label">Answer</label>
                <textarea name="answer" id="answer" rows="6" class="form-control"></textarea>
            </div>
        </div>
        <div class="row ">
            <div class="col-2"></div>
            <div class="col-4"></div>
            <div class="col-4 text-end mt-3">
                <button type="submit" class="btn text-success btn-outline-success px-4">Save</button>
            </div>
        </div>
    </form>
@endsection