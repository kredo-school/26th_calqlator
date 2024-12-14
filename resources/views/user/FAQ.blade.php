@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
<main class="faq-main">
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ route('user.faq')}}" method="get">
            <div class="row mb-3 justify-content-center">
                <div class="col-2 p-0 my-auto ">
                    <input type="text" name="search" value="{{ $search }}" class="form-control form-control-lg m-0 p-0 w-100" placeholder="Search...">
                </div>
                <div class="col-auto text-center p-0 my-auto">
                    <button type="submit" class="btn text-success fs-2 text-secondary mx-auto">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="col-auto text-center">
            <h2 class="display-6 font-semibold text-black">
                <img src="{{ asset('../assets/images/Q&A.png') }}" alt="Q&A"> Frequently Asked Questions <img src="{{ asset('../assets/images/Q&A.png') }}" alt="Q&A">
            </h2>
            <hr>

            <div class="col-10 mx-auto">
                <div class="my-5">
                    @foreach ($faqs as $faq)
                    <dl>
                        <div>
                            <dt class="text-start">{{ $faq->question }}</dt>
                            <dd class="text-start">{{ $faq->answer }}</dd>
                        </div>
                    </dl>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $faqs -> links() }}
                    </div>
                </div>
            </div>
           <hr>
        </div>
        <div class="row text-center">
            @if(Auth::user())
                <p class="fs-5">If you can not find the answer you are looking for, 
                    <br>please contact us from <a href="{{route('chat.userChat')}}">Contact</a></p>
            @else
                <p class="fs-5">If you can not find the answer you are looking for, 
                    <br>please <a href="{{ route('register')}}">register</a> an account and contact us!</p>
            @endif
        </div>
    </div>
</div>
</main>
<script src="js/faq.js"></script>
@endsection