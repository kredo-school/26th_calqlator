@extends('layouts.userchat')

@section('title', 'User: ChatPage')

@section('content')
<div class="chat-container">
    <!-- chat title -->
    <div class="chat-header">
        <div class="row">
            <div class="col-8 text-center">
                <h3>
                    Contact Form
                </h3>
            </div>
            <div class="col-4 text-end">
                <form action="{{ route('user.chat.search') }}" class="search text-end">
                    <div class="chat-search">
                        <input type="search" name="userSerach" placeholder="Search message..." class="form-control form-control-sm me-1">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- chat message -->
    <div class="chat-messages">
        <div class="chat-box">
            @if ($questions->isNotEmpty())
                @forelse ($questions->groupBy(function ($item) { return $item->created_at->format('Y-m-d');}) as $date => $dayQuestions)
                    <div class="chat-date text-center font-weight-bold"><u>{{ $date }}</u></div>
                    @foreach ($dayQuestions as $question)
                        <!-- sending -->
                        <div class="icon sent">
                            <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                            <strong>You</strong>
                        </div>
                        <div class="message s">
                            <div class="message sent">
                                {{ $question->question }}
                                <div class="timestamp">
                                    {{ $question->created_at->format('H:i')}}
                                </div>
                            </div>
                        </div>
                        <!-- received -->
                        @foreach ($question->answers as $answer)
                            <div class="r">
                                <div class="icon received">
                                    <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                                    Admin
                                </div>
                                <div class="message received">
                                    {{ $answer->answer ?? 'No answer yet'}}
                                    @if ($answer->created_at)
                                        <div class="timestamp">
                                            {{ $answer->created_at->format('H:i')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @empty
                    <p>No questions available.</p>
                @endforelse    
            @else
                <p class="text-center">No Contact</p>
            @endif
        </div>
    </div>
    <!-- input field -->
    <div class="chat-input mt-4">
        <form action="{{ route('chat.storeQuestion') }}" method="POST">
            @csrf
                <input name="question" type="text" placeholder="input your message ...">
                <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
    </div>
</div>
@endSection