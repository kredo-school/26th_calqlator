@extends('layouts.admin')

@section('title', 'Admin: FAQregistrationcomplete')

@section('content')
<!-- Complete -->
<div class="">
    <div class="">
        <div class="border-danger">
            <div class="border-danger">
                <div class="h2 text-danger">
                    Complete!
                </div>
            </div>
            <div class="">
                <p>The following questions and answers have added</p>
                    <div class="row">
                        <p class="col" id=""></p>
                        <p class="col" id=""></p>
                    </div>
            </div>
            <div class="modal-footer text-end">
                <a href="{{ route('admin.faqregistration.index')}}">
                    <button type="button" class="btn btn-secondary btn-sm">
                        Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection