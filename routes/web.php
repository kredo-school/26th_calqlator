<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\Admin\HomesController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ExercisesController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/meals', [MealController::class, 'index']);
Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
Route::get('/search', [MealController::class, 'search']);



Route::get('/daily-condition', function () {
    return view('daily_condition');
});

// User / Home Page
Route::get('/user/home', [HomePageController::class, 'index'])->name('user.home');

// UserFAQ
// use App\Http\Controllers\FaqController;
// User / Calendar
Route::get('/user/calendar', [CalendarController::class, 'index'])->name('user.calendar');
Route::get('/user/calendar/info/{date}', [CalendarController::class, 'everydayInfo'])->name('user.calendar.info');
// UserFAQ
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');
// User / ChatPage
Route::get('/chatpage/index', [ChatController::class, 'userindex'])->name('user.chatpage.index');
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

// Admin / ExerciseRegistration
Route::group(['prefix' => 'admin/exercise/registration', 'as' => 'admin.exercise.registration.'], function(){
    Route::get('/', [RegistrationController::class, 'exercise_index'])->name('index');
    Route::post('/store', [RegistrationController::class, 'exercise_store'])->name('store');
    Route::get('/complete', [RegistrationController::class, 'exercise_complete'])->name('complete');
});
Route::get('/admin/faqregistration/complete', [FaqController::class, 'complete'])->name('admin.faqregistration.complete');
// Admin / ChatPage
Route::get('/admin/chatpage/index', [ChatController::class, 'index'])->name('admin.chatpage.index');




// Admin / user list
Route::get('/admin/user/list', [UsersController::class, 'index'])->name('admin.users.list');
Route::get('/admin/user/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/user/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/user/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

// Admin / food list
Route::get('/admin/food/list', [FoodsController::class, 'index'])->name('admin.foods.list');
Route::get('/admin/food/edit/{id}', [FoodsController::class, 'edit'])->name('admin.foods.edit');
Route::put('/admin/food/update/{id}', [FoodsController::class, 'update'])->name('admin.foods.update');
Route::delete('/admin/food/delete/{id}', [FoodsController::class, 'destroy'])->name('admin.foods.destroy');

// Admin / exercise list
Route::get('/admin/exercise/list', [ExercisesController::class, 'index'])->name('admin.exercises.list');
Route::get('/admin/exercise/edit/{id}', [ExercisesController::class, 'edit'])->name('admin.exercise.edit');
Route::get('/admin/exercise/update/{id}', [ExercisesController::class, 'update'])->name('admin.exercises.update');
Route::get('/admin/exercise/delete/{id}', [ExercisesController::class, 'delete'])->name('admin.exercise.delete');
