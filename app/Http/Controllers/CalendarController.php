<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner; 
use App\Models\Weight;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $weight;
    private $breakfast;
    private $lunch;
    private $dinner;
    // private $snack;
    // private $supplement;


    public function __construct(Weight $weight, UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner){
        $this -> breakfast = $breakfast;
        $this -> lunch = $lunch;
        $this -> dinner = $dinner;
        $this -> weight = $weight;
    }

    public function index(){
        return view('users.calendar');
    }


    public function everydayInfo(Request $request, $date){
        $user = Auth::user();

        $weight = $this->weight->where('date','=', $date)->where('user_id', $user->id)->get();

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $date)->get();
        // $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $today)->get();
        // $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $totalCalories = 0;
        $breakfastCalories = 0;
        $lunchCalories = 0;
        $dinnerCalories = 0;
        // $snackCalories = 0;
        // $supplementCalories = 0;

        foreach($breakfasts as $breakfast){
            $breakfastCalories += $breakfast->amount * $breakfast->food->calories;
        }
        foreach($lunches as $lunch){
            $lunchCalories += $lunch->amount * $lunch->food->calories;
        }
        foreach($dinners as $dinner){
            $dinnerCalories += $dinner->amount * $dinner->food->calories;
        }
        // foreach($snacks as $snack){
            // $snackCalories += $snack->amount * $snack->food->calories;
        // }
        // foreach($supplements as $supplement){
            // $supplementCalories += $supplement->amount * $supplement->food->calories;
        // }

        $totalCalories = $breakfastCalories + $lunchCalories + $dinnerCalories;
        // $totalCalories = $breakfastCalories + $lunchCalories + $dinnerCalories + $snackCalories + $supplementCalories;

        return response()->json(['weight'=> $weight->first(),'totalCalories' => $totalCalories]);
    }

}