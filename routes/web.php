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

// Admin / Food & Exercise Confirmation
Route::get('/admin/food/confirmation',[ConfirmationController::class, 'index'])->name('admin.food.confirmation');
Route::patch('/admin/food/confirmation/{id}',[ConfirmationController::class, 'confirm'])->name('admin.food.confirm');
Route::delete('/admin/food/confirmation/delete/{id}',[ConfirmationController::class, 'delete'])->name('admin.food.delete');

// ADMIN
// Route::group(['prefix' => 'admin', 'as' => 'admin.' , 'middleware' => 'admin'], function(){}
Route::get('/admin/faqlist/index', [FAQController::class, 'indexlist'])->name('admin.faqlist.index');