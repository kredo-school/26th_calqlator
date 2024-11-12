<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\Admin\HomesController;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User / Home Page
use App\Http\Controllers\HomePageController;
Route::get('/user/home', [HomePageController::class, 'index'])->name('user.home');

// UserFAQ
use App\Http\Controllers\FaqController;
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');
// Admin / Food & Exercise Confirmation
Route::get('/admin/food/confirmation',[ConfirmationController::class, 'food_index'])->name('admin.food.confirmation');
Route::get('/admin/exercise/confirmation',[ConfirmationController::class, 'exercise_index'])->name('admin.exercise.confirmation');
Route::patch('/admin/confirmation/confirm/{id}',[ConfirmationController::class, 'confirm'])->name('admin.confirm');
Route::delete('/admin/confirmation/delete/{id}',[ConfirmationController::class, 'delete'])->name('admin.delete');

// Admin / Homepage

Route::get('/admin/home',[HomesController::class, 'index'])->name('admin.home');

// ADMIN
// Route::group(['prefix' => 'admin', 'as' => 'admin.' , 'middleware' => 'admin'], function(){}
Route::get('/admin/faqlist/index', [FaqController::class, 'indexlist'])->name('admin.faqlist.index');
Route::patch('/admin/faqlist/update/{id}',[FaqController::class, 'update'])->name('admin.faqlist.update');
Route::delete('/admin/faqlist/delete/{id}',[FaqController::class, 'delete'])->name('admin.faqlist.delete');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::patch('/user/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/user/{id}/show', [UserController::class, 'show'])->name('user.show');
});