@extends('layouts.adminchat')

@section('title', 'Admin: ChatPage')

@section('content')
<div class="chat-container">
    <!-- chat title -->
    <div class="chat-header">
        <div class="row">
            <div class="col-8 text-start">
                <h3>
                    No User @if ($selectedUser) - {{ $selectedUser->name }} @endif
                </h3>
            </div>
            <div class="col-4 text-end">
                <form action="#" class="search text-end">
                    <div class="chat-search">
                        <input type="searchquestion" name="searchquestion" placeholder="Search message..." class="form-control form-control-sm me-1">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- chat message -->
    <div class="chat-messages">
        @if ($selectedUserId)
            <form action="{{ route('chat.storeanswer') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $selectedUserId }}">
                <div class="chat-box">
                    @foreach ($questions as $date => $dayQuestions)
                        <div class="chat-date">{{ $date }}</div>
                            @foreach ($dayQuestions as $question)
                                <!-- sending -->
                                <div class="icon sent">
                                    <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                                    <strong>{{ $selectedUser->name }}</strong>
                                </div>
                                <div class="message sent">
                                    {{ $question->question }}
                                    <div class="timestamp">
                                        {{ $question->created_at->format('H:i')}}
                                    </div>
                                    <input type="checkbox" name="question_id" value="{{ $question->id }}">
                                </div>
                                @if ($question->checked)
                                    <span class="">Read</span>
                                @else
                                    <span class="">UnRead</span>
                                @endif
                                @forelse ($question->answers as $answer)
                                <!-- received -->
                                <div class="icon received">
                                    <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                                        Admin
                                </div>
                                <div class="message received">
                                    {{ $answer->answer }}
                                    <div class="timestamp">
                                        {{ $answer->created_at->format('H:i') }}
                                    </div>
                                </div>
                                @empty
                                    <p>Not answered yet.</p>
                                @endforelse
                            @endforeach
                        </div>
                    @endforeach

                    <!-- input field -->
                    <div class="chat-input">
                        <input name="answer" type="text" placeholder="input your message ...">
                        <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        @else
            <p>Please select User you chat from left bar.</p>
        @endif
    </div>
</div>
@endSection