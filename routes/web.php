<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\ConfirmationController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User / Home Page
use App\Http\Controllers\HomePageController;
Route::get('/user/home', [HomePageController::class, 'index'])->name('user.home');
// UserFAQ 
use App\Http\Controllers\FaqController;
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');
// Admin / Food & Exercise Confirmation
Route::get('/admin/food/confirmation',[ConfirmationController::class, 'index'])->name('admin.food.confirmation');
Route::patch('/admin/food/confirmation/{id}',[ConfirmationController::class, 'confirm'])->name('admin.food.confirm');
Route::delete('/admin/food/confirmation/delete/{id}',[ConfirmationController::class, 'delete'])->name('admin.food.delete');

// ADMIN
// Route::group(['prefix' => 'admin', 'as' => 'admin.' , 'middleware' => 'admin'], function(){}
Route::get('/admin/faqlist/index', [FaqController::class, 'indexlist'])->name('admin.faqlist.index');
Route::patch('/admin/faqlist/update/{id}',[FaqController::class, 'update'])->name('admin.faqlist.update');
Route::delete('/admin/faqlist/delete/{id}',[FaqController::class, 'delete'])->name('admin.faq.delete');