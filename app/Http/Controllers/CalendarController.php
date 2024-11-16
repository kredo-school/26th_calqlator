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

        // $totalCalories = 0;

        // $breakfasts = $this->breakfast->where('date','=', $date)->where('user_id', $user->id)->get();
        // foreach($breakfasts as $breakfast){
        //     $totalCalories += $breakfast->food->calories;
        // }
        // $lunches = $this->lunch->where('date','=', $date)->where('user_id', $user->id)->get();
        // foreach($lunches as $lunch){
        //     $totalCalories += $lunch->food->calories;
        // }
        // $dinners = $this->dinner->where('date','=', $date)->where('user_id', $user->id)->get();
        // foreach($dinners as $dinner){
        //     $totalCalories += $dinner->food->calories;
        // }

        // return response()->json(["weight"=> $weight,"totalCalories" => $totalCalories]);
        return response()->json($weight);

    }

}