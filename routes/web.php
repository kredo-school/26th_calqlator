<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\UserHomePageController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// User / Home Page
Route::get('/user/home', [UserHomePageController::class, 'index'])->name('user.home');
Route::delete('/user/breakfast/delete/{id}',[UserHomePageController::class, 'breakfastDelete'])->name('user.breakfast.delete');
Route::delete('/user/lunch/delete/{id}',[UserHomePageController::class, 'lunchDelete'])->name('user.lunch.delete');
Route::delete('/user/dinner/delete/{id}',[UserHomePageController::class, 'dinnerDelete'])->name('user.dinner.delete');
Route::delete('/user/workout/delete/{id}',[UserHomePageController::class, 'workoutDelete'])->name('user.workout.delete');
// Admin / Food & Exercise Confirmation
Route::get('/admin/food/confirmation',[ConfirmationController::class, 'food_index'])->name('admin.food.confirmation');
Route::get('/admin/exercise/confirmation',[ConfirmationController::class, 'exercise_index'])->name('admin.exercise.confirmation');
Route::patch('/admin/confirmation/confirm/{id}',[ConfirmationController::class, 'confirm'])->name('admin.confirm');
Route::delete('/admin/confirmation/delete/{id}',[ConfirmationController::class, 'delete'])->name('admin.delete');
