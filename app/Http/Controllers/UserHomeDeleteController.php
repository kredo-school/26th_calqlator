<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner;
use App\Models\UserSnack;
use App\Models\UserSupplement;
use App\Models\UserExercise;

class UserHomeDeleteController extends Controller
{
    private $breakfast;
    private $lunch;
    private $dinner;
    private $snack;
    private $supplement;
    private $workout;

    public function __construct(UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner, UserSnack $snack, UserSupplement $supplement, UserExercise $workout)
    {
        $this->breakfast = $breakfast;
        $this->lunch = $lunch;
        $this->dinner = $dinner;
        $this->snack = $snack;
        $this->supplement = $supplement;
        $this->workout = $workout;
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

}
