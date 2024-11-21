<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\Admin\HomesController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ChatController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User / Home Page
Route::get('/user/home', [HomePageController::class, 'index'])->name('user.home');
// User / Calendar
Route::get('/user/calendar', [CalendarController::class, 'index'])->name('user.calendar');
Route::get('/user/calendar/info/{date}', [CalendarController::class, 'everydayInfo'])->name('user.calendar.info');
// UserFAQ 
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');

// ADMIN
// Route::group(['prefix' => 'admin', 'as' => 'admin.' , 'middleware' => 'admin'], function(){}
// Admin / Homepage
Route::get('/admin/home',[HomesController::class, 'index'])->name('admin.home');
// Admin / Food & Exercise Confirmation
Route::get('/admin/food/confirmation',[ConfirmationController::class, 'food_index'])->name('admin.food.confirmation');
Route::get('/admin/exercise/confirmation',[ConfirmationController::class, 'exercise_index'])->name('admin.exercise.confirmation');
Route::patch('/admin/confirmation/confirm/{id}',[ConfirmationController::class, 'confirm'])->name('admin.confirm');
Route::delete('/admin/confirmation/delete/{id}',[ConfirmationController::class, 'delete'])->name('admin.delete');
// Admin / FAQ list
Route::get('/admin/faqlist/index', [FaqController::class, 'indexlist'])->name('admin.faqlist.index');
Route::patch('/admin/faqlist/update/{id}',[FaqController::class, 'update'])->name('admin.faqlist.update');
Route::delete('/admin/faqlist/delete/{id}',[FaqController::class, 'delete'])->name('admin.faqlist.delete');
// Admin / FAQRegistration
Route::get('/admin/faqregistration/index', [FaqController::class, 'reg_index'])->name('admin.faqregistration.index');
Route::get('/admin/faqregistration/store', [FaqController::class, 'store'])->name('admin.faqregistration.store');
Route::post('/admin/faqregistration/store', [FaqController::class, 'store'])->name('admin.faqregistration.store');
// Admin / ChatPage
Route::get('/admin/chatpage/index', [ChatController::class, 'index'])->name('admin.chatpage.index');
