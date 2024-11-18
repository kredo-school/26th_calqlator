<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner;
use App\Models\Condition;
use App\Models\UserSnack;
use App\Models\UserSupplement;
use App\Models\UserExercise;


class UserHomePageController extends Controller
{
    private $user;
    private $breakfast;
    private $lunch;
    private $dinner;
    private $condition;
    private $snack;
    private $supplement;
    private $workout;

    public function __construct(User $user, UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner, Condition $condition, UserSnack $snack, UserSupplement $supplement, UserExercise $workout)
    {
        $this->user = $user;
        $this->breakfast = $breakfast;
        $this->lunch = $lunch;
        $this->dinner = $dinner;
        $this->condition = $condition;
        $this->snack = $snack;
        $this->supplement = $supplement;
        $this->workout = $workout;
    }

    public function index(){
        $date = now()->format('m / j / Y');
        $today = now()->format('Y-m-d');

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $workouts = $this->workout->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $totalCalories = 0;
        $breakfastCalories = 0;
        $lunchCalories = 0;
        $dinnerCalories = 0;
        $snackCalories = 0;
        $supplementCalories = 0;
        $workoutCalories = 0;
        foreach($breakfasts as $breakfast){
            $breakfastCalories += $breakfast->amount * $breakfast->food->calories;
        }
        foreach($lunches as $lunch){
            $lunchCalories += $lunch->amount * $lunch->food->calories;
        }
        foreach($dinners as $dinner){
            $dinnerCalories += $dinner->amount * $dinner->food->calories;
        }
        foreach($snacks as $snack){
            $snackCalories += $snack->amount * $snack->food->calories;
        }
        foreach($supplements as $supplement){
            $supplementCalories += $supplement->amount * $supplement->food->calories;
        }
        foreach($workouts as $workout){
            $workoutCalories += ($workout->time)/10 * $workout->exercise->calories;
        }
        $totalCalories = $breakfastCalories + $lunchCalories + $dinnerCalories;

        $breakfastTime = $this -> breakfast -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $lunchTime = $this -> lunch -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $dinnerTime = $this -> dinner -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $snackTime = $this -> snack -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $supplementTime = $this -> supplement -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();

        return view('users.homepage')->with('date', $date)
                                     ->with('today', $today)
                                     ->with('breakfasts', $breakfasts)
                                     ->with('lunches', $lunches)
                                     ->with('dinners', $dinners)
                                     ->with('snacks', $snacks)
                                     ->with('supplements', $supplements)
                                     ->with('workouts', $workouts)
                                     ->with('breakfastCalories', $breakfastCalories)
                                     ->with('lunchCalories', $lunchCalories)
                                     ->with('dinnerCalories', $dinnerCalories)
                                     ->with('snackCalories', $snackCalories)
                                     ->with('supplementCalories', $supplementCalories)
                                     ->with('workoutCalories', $workoutCalories)
                                     ->with('totalCalories', $totalCalories)
                                     ->with('breakfastTime', $breakfastTime)
                                     ->with('lunchTime', $lunchTime)
                                     ->with('dinnerTime', $dinnerTime)
                                     ->with('snackTime', $snackTime)
                                     ->with('supplementTime', $supplementTime);
    }
    
    public function breakfastDelete($id){
        $this->breakfast->where('id', $id)->delete();
        return redirect()->back();
    }

    public function lunchDelete($id){
        $this->lunch->where('id', $id)->delete();
        return redirect()->back();
    }

    public function dinnerDelete($id){
        $this->dinner->where('id', $id)->delete();
        return redirect()->back();
    }

    public function workoutDelete($id){
        $this->workout->where('id', $id)->delete();
        return redirect()->back();
    }
}

