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

        $weight = $this->weight->where('user_id', Auth::user()->id)->where('date', $today)->first();

        $goalCalories = ceil($this->getGoalCalories($date));
        $remainingCalories = $goalCalories - $totalCalories;

        $workoutGoal = $this->getWorkoutGoal($date);

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
                                     ->with('workoutGoal', $workoutGoal);
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
        $today = $date;

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

    public function getWorkoutCalories($date){
        $today =  $date;

        $workouts = $this->workout->where('user_id', Auth::user()->id)->where('date', $today)->get();

        $workoutCalories = 0;
        foreach($workouts as $workout){
            $workoutCalories += $workout->time/10 * $workout->exercise->calories;
        }

        return $workoutCalories;
    }

    public function caloriesChart($date){
        $totalCalories = $this->getTotalCalories($date);
        $goalCalories = $this->getGoalCalories($date);

        $chartData = [ 
            'totalCalories' => $totalCalories,
            'goalCalories' => $goalCalories
        ];

        return response()->json($chartData);
    }

    public function workoutChart($date){
        $workoutCalories = $this->getWorkoutCalories($date);
        $workoutGoal = $this->getWorkoutGoal($date);

        $workoutData = [
            'workoutCalories' => $workoutCalories,
            'workoutGoal' => $workoutGoal
        ];

        return response()->json($workoutData);
    }

    public function proteinChart($date){
        $today =  $date;

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

    public function fatChart($date){
        $today =  $date;

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

    public function carbsChart($date){
        $today =  $date;

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

    public function getAge(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $birthday = Carbon::parse($userInfo->birthday);
        $today = Carbon::now();

        $age = Carbon::parse($birthday)->age;
        return $age;
    }

    public function getBMR(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $userWeightInfo = $this->weight->where('user_id', $id)->latest()->first();
        
        $weight = $userWeightInfo->weight;
        $gender = $userInfo->gender;
        $age = $this->getAge();

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

            return $BMR;
        }

    }

    public function getPAL(){
        $age = $this->getAge();

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

        return $PAL;
    }

    public function getCaloriesDifference($date){
        $id = Auth::user()->id;
        $date = Carbon::parse($date)->format('Y-m-d');
        $userInfo = $this->information->where('user_id', $id)->first();
        $weight = $this -> weight -> where('user_id', $id)->where('date', $date)->first();

        $todaysWeight = $weight->weight;
        $goalWeight = $userInfo->goal_weight;
        $goalDate = $userInfo->goal_date;    

        $daysDifference = Carbon::parse($date)->diffInDays(Carbon::parse($goalDate));
        if($userInfo->goal === 1){
            $weightDifference = $todaysWeight - $goalWeight;
        }else if($userInfo->goal === 3){
            $weightDifference = $goalWeight - $todaysWeight;
        }
       
        $everydayDifference = ($weightDifference * 7200) / $daysDifference;

        return $everydayDifference;
    }

    public function getGoalCalories($date){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $BMR = $this->getBMR();
        $PAL = $this->getPAL();
        $everydayDifference = $this->getCaloriesDifference($date);

        $neededCalories = ceil($BMR * $PAL);

        if($userInfo->goal === 1){
            // if($userInfo->how === 1){
                if($neededCalories - $everydayDifference > $this->getBMR()){
                    $goalCalories = $neededCalories - $everydayDifference;
                }else{
                    $goalCalories = $this->getBMR();
                }
            // }else if ($userInfo->how === 2){
            //     if($neededCalories - $everydayDifference / 2 > $this->getBMR()){
            //         $goalCalories = $neededCalories - $everydayDifference / 2;
            //     }else{
            //         $goalCalories = $this->getBMR();
            //     }
            // }else{
            //     $goalCalories = $neededCalories;
            // }
        }else if($userInfo->goal === 2){
            $goalCalories = $neededCalories;
        }else{
            $goalCalories = $neededCalories + $everydayDifference;
        }

        return $goalCalories;
    }

    public function getWorkoutGoal($date){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $BMR = $this->getBMR();
        $PAL = $this->getPAL();
        $everydayDifference = $this->getCaloriesDifference($date);

        $neededCalories = ceil($BMR * $PAL);
        
        if($userInfo->goal === 1){
            if($neededCalories - $everydayDifference > $this->getBMR()){
                $workoutGoal = 0;
            }else{
                $workoutGoal = $BMR - $neededCalories + $everydayDifference;
            }
        }else{
            $workoutGoal = 0;
        }

        return $workoutGoal;
    }
}

