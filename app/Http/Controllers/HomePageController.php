<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner;
use App\Models\Condition;
use App\Models\UserExercise;

class HomePageController extends Controller
{
    private $user;
    private $breakfast;
    private $lunch;
    private $dinner;
    private $condition;
    private $workout;

    public function __construct(User $user, UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner, Condition $condition, UserExercise $workout)
    {
        $this->user = $user;
        $this->breakfast = $breakfast;
        $this->lunch = $lunch;
        $this->dinner = $dinner;
        $this->condition = $condition;
        $this->workout = $workout;
    }

    public function index(){
        $date = now()->format('m / j / Y');
        $today = now()->format('Y-m-d');

        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $today)->get();
        
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $workouts = $this->workout->where('user_id', Auth::user()->id)->where('date', $today)->get();

        return view('users.homepage')->with('date', $date)
                                     ->with('today', $today)
                                     ->with('breakfasts', $breakfasts)
                                     ->with('lunches', $lunches)
                                     ->with('dinners', $dinners)
                                     ->with('workouts', $workouts);
    }
    
   
}

