@extends('layouts.faqregistration')

@section('title', 'Admin: FAQregistrationcomplete')

@section('content')
<!-- Complete -->
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="border border-black rounded-3 p-5 ps-5 pe-5">
                <div class="h1 fw-bold text-center">
                    Complete!
                </div>
                <div class="border border-3 border-warning rounded-3 bg-warning-subtle p-3 ms-5 me-5">
                    <div class="text-center">
                        <p class="h4">The following questions and answers have added</p>
                        @foreach($faqs as $faq)
                            <div class="row">
                                <div class="col-3"></div>
                                <p class="col-3" id="">{{ $faq->question}}</p>
                                <p class="col-3" id="">{{ $faq->answer}}</p>
                                <div class="col-3"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col text-end">
                            <a href="{{ route('admin.faqregistration.index')}}">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
@endsection