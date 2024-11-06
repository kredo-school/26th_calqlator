<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


















































































// Admin / Food & Exercise Confirmation
Route::get('/admin/food/confirmation',[ConfirmationController::class, 'food_index'])->name('admin.food.confirmation');
Route::get('/admin/exercise/confirmation',[ConfirmationController::class, 'exercise_index'])->name('admin.food.confirmation');
Route::patch('/admin/food/confirmation/{id}',[ConfirmationController::class, 'confirm'])->name('admin.food.confirm');
Route::delete('/admin/food/confirmation/delete/{id}',[ConfirmationController::class, 'delete'])->name('admin.food.delete');