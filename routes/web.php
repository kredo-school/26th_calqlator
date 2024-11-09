<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::patch('/user/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/user/{id}/show', [UserController::class, 'show'])->name('user.show');
});