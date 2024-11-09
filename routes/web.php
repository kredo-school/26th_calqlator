<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




















Route::get('/meals', [MealController::class, 'index']);
Route::post('/meals', [MealController::class, 'store']);
Route::get('/search', [MealController::class, 'search']);



















Route::get('/daily-condition', function () {
    return view('daily_condition');
});