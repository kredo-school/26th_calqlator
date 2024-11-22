@extends('layouts.user')

@section('title', 'ChatPage')

@section('content')
<div class="chat-container">
    <!-- chat title -->
    <div class="chat-header">
        <div class="row">
            <div class="col-8 text-start">
                <h3>
                    Contact Form
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
        <div class="date text-center">
            2024/10/11
        </div>
        <!-- sending -->
        <div class="icon sent">
            <img src="../assets/images/character.png" alt="" class="icon-apple">
        </div>
        <div class="message sent me-5">
            Hello！
            <div class="timestamp">10:00</div>
        </div>
        <!-- received -->
        <div class="icon received">
            <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
        </div>
        <div class="message received ms-5">
            Hello! How are you?
            <div class="timestamp">10:01</div>
        </div>
    </div>

    <!-- input field -->
    <div class="chat-input">
        <input type="text" placeholder="input your message ...">
        <button><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>
@endSection