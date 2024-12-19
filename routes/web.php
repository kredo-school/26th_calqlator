<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\UserHomePageController;
use App\Http\Controllers\Admin\HomesController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\MealLunchController;
use App\Http\Controllers\MealDinnerController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\UserHomeDeleteController;

Auth::routes();

// Guest & User
Route::get('/', function () {return view('home');})->name('home');
Route::post('/find/reset/user', [PasswordResetController::class, 'findResetUser'])->name('find.user.reset.id');
Route::post('/update/password/{id}', [PasswordResetController::class, 'update'])->name('update.password');
 // User / FAQ
 Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');

Route::group(['middleware' => 'auth'], function(){
    // User / Change Email
    Route::post('/change-email', [App\Http\Controllers\UserController::class, 'changeEmail'])->name('change-email');
    // User / Change Password
    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');
    // USER
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}/show', [UserController::class, 'show'])->name('user.show');
    // User / Home Page
    Route::get('/user/home/{date}', [UserHomePageController::class, 'index'])->name('user.home');
    Route::delete('/user/breakfast/delete/{id}',[UserHomeDeleteController::class, 'breakfastDelete'])->name('user.breakfast.delete');
    Route::delete('/user/lunch/delete/{id}',[UserHomeDeleteController::class, 'lunchDelete'])->name('user.lunch.delete');
    Route::delete('/user/dinner/delete/{id}',[UserHomeDeleteController::class, 'dinnerDelete'])->name('user.dinner.delete');
    Route::delete('/user/workout/delete/{id}',[UserHomeDeleteController::class, 'workoutDelete'])->name('user.workout.delete');
    Route::delete('/user/supplement/delete/{id}',[UserHomeDeleteController::class, 'supplementDelete'])->name('user.supplement.delete');
    Route::delete('/user/snack/delete/{id}',[UserHomeDeleteController::class, 'snackDelete'])->name('user.snack.delete');
    Route::get('/user/home/calories/chart/{date}', [UserHomePageController::class, 'caloriesChart'])->name('user.home.calories.chart');
    Route::get('/user/home/workout/chart/{date}', [UserHomePageController::class, 'workoutChart'])->name('user.home.workout.chart');
    Route::get('/user/home/protein/chart/{date}', [UserHomePageController::class, 'proteinChart'])->name('user.home.protein.chart');
    Route::get('/user/home/fat/chart/{date}', [UserHomePageController::class, 'fatChart'])->name('user.home.fat.chart');
    Route::get('/user/home/carbs/chart/{date}', [UserHomePageController::class, 'carbsChart'])->name('user.home.carbs.chart');
    // User / Calendar
    Route::get('/user/calendar', [CalendarController::class, 'index'])->name('user.calendar');
    Route::get('/user/calendar/info/{date}', [CalendarController::class, 'everydayInfo'])->name('user.calendar.info');
    //User / Meal Registration
    Route::get('/meals', [MealController::class, 'index'])->name('meals.registration');
    Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
    Route::get('/search', [MealController::class, 'search']);
    // User / Everyday Condition
    Route::get('/daily-condition', function () {return view('daily_condition');});
    // User / Weight
    Route::get('/user/weight', [WeightController::class, 'weight'])->name('weight');
    Route::get('/user/weight/chart', [WeightController::class, 'weightChart'])->name('weight.chart');
    // User / ChatPage
    Route::get('/user/chat', [ChatController::class, 'userChat'])->name('chat.userChat');
    Route::post('/user/chat/store', [ChatController::class, 'storeQuestion'])->name('chat.storeQuestion');
    Route::get('/user/chat/search',[ChatController::class, 'userSearch'])->name('user.chat.search');

// User / Calendar
Route::get('/user/calendar', [CalendarController::class, 'index'])->name('user.calendar');
Route::get('/user/calendar/info/{date}', [CalendarController::class, 'everydayInfo'])->name('user.calendar.info');
// UserFAQ 
Route::get('/faq', [FaqController::class, 'index'])->name('user.faq');
// User / ChatPage
Route::get('/chatpage/index', [ChatController::class, 'userindex'])->name('user.chatpage.index');
//User / Meal Registration
Route::get('/meals/index', [MealController::class, 'index'])->name('meals.index');
Route::post('/meals/store', [MealController::class, 'store'])->name('meals.store');
Route::put('/meals/search', [MealController::class, 'search'])->name('meals.search');
Route::get('/meals/history', [MealController::class, 'history'])->name('meals.history');
Route::get('/meals/{id}/edit', [MealController::class, 'edit'])->name('meals.edit');
Route::put('/meals/{id}', [MealController::class, 'update'])->name('meals.update');
Route::get('/meals/confirmation_morning', [MealController::class, 'confirmationMorning'])->name('meals.confirmation_morning');
// User/ Meal Registration lunch
Route::get('/meals/index_lunch', [MealLunchController::class, 'index'])->name('meals.index_lunch');
Route::post('/meals/lunch/store', [MealLunchController::class, 'storeLunch'])->name('meals.store.lunch');
Route::put('/meals/search', [MealLunchController::class, 'search'])->name('meals.search');
Route::get('/meals/history', [MealLunchController::class, 'history'])->name('meals.history');
Route::get('/meals/{id}/edit', [MealLunchController::class, 'edit'])->name('meals.edit');
Route::put('/meals/{id}', [MealLunchController::class, 'update'])->name('meals.update');
Route::get('/meals/confirmation_lunch', [MealLunchController::class, 'confirmationLunch'])->name('meals.confirmation_lunch');
// User/ Meal Registration dinner
Route::get('/meals/index_dinner', [MealDinnerController::class, 'index'])->name('meals.index_dinner');
Route::post('/meals/dinner/store', [MealDinnerController::class, 'storeDinner'])->name('meals.store.dinner');
Route::put('/meals/search', [MealDinnerController::class, 'search'])->name('meals.search');
Route::get('/meals/history', [MealDinnerController::class, 'history'])->name('meals.history');
Route::get('/meals/{id}/edit', [MealDinnerController::class, 'edit'])->name('meals.edit');
Route::put('/meals/{id}', [MealDinnerController::class, 'update'])->name('meals.update');
Route::get('/meals/confirmation_dinner', [MealDinnerController::class, 'confirmationDinner'])->name('meals.confirmation_dinner');





// User / Everyday Condition
Route::get('/daily-condition', function () {return view('daily_condition');});


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
Route::get('/admin/faqregistration/complete', [FaqController::class, 'complete'])->name('admin.faqregistration.complete');
// Admin / ChatPage
Route::get('/admin/chatpage/index', [ChatController::class, 'index'])->name('admin.chatpage.index');
// Workout Registration
Route::get('/workouts', [WorkoutController::class, 'index']);
Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
Route::get('/workout-search', [WorkoutController::class, 'workout.search']);


        
       
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
    // ADMIN
    Route::group(['middleware' => 'admin'], function(){
        // Admin / Homepage
        Route::get('/admin/home',[HomesController::class, 'index'])->name('admin.home');
        // Admin / Food & Exercise Confirmation
        Route::get('/admin/food/confirmation',[ConfirmationController::class, 'food_index'])->name('admin.food.confirmation');
        Route::get('/admin/exercise/confirmation',[ConfirmationController::class, 'exercise_index'])->name('admin.exercise.confirmation');
        Route::patch('/admin/food/confirmation/confirm/{id}',[ConfirmationController::class, 'foodConfirm'])->name('admin.food.confirm');
        Route::patch('/admin/exercise/confirmation/confirm/{id}',[ConfirmationController::class, 'exerciseConfirm'])->name('admin.exercise.confirm');
        Route::delete('/admin/food/confirmation/delete/{id}',[ConfirmationController::class, 'foodDelete'])->name('admin.food.confirmation.delete');
        Route::delete('/admin/exercise/confirmation/delete/{id}',[ConfirmationController::class, 'exerciseDelete'])->name('admin.exercise.confirmation.delete');
        // Admin / FAQ list
        Route::get('/admin/faqlist/index', [FaqController::class, 'indexlist'])->name('admin.faqlist.index');
        Route::patch('/admin/faqlist/update/{id}',[FaqController::class, 'update'])->name('admin.faqlist.update');
        Route::delete('/admin/faqlist/delete/{id}',[FaqController::class, 'delete'])->name('admin.faqlist.delete');
        Route::get('/admin/faqlist/search',[FaqController::class, 'search'])->name('admin.faqlist.search');
        // Admin / FAQRegistration
        Route::get('/admin/faqregistration/index', [FaqController::class, 'reg_index'])->name('admin.faqregistration.index');
        Route::post('/admin/faqregistration/store', [FaqController::class, 'store'])->name('admin.faqregistration.store');
        Route::get('/admin/faqregistration/complete', [FaqController::class, 'complete'])->name('admin.faqregistration.complete');
        // Admin / ExerciseRegistration
        Route::group(['prefix' => 'admin/exercise/registration', 'as' => 'admin.exercise.registration.'], function(){
            Route::get('/', [RegistrationController::class, 'exercise_index'])->name('index');
            Route::post('/store', [RegistrationController::class, 'exercise_store'])->name('store');
            Route::get('/complete', [RegistrationController::class, 'exercise_complete'])->name('complete');
        });
        //Admin / FoodRegistration
        Route::group(['prefix' => 'admin/food/registration', 'as' => 'admin.food.registration.'], function(){
            Route::get('/', [RegistrationController::class, 'food_index'])->name('index');
            Route::post('/store', [RegistrationController::class, 'food_store'])->name('store');
            Route::get('/complete', [RegistrationController::class, 'food_complete'])->name('complete');
        });
        //Admin / Workout Registration
        Route::get('/workouts', [WorkoutController::class, 'index'])->name('admin.workouts.index');
        Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
        Route::get('/workout-search', [WorkoutController::class, 'workout.search']);
        // Admin / user list
        Route::get('/admin/user/list', [UsersController::class, 'index'])->name('admin.users.list');
        // Admin / food list
        Route::get('/admin/food/list', [FoodsController::class, 'index'])->name('admin.foods.food_list');
        Route::get('/admin/food/edit/{id}', [FoodsController::class, 'edit'])->name('admin.foods.edit');
        Route::patch('/admin/food/update/{id}', [FoodsController::class, 'update'])->name('admin.foods.update');
        Route::delete('/admin/food/delete/{id}', [FoodsController::class, 'delete'])->name('admin.foods.delete');
        // Admin / exercise list
        Route::get('/admin/exercise/list', [ExercisesController::class, 'index'])->name('admin.exercises.list');
        Route::get('/admin/exercise/edit/{id}', [ExercisesController::class, 'edit'])->name('admin.exercise.edit');
        Route::patch('/admin/exercise/update/{id}', [ExercisesController::class, 'update'])->name('admin.exercises.update');
        Route::delete('/admin/exercise/delete/{id}', [ExercisesController::class, 'delete'])->name('admin.exercise.delete');
        // Admin / ChatPage
        Route::get('/admin/chat', [ChatController::class, 'adminChat'])->name('chat.adminChat');
        Route::post('/admin/chat/store', [ChatController::class, 'storeAnswer'])->name('chat.storeAnswer');
        // Route::get('/admin/chat/search',[ChatController::class, 'adminSearch'])->name('admin.chat.search');
    });
});
