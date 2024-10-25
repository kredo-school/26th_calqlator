@extends('layouts.adminapp')

@section('title', 'Admin: FAQList')

@section('content')
<form action="#">
    <p>
        FAQ Registration  <i class="fa-solid fa-circle-plus text-danger"></i>
    </p>
    <div class="row">
        <div class="col-6">
            <label for="question" class="form-label fw-bold">Question</label>
            <textarea name="question" id="question" rows="6" class="form-control"></textarea>
        </div>
        <div class="col-6">
            <label for="answer" class="form-label fw-bold">Answer</label>
            <textarea name="answer" id="answer" rows="6" class="form-control"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary px-3">Save</button>
</form>
@endsection