<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use App\Models\Weight;


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
    private $weight;

    public function __construct(User $user, UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner, Condition $condition, UserSnack $snack, UserSupplement $supplement, UserExercise $workout,Weight $weight)
    {
        $this->user = $user;
        $this->breakfast = $breakfast;
        $this->lunch = $lunch;
        $this->dinner = $dinner;
        $this->condition = $condition;
        $this->snack = $snack;
        $this->supplement = $supplement;
        $this->workout = $workout;
        $this->weight = $weight;
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

        $breakfastTime = $this -> breakfast -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $lunchTime = $this -> lunch -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $dinnerTime = $this -> dinner -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $snackTime = $this -> snack -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $supplementTime = $this -> supplement -> where('user_id', Auth::user()->id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();

        $totalCalories = 0;
        $breakfastCalories = 0;
        $lunchCalories = 0;
        $dinnerCalories = 0;
        $snackCalories = 0;
        $supplementCalories = 0;
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
        $totalCalories = $breakfastCalories + $lunchCalories + $dinnerCalories+ $snackCalories + $supplementCalories;

        $workoutCalories = 0;
        foreach($workouts as $workout){
            $workoutCalories += $workout->time/10 * $workout->exercise->calories;
        }

        $condition = $this->condition->where('user_id', Auth::user()->id)->where('date', $today)->first();

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
                                     ->with('supplementTime', $supplementTime)
                                     ->with('condition', $condition);
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

    public function supplementDelete($id){
        $this->supplement->where('id', $id)->delete();
        return redirect()->back();
    }

    public function snackDelete($id){
        $this->snack->where('id', $id)->delete();
        return redirect()->back();
    }

    public function getTotalCalories(){
        $today = now()->format('Y-m-d');

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $totalCalories = 0;
        $breakfastCalories = 0;
        $lunchCalories = 0;
        $dinnerCalories = 0;
        $snackCalories = 0;
        $supplementCalories = 0;
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
        $totalCalories = $breakfastCalories + $lunchCalories + $dinnerCalories+ $snackCalories + $supplementCalories;

        return $totalCalories;
    }

    public function getWorkoutCalories(){
        $today = now()->format('Y-m-d');

        $workouts = $this->workout->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $workoutCalories = 0;
        foreach($workouts as $workout){
            $workoutCalories += $workout->time/10 * $workout->exercise->calories;
        }

        return $workoutCalories;
    }

    public function caloriesChart(){
        $totalCalories = $this->getTotalCalories();

        return response()->json($totalCalories);
    }

    public function workoutChart(){
        $workoutCalories = $this->getWorkoutCalories();

        return response()->json($workoutCalories);
    }

    public function proteinChart(){
        $today = now()->format('Y-m-d');

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $today)->get();
       
        $totalProtein = 0;
        $breakfastProtien = 0;
        $lunchProtien = 0;
        $dinnerProtien = 0;
        $snackProtien = 0;
        $supplementProtien = 0;
        foreach($breakfasts as $breakfast){
            $breakfastProtien += $breakfast->amount * $breakfast->food->protein;
        }
        foreach($lunches as $lunch){
            $lunchProtien += $lunch->amount * $lunch->food->protein;
        }
        foreach($dinners as $dinner){
            $dinnerProtien += $dinner->amount * $dinner->food->protein;
        }
        foreach($snacks as $snack){
            $snackProtien += $snack->amount * $snack->food->protein;
        }
        foreach($supplements as $supplement){
            $supplementProtien += $supplement->amount * $supplement->food->protein;
        }

        $totalProtein = $breakfastProtien + $lunchProtien + $dinnerProtien + $snackProtien + $supplementProtien;

        return response()->json($totalProtein);
    }

    public function fatChart(){
        $today = now()->format('Y-m-d');

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $totalFat = 0;
        $breakfastFat = 0;
        $lunchFat = 0;
        $dinnerFat = 0;
        $snackFat = 0;
        $supplementFat = 0;
        foreach($breakfasts as $breakfast){
            $breakfastFat += $breakfast->amount * $breakfast->food->fat;
        }
        foreach($lunches as $lunch){
            $lunchFat += $lunch->amount * $lunch->food->fat;
        }
        foreach($dinners as $dinner){
            $dinnerFat += $dinner->amount * $dinner->food->fat;
        }
        foreach($snacks as $snack){
            $snackFat += $snack->amount * $snack->food->fat;
        }
        foreach($supplements as $supplement){
            $supplementFat += $supplement->amount * $supplement->food->fat;
        }

        $totalFat = $breakfastFat + $lunchFat + $dinnerFat + $snackFat + $supplementFat;

        return response()->json($totalFat);
    }

    public function carbsChart(){
        $today = now()->format('Y-m-d');

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $today)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $totalCarbs = 0;
        $breakfastCarbs = 0;
        $lunchCarbs = 0;
        $dinnerCarbs = 0;
        $snackCarbs = 0;
        $supplementCarbs = 0;
        foreach($breakfasts as $breakfast){
            $breakfastCarbs += $breakfast->amount * $breakfast->food->carbs;
        }
        foreach($lunches as $lunch){
            $lunchCarbs += $lunch->amount * $lunch->food->carbs;
        }
        foreach($dinners as $dinner){
            $dinnerCarbs += $dinner->amount * $dinner->food->carbs;
        }
        foreach($snacks as $snack){
            $snackCarbs += $snack->amount * $snack->food->carbs;
        }
        foreach($supplements as $supplement){
            $supplementCarbs += $supplement->amount * $supplement->food->carbs;
        }

        $totalCarbs = $breakfastCarbs + $lunchCarbs + $dinnerCarbs + $snackCarbs + $supplementCarbs;

        return response()->json($totalCarbs);
    }

    public function weightChart(){
        try{
        // $today = now()->format('Y-m-d');
        $today = Carbon::today();
        $firstDayOfMonth = $today->copy()->startOfMonth();
        $lastDayOfMonth = $today->copy()->endOfMonth();
        
        $weights = $this->weight
                        ->where('user_id', Auth::user()->id)
                        ->whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])  
                        ->orderBy('date', 'asc') 
                        ->get();
      
        $weightData=[];
        foreach($weights as $weight){
            $date = Carbon::parse($weight->date);
            $weightData[] = [
                'date' => $date->format('Y-m-d'), 
                'weight' => $weight->weight
            ];
        }
        return response()->json($weightData);
    } catch (\Exception $e) {
        // Log the error and return a 500 error with a message
        \Log::error('Error fetching weight chart data: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
    }
}

