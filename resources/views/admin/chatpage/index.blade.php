@extends('layouts.adminchat')

@section('title', 'Admin: ChatPage')

@section('content')
<div class="chat-container">
    <!-- chat title -->
    <div class="chat-header">
        <div class="text-center">
            <h3>
                @if ($selectedUser)  {{ $selectedUser->username }} @else No User @endif
            </h3>
        </div>
        <!--<div class="col-4">
            <form action="#" class="search text-end">
                <div class="chat-search">
                    <input type="search" name="adminSearch" placeholder="Search message..." class="form-control form-control-sm me-1">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>-->
    </div>

    <!-- chat message -->
    <div class="chat-messages">
        @if ($selectedUserId)
            <form action="{{ route('chat.storeAnswer') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $selectedUserId }}">
                <div class="chat-box">
                    @forelse ($questions as $date => $dayQuestions)
                        <div class="chat-date text-center font-weight-bold"><u>{{ $date }}</u></div>
                        @forelse ($dayQuestions as $question)
                        @if ($question)
                        <!-- sending -->
                        <div class="icon sent">
                            <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                            <strong>{{ $selectedUser->username }}</strong>
                        </div>
                        <div class="message s">
                            <div class="message sent">
                                {{ $question->question }}
                                <div class="timestamp">
                                    {{ $question->created_at->format('H:i')}}
                                </div>
                                <input type="checkbox" name="question_id" value="{{ $question->id }}">
                                @if ($question->checked == '2')
                                    <p>Read</p>
                                @else
                                    <p>UnRead</p>
                                @endif
                            </div>
                        </div>
                        @forelse ($question->answers as $answer)
                        <!-- received -->
                        <div class="r">
                            <div class="icon received">
                                <i class="fa-solid fa-circle-user text-secondary icon-ssm"></i>
                                    Admin
                            </div>
                            <div class="message received">
                                {{ $answer->answer ?? 'No answer yet'}}
                                @if ($answer->created_at)
                                    <div class="timestamp">
                                        {{ $answer->created_at->format('H:i') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @empty
                            <p>Not answered yet.</p>
                        @endforelse
                        @else
                            <p>No data found this question.</p>
                        @endif
                        @empty
                            <p>No questions for this date.</p>
                        @endforelse
                    @empty
                        <p>No questions avairable.</p>
                    @endforelse

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