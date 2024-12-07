<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DateTime;
use App\Models\User;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner;
use App\Models\Condition;
use App\Models\UserSnack;
use App\Models\UserSupplement;
use App\Models\UserExercise;
use App\Models\Weight;
use App\Models\UserInformation;


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
    private $information;
    protected $today;

    public function __construct(User $user, UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner, Condition $condition, UserSnack $snack, UserSupplement $supplement, UserExercise $workout,Weight $weight,UserInformation $information)
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
        $this->information = $information;
    }

    private function isValidDate($date){
        try {
            Carbon::parse($date);
            return true; 
        } catch (\Exception $e) {
            return false; 
        }
    }

    public function index($date){
        if(Route::is('login') || Route::is('register')){
            $today=now()->format('Y-m-d');
        }else{
            if ($this->isValidDate($date)) {
                $passDate = Carbon::parse($date);
                $today = $passDate->format('Y-m-d');
                $titleDate = $passDate->format('F j, Y');
            } else {
                $today = now()->format('Y-m-d');
                $titleDate = now()->format('F j, Y');
            }
        }

        $id = Auth::user()->id;

        $breakfasts = $this->breakfast->where('user_id', $id)->where('date', $today)->get();
        $lunches = $this->lunch->where('user_id', $id)->where('date', $today)->get();
        $dinners = $this->dinner->where('user_id', $id)->where('date', $today)->get();
        $snacks = $this->snack->where('user_id', $id)->where('date', $today)->get();
        $supplements = $this->supplement->where('user_id', $id)->where('date', $today)->get();
        $workouts = $this->workout->where('user_id', $id)->where('date', $today)->get();

        $breakfastTime = $this -> breakfast -> where('user_id', $id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $lunchTime = $this -> lunch -> where('user_id', $id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $dinnerTime = $this -> dinner -> where('user_id', $id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $snackTime = $this -> snack -> where('user_id', $id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();
        $supplementTime = $this -> supplement -> where('user_id', $id)->where('date', $today)->where('time_eaten', '!=', null)->orderBy('time_eaten', 'asc')->first();

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

        $condition = $this->condition->where('user_id', $id)->where('date', $today)->first();

        $weight = $this->weight->where('user_id', $id)->where('date', $today)->first();

        $goalCalories = ceil($this->getGoalCalories($date));
        $remainingCalories = $totalCalories - $goalCalories;

        $workoutGoal = $this->getWorkoutGoal($date);

        $totalProtein = $this->getTotalProtein($date);
        $proteinMinMax = $this->getProteinMinMax();
        $proteinMin = $proteinMinMax[0];
        $proteinMax = $proteinMinMax[1];

        $totalFat = $this->getTotalFat($date);
        $fatMinMax = $this->getFatMinMax();
        $fatMin = $fatMinMax[0];
        $fatMax = $fatMinMax[1];

        $totalCarbs = $this->getTotalCarbs($date);
        $carbsMinMax = $this->getCarbsMinMax();
        $carbsMin = $carbsMinMax[0];
        $carbsMax = $carbsMinMax[1];

        return view('users.homepage')->with('titleDate', $titleDate)
                                     ->with('date', $date)   
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
                                     ->with('condition', $condition)
                                     ->with('weight', $weight)
                                     ->with('goalCalories', $goalCalories)
                                     ->with('remainingCalories', $remainingCalories)
                                     ->with('workoutGoal', $workoutGoal)
                                     ->with('totalProtein', $totalProtein)
                                     ->with('proteinMin', $proteinMin)
                                     ->with('proteinMax', $proteinMax)
                                     ->with('totalFat', $totalFat)
                                     ->with('fatMin', $fatMin)
                                     ->with('fatMax', $fatMax)
                                     ->with('totalCarbs', $totalCarbs)
                                     ->with('carbsMin', $carbsMin)
                                     ->with('carbsMax', $carbsMax);
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

    public function getTotalCalories($date){
        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $date)->get();

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

    public function getWorkoutCalories($date){
        $workouts = $this->workout->where('user_id', Auth::user()->id)->where('date', $date)->get();

        $workoutCalories = 0;
        foreach($workouts as $workout){
            $workoutCalories += $workout->time/10 * $workout->exercise->calories;
        }

        return $workoutCalories;
    }

    public function caloriesChart($date){
        $totalCalories = $this->getTotalCalories($date);
        $goalCalories = ceil($this->getGoalCalories($date));
        $BMR = $this->getBMR();

        $chartData = [ 
            'totalCalories' => $totalCalories,
            'goalCalories' => $goalCalories,
            'BMR' => $BMR
        ];

        return response()->json($chartData);
    }

    public function workoutChart($date){
        $workoutCalories = $this->getWorkoutCalories($date);
        $workoutGoal = ceil($this->getWorkoutGoal($date));

        $workoutData = [
            'workoutCalories' => $workoutCalories,
            'workoutGoal' => $workoutGoal
        ];

        return response()->json($workoutData);
    }

    public function proteinChart($date){
        $totalProtein = $this->getTotalProtein($date);
        $proteinMinMax = $this->getProteinMinMax();
        $proteinData = [
            'totalProtein' => $totalProtein,
            'proteinMinMax' => $proteinMinMax
        ];

        return response()->json($proteinData);
    }

    public function fatChart($date){
        $totalFat = $this->getTotalFat($date);
        $fatMinMax = $this->getFatMinMax();

        $fatData = [
            'totalFat' => $totalFat,
            'fatMinMax' => $fatMinMax
        ];
        return response()->json($fatData);
    }

    public function carbsChart($date){
        $totalCarbs = $this->getTotalCarbs($date);
        $carbsMinMax = $this->getCarbsMinMax();
        $carbsData = [
            'totalCarbs' => $totalCarbs,
            'carbsMinMax' => $carbsMinMax
        ];
        return response()->json($carbsData);
    }

    public function weightChart(){
        try{
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
            \Log::error('Error fetching weight chart data: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getReferenceWeight(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        if($userInfo === null){
            $gender = 'female';
            $age = 20;
        }else{
            $gender = $userInfo->gender;
            $age = $this->getAge();
        }

        if($gender == 'male'){
            if(1 <= $age && $age <= 2){
                $referenceWeight =11.5;
            }else if(3 <= $age && $age <= 5){
                $referenceWeight =16.5;
            }else if(6 <= $age && $age <= 7){
                $referenceWeight =22.2;
            }else if(8 <= $age && $age <= 9){
                $referenceWeight =28;
            }else if(10 <= $age && $age <= 11){
                $referenceWeight =35.6;
            }else if(12 <= $age && $age <= 14){
                $referenceWeight =49;
            }else if(15 <= $age && $age <= 17){
                $referenceWeight =59.7;
            }else if(18 <= $age && $age <= 29){
                $referenceWeight =64.5;
            }else if(30 <= $age && $age <= 49){
                $referenceWeight =68.1;
            }else if(50 <= $age && $age <= 64){
                $referenceWeight =68;
            }else if(65 <= $age && $age <= 74){
                $referenceWeight =65;
            }else{
                $referenceWeight =59.6;
            }
        }else if($gender == 'female'){
            if(1 <= $age && $age <= 2){
                $referenceWeight =11;
            }else if(3 <= $age && $age <= 5){
                $referenceWeight =16.1;
            }else if(6 <= $age && $age <= 7){
                $referenceWeight =21.9;
            }else if(8 <= $age && $age <= 9){
                $referenceWeight =27.4;
            }else if(10 <= $age && $age <= 11){
                $referenceWeight =36.3;
            }else if(12 <= $age && $age <= 14){
                $referenceWeight =47.5;
            }else if(15 <= $age && $age <= 17){
                $referenceWeight =51.9;
            }else if(18 <= $age && $age <= 29){
                $referenceWeight =50.3;
            }else if(30 <= $age && $age <= 49){
                $referenceWeight =53;
            }else if(50 <= $age && $age <= 64){
                $referenceWeight =53.8;
            }else if(65 <= $age && $age <= 74){
                $referenceWeight =52.1;
            }else{
                $referenceWeight =48.8;
            }
        }
        return $referenceWeight;
    }

    public function getAge(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        if($userInfo === null){
            $age = 20;
        }else{
            $birthday = Carbon::parse($userInfo->birthday);
            $today = Carbon::now();

            $age = Carbon::parse($birthday)->age;
        }
        
        return $age;
    }

    public function getBMR(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        if($userInfo === null){
            $gender = 'female';
            $age = 20;
        }else{
            $gender = $userInfo->gender;
            $age = $this->getAge();
        }

        $userWeightInfo = $this->weight->where('user_id', $id)->latest()->first();
        if ($userWeightInfo === null) {
            $weight = $this->getReferenceWeight();
        } else {
            $weight = $userWeightInfo->weight;
        }

        if($gender == 'male'){
            if(1 <= $age && $age <= 2){
                $BMR = 61 * $weight;
            }else if(3 <= $age && $age <= 5){
                $BMR = 54.8 * $weight;
            }else if(6 <= $age && $age <= 7){
                $BMR = 44.3 * $weight;
            }else if(8 <= $age && $age <= 9){
                $BMR = 40.8 * $weight;
            }else if(10 <= $age && $age <= 11){
                $BMR = 37.4 * $weight;
            }else if(12 <= $age && $age <= 14){
                $BMR = 31 * $weight;
            }else if(15 <= $age && $age <= 17){
                $BMR = 27 * $weight;
            }else if(18 <= $age && $age <= 29){
                $BMR = 23.7 * $weight;
            }else if(30 <= $age && $age <= 49){
                $BMR = 22.5 * $weight;
            }else if(50 <= $age && $age <= 64){
                $BMR = 21.8 * $weight;
            }else if(65 <= $age && $age <= 74){
                $BMR = 21.6 * $weight;
            }else{
                $BMR = 21.5 * $weight;
            }
        }else{
            if(1 <= $age && $age <= 2){
                $BMR = 59.7 * $weight;
            }else if(3 <= $age && $age <= 5){
                $BMR = 52.2 * $weight;
            }else if(6 <= $age && $age <= 7){
                $BMR = 41.9 * $weight;
            }else if(8 <= $age && $age <= 9){
                $BMR = 38.3 * $weight;
            }else if(10 <= $age && $age <= 11){
                $BMR = 34.8 * $weight;
            }else if(12 <= $age && $age <= 14){
                $BMR = 29.6 * $weight;
            }else if(15 <= $age && $age <= 17){
                $BMR = 25.3 * $weight;
            }else if(18 <= $age && $age <= 29){
                $BMR = 22.1 * $weight;
            }else if(30 <= $age && $age <= 49){
                $BMR = 21.9 * $weight;
            }else{
                $BMR = 20.7 * $weight;
            }
        }
        return $BMR;
    }

    public function getPAL(){
        $id = Auth::user()->id;
        
        $userInfo= $this -> information -> where('user_id', $id) -> first();
        if($userInfo === null){
            $age = 20;
            $activityLevel = 2;
        }else{
            $age = $this->getAge();
            $activityLevel = $userInfo -> activity_level;
        }

        if($activityLevel == 1){
            if(6 <= $age && $age <= 7){
                $PAL = 1.35;
            }else if(8 <= $age && $age <= 9){
                $PAL = 1.4;
            }else if(10 <= $age && $age <= 11){
                $PAL = 1.45;
            }else if(12 <= $age && $age <= 14){
                $PAL = 1.5;
            }else if(15 <= $age && $age <= 17){
                $PAL = 1.55;
            }else if(18 <= $age && $age <= 64){
                $PAL = 1.5;
            }else if(65 <= $age && $age <= 74){
                $PAL = 1.45;
            }else if(75 <= $age){
                $PAL = 1.4;
            }else{
                $PAL = 0;
            }
        }else if($activityLevel == 2){
            if(1 <= $age && $age <= 2){
                $PAL = 1.35;
            }else if(3 <= $age && $age <= 5){
                $PAL = 1.45;
            }else if(6 <= $age && $age <= 7){
                $PAL = 1.55;
            }else if(8 <= $age && $age <= 9){
                $PAL = 1.6;
            }else if(10 <= $age && $age <= 11){
                $PAL = 1.65;
            }else if(12 <= $age && $age <= 14){
                $PAL = 1.7;
            }else if(15 <= $age && $age <= 64){
                $PAL = 1.75;
            }else if(65 <= $age && $age <= 74){
                $PAL = 1.70;
            }else{
                $PAL = 1.65;
            }
        }else{
            if(6 <= $age && $age <= 7){
                $PAL = 1.75;
            }else if(8 <= $age && $age <= 9){
                $PAL = 1.8;
            }else if(10 <= $age && $age <= 11){
                $PAL = 1.85;
            }else if(12 <= $age && $age <= 14){
                $PAL = 1.9;
            }else if(15 <= $age && $age <= 17){
                $PAL = 1.95;
            }else if(18 <= $age && $age <= 64){
                $PAL = 2;
            }else if(65 <= $age && $age <= 74){
                $PAL = 1.95;
            }else{
                $PAL = 0;
            }
        }

        return $PAL;
    }

    public function getCaloriesDifference($date){
        $id = Auth::user()->id;
        
        $weight = $this -> weight -> where('user_id', $id)->where('date', $date)->first();    
            if ($weight === null) {
                $weight = $this->weight->where('user_id', $id)->latest()->first();
                if ($weight === null) {
                    $weight = $this->getReferenceWeight();
                    $todaysWeight = $weight; 
                } else {
                    $todaysWeight = $weight->weight; 
                }
            } else {
                $todaysWeight = $weight->weight; 
            }

        $userInfo = $this->information->where('user_id', $id)->first();
            if($userInfo === null){
                $goal = 1;
                $goalWeight = $weight;
                $goalDate = $date;
            }else{
                $goal = $userInfo->goal;
                $goalWeight = $userInfo->goal_weight;
                $goalDate = $userInfo->goal_date; 
            }

        if($goalDate === $date){
            $daysDifference = 1;
        }else{
            $daysDifference = Carbon::parse($date)->diffInDays(Carbon::parse($goalDate));
        }

        $weightDifference = 0;
        if($goal === 1){
            $weightDifference = $todaysWeight - $goalWeight;
        }else if($goal === 3){
            $weightDifference = $goalWeight - $todaysWeight;
        }
        $everydayDifference = ($weightDifference * 7200) / $daysDifference;
        

        return $everydayDifference;
    }

    public function getGoalCalories($date){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
            if($userInfo === null){
                $goal = 1;
                $how = 2;
            }else{
                $goal = $userInfo->goal;
                $how = $userInfo->how_to_lose;
            }

        $BMR = $this->getBMR();
        $PAL = $this->getPAL();
        $everydayDifference = $this->getCaloriesDifference($date);
        $neededCalories = ceil($BMR * $PAL);

        if($goal === 1){
            if($how === 1){
                if(($neededCalories - $everydayDifference) > $this->getBMR()){
                    $goalCalories = $neededCalories - $everydayDifference;
                }else{
                    $goalCalories = $this->getBMR();
                }
            }else if ($how === 2){
                $halfDifference = $everydayDifference / 2;
                if($neededCalories - $halfDifference > $this->getBMR()){
                    $goalCalories = $neededCalories - $halfDifference;
                }else{
                    $goalCalories = $this->getBMR();
                }
            }else{
                $goalCalories = $neededCalories;
            }
        }else if($goal === 2){
            $goalCalories = $neededCalories;
        }else{
            $goalCalories = $neededCalories + $everydayDifference;
        }

        return $goalCalories;
    }

    public function getWorkoutGoal($date){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
            if($userInfo === null){
                $goal = 1;
                $how = 2;
            }else{
                $goal = $userInfo->goal;
                $how = $userInfo->how_to_lose;
            }
        $BMR = $this->getBMR();
        $PAL = $this->getPAL();
        $everydayDifference = $this->getCaloriesDifference($date);
        $neededCalories = ceil($BMR * $PAL);
        
        if($goal === 1){
            if($how === 1){
                if(($neededCalories - $everydayDifference) > $this->getBMR()){
                    $workoutGoal = 0;
                }else{
                    $workoutGoal = $BMR - $neededCalories + $everydayDifference;
                }
            }else if($how === 2){
                $halfDifference = $everydayDifference / 2;
                if($neededCalories - $halfDifference > $this->getBMR()){
                    $workoutGoal = $halfDifference;
                }else{
                    $workoutGoal = $BMR - $neededCalories + $everydayDifference;
                }
            }else{
                $workoutGoal = $everydayDifference;
            }
            
        }else{
            $workoutGoal = 0;
        }

        return $workoutGoal;
    }

    public function getTotalProtein($date){
        $breakfasts = $this->breakfast->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $lunches = $this->lunch->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $dinners = $this->dinner->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $snacks = $this->snack->where('user_id', Auth::user()->id)->where('date', $date)->get();
        $supplements = $this->supplement->where('user_id', Auth::user()->id)->where('date', $date)->get();
       
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

        return $totalProtein;
    }
    public function getProteinMinMax(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        if($userInfo === null){
            $gender = 'female';
            $age = 20;
            $activityLevel = 2;
        }else{
            $gender = $userInfo->gender;
            $age = $this->getAge();
            $activityLevel = $userInfo->activity_level;
        }

        if($gender == 'male'){
            if($activityLevel == 1){
                if(1 <= $age && $age <= 2){
                    $proteinMin = 20;
                    $proteinMax = 20;
                }else if(3 <= $age && $age <= 5){
                    $proteinMin = 25;
                    $proteinMax = 25;
                }else if(6 <= $age && $age <= 7){
                    $proteinMin = 44;
                    $proteinMax = 68;
                }else if(8 <= $age && $age <= 9){
                    $proteinMin = 52;
                    $proteinMax = 80;
                }else if(10 <= $age && $age <= 11){
                    $proteinMin = 63;
                    $proteinMax = 98;
                }else if(12 <= $age && $age <= 14){
                    $proteinMin = 75;
                    $proteinMax = 115;
                }else if(15 <= $age && $age <= 17){
                    $proteinMin = 81;
                    $proteinMax = 125;
                }else if(18 <= $age && $age <= 49){
                    $proteinMin = 75;
                    $proteinMax = 115;
                }else if(50 <= $age && $age <= 64){
                    $proteinMin = 77;
                    $proteinMax = 110;
                }else if(65 <= $age && $age <= 74){
                    $proteinMin = 77;
                    $proteinMax = 103;
                }else{
                    $proteinMin = 68;
                    $proteinMax = 90;
                }
            }else if($activityLevel == 2){
                if(1 <= $age && $age <= 2){
                    $proteinMin = 31;
                    $proteinMax = 48;
                }else if(3 <= $age && $age <= 5){
                    $proteinMin = 42;
                    $proteinMax = 65;
                }else if(6 <= $age && $age <= 7){
                    $proteinMin = 49;
                    $proteinMax = 75;
                }else if(8 <= $age && $age <= 9){
                    $proteinMin = 60;
                    $proteinMax =93;
                }else if(10 <= $age && $age <= 11){
                    $proteinMin = 72;
                    $proteinMax = 110;
                }else if(12 <= $age && $age <= 14){
                    $proteinMin = 85;
                    $proteinMax = 130;
                }else if(15 <= $age && $age <= 17){
                    $proteinMin = 91;
                    $proteinMax = 140;
                }else if(18 <= $age && $age <= 29){
                    $proteinMin = 86;
                    $proteinMax = 133;
                }else if(30 <= $age && $age <= 49){
                    $proteinMin = 88;
                    $proteinMax = 135;
                }else if(50 <= $age && $age <= 64){
                    $proteinMin = 91;
                    $proteinMax = 130;
                }else if(65 <= $age && $age <= 74){
                    $proteinMin = 90;
                    $proteinMax = 120;
                }else{
                    $proteinMin = 79;
                    $proteinMax = 105;
                }
            }else{
                if(1 <= $age && $age <= 2){
                    $proteinMin = 20;
                    $proteinMax = 20;
                }else if(3 <= $age && $age <= 5){
                    $proteinMin = 25;
                    $proteinMax = 25;
                }else if(6 <= $age && $age <= 7){
                    $proteinMin = 55;
                    $proteinMax = 85;
                }else if(8 <= $age && $age <= 9){
                    $proteinMin = 67;
                    $proteinMax = 103;
                }else if(10 <= $age && $age <= 11){
                    $proteinMin = 80;
                    $proteinMax = 123;
                }else if(12 <= $age && $age <= 14){
                    $proteinMin = 94;
                    $proteinMax = 145;
                }else if(15 <= $age && $age <= 17){
                    $proteinMin = 102;
                    $proteinMax = 158;
                }else if(18 <= $age && $age <= 49){
                    $proteinMin = 99;
                    $proteinMax = 153;
                }else if(50 <= $age && $age <= 64){
                    $proteinMin = 103;
                    $proteinMax = 148;
                }else if(65 <= $age && $age <= 74){
                    $proteinMin = 103;
                    $proteinMax = 138;
                }else{
                    $proteinMin = 60;
                    $proteinMax = 60;
                }
            }
        }else{
            if($activityLevel == 1){
                if(1 <= $age && $age <= 2){
                    $proteinMin = 20;
                    $proteinMax = 20;
                }else if(3 <= $age && $age <= 5){
                    $proteinMin = 25;
                    $proteinMax = 25;
                }else if(6 <= $age && $age <= 7){
                    $proteinMin = 41;
                    $proteinMax = 63;
                }else if(8 <= $age && $age <= 9){
                    $proteinMin = 47;
                    $proteinMax = 73;
                }else if(10 <= $age && $age <= 11){
                    $proteinMin = 60;
                    $proteinMax = 93;
                }else if(12 <= $age && $age <= 14){
                    $proteinMin = 68;
                    $proteinMax = 105;
                }else if(15 <= $age && $age <= 17){
                    $proteinMin = 67;
                    $proteinMax = 103;
                }else if(18 <= $age && $age <= 49){
                    $proteinMin = 57;
                    $proteinMax = 88;
                }else if(50 <= $age && $age <= 64){
                    $proteinMin = 58;
                    $proteinMax = 83;
                }else if(65 <= $age && $age <= 74){
                    $proteinMin = 58;
                    $proteinMax = 78;
                }else{
                    $proteinMin = 53;
                    $proteinMax = 70;
                }
            }else if($activityLevel == 2){
                if(1 <= $age && $age <= 2){
                    $proteinMin = 29;
                    $proteinMax = 45;
                }else if(3 <= $age && $age <= 5){
                    $proteinMin = 39;
                    $proteinMax = 60;
                }else if(6 <= $age && $age <= 7){
                    $proteinMin = 46;
                    $proteinMax = 70;
                }else if(8 <= $age && $age <= 9){
                    $proteinMin = 55;
                    $proteinMax = 85;
                }else if(10 <= $age && $age <= 11){
                    $proteinMin = 68;
                    $proteinMax = 105;
                }else if(12 <= $age && $age <= 14){
                    $proteinMin = 78;
                    $proteinMax = 120;
                }else if(15 <= $age && $age <= 17){
                    $proteinMin = 75;
                    $proteinMax = 115;
                }else if(18 <= $age && $age <= 29){
                    $proteinMin = 65;
                    $proteinMax = 100;
                }else if(30 <= $age && $age <= 49){
                    $proteinMin = 67;
                    $proteinMax = 103;
                }else if(50 <= $age && $age <= 64){
                    $proteinMin = 68;
                    $proteinMax = 98;
                }else if(65 <= $age && $age <= 74){
                    $proteinMin = 69;
                    $proteinMax = 93;
                }else{
                    $proteinMin = 62;
                    $proteinMax = 83;
                }
            }else if($activityLevel == 3){
                if(1 <= $age && $age <= 2){
                    $proteinMin = 20;
                    $proteinMax = 20;
                }else if(3 <= $age && $age <= 5){
                    $proteinMin = 25;
                    $proteinMax = 25;
                }else if(6 <= $age && $age <= 7){
                    $proteinMin = 52;
                    $proteinMax = 80;
                }else if(8 <= $age && $age <= 9){
                    $proteinMin = 62;
                    $proteinMax = 95;
                }else if(10 <= $age && $age <= 11){
                    $proteinMin = 76;
                    $proteinMax = 118;
                }else if(12 <= $age && $age <= 14){
                    $proteinMin = 86;
                    $proteinMax = 133;
                }else if(15 <= $age && $age <= 17){
                    $proteinMin = 83;    
                    $proteinMax = 128;
                }else if(18 <= $age && $age <= 29){
                    $proteinMin = 75;
                    $proteinMax = 115;
                }else if(30 <= $age && $age <= 49){
                    $proteinMin = 76;
                    $proteinMax = 118;
                }else if(50 <= $age && $age <= 64){
                    $proteinMin = 79;
                    $proteinMax = 113;
                }else if(65 <= $age && $age <= 74){
                    $proteinMin = 79;
                    $proteinMax = 105;
                }else{
                    $proteinMin = 50;
                    $proteinMax = 50;
                }
            }
        }

        $proteinMinMax = [$proteinMin, $proteinMax];
        return $proteinMinMax;
    }

    public function getTotalFat($date){
        $id = Auth::user()->id;

        $breakfasts = $this->breakfast->where('user_id', $id)->where('date', $date)->get();
        $lunches = $this->lunch->where('user_id',$id)->where('date', $date)->get();
        $dinners = $this->dinner->where('user_id', $id)->where('date', $date)->get();
        $snacks = $this->snack->where('user_id', $id)->where('date', $date)->get();
        $supplements = $this->supplement->where('user_id', $id)->where('date', $date)->get();

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

        return $totalFat;
    }

    public function getFatMinMax(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        if($userInfo === null){
            $gender = 'female';
            $age = 20;
            $activityLevel = 2;
        }else{
            $gender = $userInfo->gender;
            $age = $this->getAge();
            $activityLevel = $userInfo->activity_level;
        }

        if($gender == 'male'){
            if($activityLevel == 1){
                if(1 <= $age && $age <= 5){
                    $fatMin = 0;
                    $fatMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $fatMin = 30;
                    $fatMax = 45;
                }else if(8 <= $age && $age <= 9){
                    $fatMin = 36;
                    $fatMax = 53;
                }else if(10 <= $age && $age <= 11){
                    $fatMin = 44;
                    $fatMax = 65;
                }else if(12 <= $age && $age <= 14){
                    $fatMin = 52;
                    $fatMax = 76;
                }else if(15 <= $age && $age <= 17){
                    $fatMin = 56;
                    $fatMax = 83;
                }else if(18 <= $age && $age <= 49){
                    $fatMin = 52;
                    $fatMax = 76;
                }else if(50 <= $age && $age <= 64){
                    $fatMin = 49;
                    $fatMax = 73;
                }else if(65 <= $age && $age <= 74){
                    $fatMin = 46;
                    $fatMax = 68;
                }else{
                    $fatMin = 40;
                    $fatMax = 60;
                }
            }else if($activityLevel == 2){
                if(1 <= $age && $age <= 2){
                    $fatMin = 22;
                    $fatMax = 31;
                }else if(3 <= $age && $age <= 5){
                    $fatMin = 29;
                    $fatMax = 43;
                }else if(6 <= $age && $age <= 7){
                    $fatMin = 35;
                    $fatMax = 51;
                }else if(8 <= $age && $age <= 9){
                    $fatMin = 42;
                    $fatMax = 61;
                }else if(10 <= $age && $age <= 11){
                    $fatMin = 50;
                    $fatMax = 75;
                }else if(12 <= $age && $age <= 14){
                    $fatMin = 58;
                    $fatMax = 86;
                }else if(15 <= $age && $age <= 17){
                    $fatMin = 63;
                    $fatMax = 93;
                }else if(18 <= $age && $age <= 29){
                    $fatMin = 59;
                    $fatMax = 88;
                }else if(30 <= $age && $age <= 49){
                    $fatMin = 60;
                    $fatMax = 90;
                }else if(50 <= $age && $age <= 64){
                    $fatMin = 58;
                    $fatMax = 86;
                }else if(65 <= $age && $age <= 74){
                    $fatMin = 54;
                    $fatMax = 80;
                }else{
                    $fatMin = 47;
                    $fatMax = 70;
                }
            }else if($activityLevel == 3){
                if(6 <= $age && $age <= 7){
                    $fatMin = 39;
                    $fatMax = 58;
                }else if(8 <= $age && $age <= 9){
                    $fatMin = 47;
                    $fatMax = 70;
                }else if(10 <= $age && $age <= 11){
                    $fatMin = 56;
                    $fatMax = 83;
                }else if(12 <= $age && $age <= 14){
                    $fatMin = 65;
                    $fatMax = 96;
                }else if(15 <= $age && $age <= 17){
                    $fatMin = 70;
                    $fatMax = 105;
                }else if(18 <= $age && $age <= 49){
                    $fatMin = 68;
                    $fatMax = 101;
                }else if(50 <= $age && $age <= 64){
                    $fatMin = 66;
                    $fatMax = 98;
                }else if(65 <= $age && $age <= 74){
                    $fatMin = 62;
                    $fatMax = 91;
                }else{
                    $fatMin = 0;
                    $fatMax = 0;
                }
            }
        }else{
            if($activityLevel == 1){
                if(1 <= $age && $age <= 5){
                    $fatMin = 0;
                    $fatMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $fatMin = 28;
                    $fatMax = 41;
                }else if(8 <= $age && $age <= 9){
                    $fatMin = 34;
                    $fatMax = 50;
                }else if(10 <= $age && $age <= 11){
                    $fatMin = 42;
                    $fatMax = 61;
                }else if(12 <= $age && $age <= 14){
                    $fatMin = 48;
                    $fatMax = 71;
                }else if(15 <= $age && $age <= 17){
                    $fatMin = 46;
                    $fatMax = 68;
                }else if(18 <= $age && $age <= 29){
                    $fatMin = 38;
                    $fatMax = 56;
                }else if(30 <= $age && $age <= 49){
                    $fatMin = 39;
                    $fatMax = 58;
                }else if(50 <= $age && $age <= 64){
                    $fatMin = 37;
                    $fatMax = 55;
                }else if(65 <= $age && $age <= 74){
                    $fatMin = 35;
                    $fatMax = 51;
                }else{
                    $fatMin = 32;
                    $fatMax = 46;
                }
            }else if($activityLevel == 2){
                if(1 <= $age && $age <= 2){
                    $fatMin = 20;
                    $fatMax = 30;   
                }else if(3 <= $age && $age <= 5){
                    $fatMin = 28;
                    $fatMax = 41;
                }else if(6 <= $age && $age <= 7){
                    $fatMin = 33;
                    $fatMax = 48;
                }else if(8 <= $age && $age <= 9){
                    $fatMin = 38;
                    $fatMax = 56;
                }else if(10 <= $age && $age <= 11){
                    $fatMin = 47;
                    $fatMax = 70;
                }else if(12 <= $age && $age <= 14){
                    $fatMin = 54;
                    $fatMax = 80;
                }else if(15 <= $age && $age <= 17){
                    $fatMin = 52;
                    $fatMax = 76;
                }else if(18 <= $age && $age <= 29){
                    $fatMin = 45;
                    $fatMax = 66;
                }else if(30 <= $age && $age <= 49){
                    $fatMin = 46;
                    $fatMax = 68;
                }else if(50 <= $age && $age <= 64){
                    $fatMin = 44;
                    $fatMax = 65;
                }else if(65 <= $age && $age <= 74){
                    $fatMin = 42;
                    $fatMax = 61;
                }else{
                    $fatMin = 37;
                    $fatMax = 55;  
                }  
            }else if($activityLevel == 3){
                if(1 <= $age && $age <= 5){
                    $fatMin = 0;
                    $fatMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $fatMin = 37;
                    $fatMax = 55;
                }else if(8 <= $age && $age <= 9){
                    $fatMin = 43;
                    $fatMax = 63;
                }else if(10 <= $age && $age <= 11){
                    $fatMin = 53;
                    $fatMax = 78;
                }else if(12 <= $age && $age <= 14){
                    $fatMin = 60;
                    $fatMax = 90;
                }else if(15 <= $age && $age <= 17){
                    $fatMin = 57;
                    $fatMax = 85;                
                }else if(18 <= $age && $age <= 29){
                    $fatMin = 52;
                    $fatMax = 76;
                }else if(30 <= $age && $age <= 49){
                    $fatMin = 53;
                    $fatMax = 78;
                }else if(50 <= $age && $age <= 64){
                    $fatMin = 50;
                    $fatMax = 75;
                }else if(65 <= $age && $age <= 74){
                    $fatMin = 47;
                    $fatMax = 70;
                }else{
                    $fatMin = 0;
                    $fatMax = 0;
                }
            }
        }
        $fatMinMax = [$fatMin, $fatMax];
        return $fatMinMax;
    }

    public function getTotalCarbs($date){
        $id = Auth::user()->id;

        $breakfasts = $this->breakfast->where('user_id', $id)->where('date', $date)->get();
        $lunches = $this->lunch->where('user_id', $id)->where('date', $date)->get();
        $dinners = $this->dinner->where('user_id', $id)->where('date', $date)->get();
        $snacks = $this->snack->where('user_id', $id)->where('date', $date)->get();
        $supplements = $this->supplement->where('user_id', $id)->where('date', $date)->get();

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

        return $totalCarbs;
    }

    public function getCarbsMinMax(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        if($userInfo === null){
            $gender = 'female';
            $age = 20;
            $activityLevel = 2;
        }else{
            $gender = $userInfo->gender;
            $age = $this->getAge();
            $activityLevel = $userInfo->activity_level;
        }

        if($gender == 'male'){
            if($activityLevel == 1){
                if(1 <= $age && $age <= 5){
                    $carbsMin = 0;
                    $carbsMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $carbsMin = 169;
                    $carbsMax = 219;
                }else if(8 <= $age && $age <= 9){
                    $carbsMin = 200;
                    $carbsMax = 260;
                }else if(10 <= $age && $age <= 11){
                    $carbsMin = 244;
                    $carbsMax = 316;
                }else if(12 <= $age && $age <= 14){
                    $carbsMin = 288;
                    $carbsMax = 373;
                }else if(15 <= $age && $age <= 17){
                    $carbsMin = 313;
                    $carbsMax = 406;
                }else if(18 <= $age && $age <= 49){
                    $carbsMin = 288;
                    $carbsMax = 373;
                }else if(50 <= $age && $age <= 64){
                    $carbsMin = 275;
                    $carbsMax = 357;
                }else if(65 <= $age && $age <= 74){
                    $carbsMin = 257;
                    $carbsMax = 333;
                }else{
                    $carbsMin = 225;
                    $carbsMax = 292;
                }
            }else if($activityLevel == 2){
                if(1 <= $age && $age <= 2){
                    $carbsMin = 119;
                    $carbsMax = 154;
                }else if(3 <= $age && $age <= 5){
                    $carbsMin = 163;
                    $carbsMax = 211;
                }else if(6 <= $age && $age <= 7){
                    $carbsMin = 194;
                    $carbsMax = 251;
                }else if(8 <= $age && $age <= 9){
                    $carbsMin = 232;
                    $carbsMax = 300;
                }else if(10 <= $age && $age <= 11){
                    $carbsMin = 282;
                    $carbsMax = 365;
                }else if(12 <= $age && $age <= 14){
                    $carbsMin = 325;
                    $carbsMax = 422;
                }else if(15 <= $age && $age <= 17){
                    $carbsMin = 350;
                    $carbsMax = 455;
                }else if(18 <= $age && $age <= 29){
                    $carbsMin = 332;
                    $carbsMax = 430;
                }else if(30 <= $age && $age <= 49){
                    $carbsMin = 338;
                    $carbsMax = 438;
                }else if(50 <= $age && $age <= 64){
                    $carbsMin = 325;
                    $carbsMax = 422;
                }else if(65 <= $age && $age <= 74){
                    $carbsMin = 300;
                    $carbsMax = 390;
                }else{
                    $carbsMin = 263;
                    $carbsMax = 341;
                }
            }else if($activityLevel == 3){
                if(1 <= $age && $age <= 5){
                    $carbsMin = 0;
                    $carbsMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $carbsMin = 219;
                    $carbsMax = 284;
                }else if(8 <= $age && $age <= 9){
                    $carbsMin = 263;
                    $carbsMax = 341;
                }else if(10 <= $age && $age <= 11){
                    $carbsMin = 313;
                    $carbsMax = 406;
                }else if(12 <= $age && $age <= 14){
                    $carbsMin = 363;
                    $carbsMax = 471;
                }else if(15 <= $age && $age <= 17){
                    $carbsMin = 394;
                    $carbsMax = 511;
                }else if(18 <= $age && $age <= 49){
                    $carbsMin = 382;
                    $carbsMax = 495;
                }else if(50 <= $age && $age <= 64){
                    $carbsMin = 369;
                    $carbsMax = 479;
                }else if(65 <= $age && $age <= 74){
                    $carbsMin = 344;
                    $carbsMax = 446;
                }else{
                    $carbsMin = 0;
                    $carbsMax = 0;
                }
            }
        }else{
            if($activityLevel == 1){
                if(1 <= $age && $age <= 5){
                    $carbsMin = 0;
                    $carbsMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $carbsMin = 157;
                    $carbsMax = 203;
                }else if(8 <= $age && $age <= 9){
                    $carbsMin = 188;
                    $carbsMax = 243;
                }else if(10 <= $age && $age <= 11){
                    $carbsMin = 232;
                    $carbsMax = 300;
                }else if(12 <= $age && $age <= 14){
                    $carbsMin = 269;
                    $carbsMax = 349;
                }else if(15 <= $age && $age <= 17){
                    $carbsMin = 257;
                    $carbsMax = 333;  
                }else if(18 <= $age && $age <= 29){
                    $carbsMin = 213;
                    $carbsMax = 276;
                }else if(30 <= $age && $age <= 49){
                    $carbsMin = 219;
                    $carbsMax = 284;
                }else if(50 <= $age && $age <= 64){
                    $carbsMin = 207;
                    $carbsMax = 268;
                }else if(65 <= $age && $age <= 74){
                    $carbsMin = 194;
                    $carbsMax = 251;
                }else{
                    $carbsMin = 176;
                    $carbsMax = 227;
                }
            }else if($activityLevel == 2){
                if(1 <= $age && $age <= 2){
                    $carbsMin = 113;
                    $carbsMax = 146;
                }else if(3 <= $age && $age <= 5){
                    $carbsMin = 157;
                    $carbsMax = 203;
                }else if(6 <= $age && $age <= 7){
                    $carbsMin = 182;
                    $carbsMax = 235;
                }else if(8 <= $age && $age <= 9){
                    $carbsMin = 213;
                    $carbsMax = 276;
                }else if(10 <= $age && $age <= 11){
                    $carbsMin = 263;
                    $carbsMax = 341;
                }else if(12 <= $age && $age <= 14){
                    $carbsMin = 300;
                    $carbsMax = 390;
                }else if(15 <= $age && $age <= 17){
                    $carbsMin = 288;
                    $carbsMax = 373;
                }else if(18 <= $age && $age <= 29){
                    $carbsMin = 250;
                    $carbsMax = 325;
                }else if(30 <= $age && $age <= 49){
                    $carbsMin = 257;
                    $carbsMax = 333;
                }else if(50 <= $age && $age <= 64){
                    $carbsMin = 244;
                    $carbsMax = 316;
                }else if(65 <= $age && $age <= 74){
                    $carbsMin = 232;
                    $carbsMax = 300;
                }else{
                    $carbsMin = 207;
                    $carbsMax = 268;
                }
            }else{
                if(1 <= $age && $age <= 5){
                    $carbsMin = 0;
                    $carbsMax = 0;
                }else if(6 <= $age && $age <= 7){
                    $carbsMin = 207;
                    $carbsMax = 268;
                }else if(8 <= $age && $age <= 9){
                    $carbsMin = 238;
                    $carbsMax = 308;
                }else if(10 <= $age && $age <= 11){
                    $carbsMin = 294;
                    $carbsMax = 381;
                }else if(12 <= $age && $age <= 14){
                    $carbsMin = 338;
                    $carbsMax = 438;
                }else if(15 <= $age && $age <= 17){
                    $carbsMin = 319;
                    $carbsMax = 414;
                }else if(18 <= $age && $age <= 29){
                    $carbsMin = 288;
                    $carbsMax = 373;
                }else if(30 <= $age && $age <= 49){
                    $carbsMin = 294;
                    $carbsMax = 381;
                }else if(50 <= $age && $age <= 64){
                    $carbsMin = 282;
                    $carbsMax = 365;
                }else if(65 <= $age && $age <= 74){
                    $carbsMin = 263;
                    $carbsMax = 341;
                }else{
                    $carbsMin = 0;
                    $carbsMax = 0;
                }
            }
        }
        $carbsMinMax = [$carbsMin, $carbsMax];
        return $carbsMinMax;
    }
}

