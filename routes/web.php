<?php 
    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\Admin\HomesController;

Auth::routes();
    
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

// Admin / FAQRegistration
Route::get('/admin/faqregistration/index', [FaqController::class, 'reg_index'])->name('admin.faqregistration.index');
Route::get('/admin/faqregistration/store', [FaqController::class, 'store'])->name('admin.faqregistration.store');
Route::post('/admin/faqregistration/store', [FaqController::class, 'store'])->name('admin.faqregistration.store');        Route::get('/admin/user/list', [UsersController::class, 'index'])->name('users.list');
        Route::get('/admin/user/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/admin/user/{id}/update', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/admin/user/{id}/delete', [UsersController::class, 'destroy'])->name('users.destroy');

        Route::get('/admin/food/list', [FoodsController::class, 'index'])->name('foods.list');
        Route::get('/create', [FoodsController::class, 'create'])->name('foods.create');
        Route::post('/food/store', [FoodsController::class, 'store'])->name('foods.store');
        Route::get('/{id}/edit', [FoodsController::class, 'edit'])->name('foods.edit');
        Route::put('/food/update/{id}', [FoodsController::class, 'update'])->name('foods.update');
        Route::delete('/food/delete/{id}', [FoodsController::class, 'destroy'])->name('foods.destroy');

        Route::get('/{id}/confirm-edit', [FoodsController::class, 'confirmEdit'])
             ->name('foods.confirm-edit');
        Route::get('/{id}/confirm-delete', [FoodsController::class, 'confirmDelete'])
             ->name('foods.confirm-delete');