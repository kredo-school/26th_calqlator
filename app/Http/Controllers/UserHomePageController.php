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

    public function getReferenceWeight(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $age = $userInfo && $userInfo->birthday ? $this->getAge() : 20;
        $gender = $userInfo && $userInfo->gender ? $userInfo->gender : 'female';

        $referenceWeights = [
            'male' => [
                [1, 2, 11.5], [3, 5, 16.5], [6, 7, 22.2], [8, 9, 28], [10, 11, 35.6], [12, 14, 49], [15, 17, 59.7], [18, 29, 64.5], [30, 49, 68.1], [50, 64, 68], [65, 74, 65], [75, null, 59.6], 
            ],
            'female' => [
                [1, 2, 11], [3, 5, 16.1], [6, 7, 21.9], [8, 9, 27.4], [10, 11, 36.3], [12, 14, 47.5], [15, 17, 51.9], [18, 29, 50.3], [30, 49, 53], [50, 64, 53.8], [65, 74, 52.1], [75, null, 48.8],
            ],
        ];
        $referenceWeight = 0;
        foreach ($referenceWeights[$gender] as [$minAge, $maxAge, $weight]) {
            if ($age >= $minAge && ($maxAge === null || $age <= $maxAge)) {
                $referenceWeight = $weight;
                break;
            }
        }
        return $referenceWeight;
    }

    public function getAge(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $age = $userInfo && $userInfo->birthday ? Carbon::parse($userInfo->birthday)->age : 20;
        
        return $age;
    }

    public function getBMR(){
        $id = Auth::user()->id;
        $userInfo = $this->information->where('user_id', $id)->first();
        $age = $userInfo && $userInfo->birthday ? $this->getAge() : 20;
        $gender = $userInfo && $userInfo->gender ? $userInfo->gender : 'female';

        $userWeightInfo = $this->weight->where('user_id', $id)->orderBy('date','desc')->first();
        $weight = $userWeightInfo ? $userWeightInfo->weight : $this->getReferenceWeight();

        $BMRnumber=[
            'male' => [
                [1, 2, 61], [3, 5, 54.8], [6, 7, 44.3], [8, 9, 40.8], [10, 11, 37.4], [12, 14, 31], [15, 17, 27], [18, 29, 23.7], [30, 49, 22.5], [50, 64, 21.8], [65, 74, 21.6], [75, null, 21.5],
                ],
            'female' => [
                [1, 2, 59.7], [3, 5, 52.2], [6, 7, 41.9], [8, 9, 38.3], [10, 11, 34.8], [12, 14, 29.6], [15, 17, 25.3], [18, 29, 22.1], [30, 49, 21.9], [50, 64, 20.7], [65, null, 20.7],
            ],
        ];
        $BMR = 0;
        foreach ($BMRnumber[$gender] as [$minAge, $maxAge, $number]) {
            if ($age >= $minAge && ($maxAge === null || $age <= $maxAge)) {
                $BMR = $number * $weight;
                break;
            }
        }
        return $BMR;
    }

    public function getPAL(){
        $id = Auth::user()->id;     
        $userInfo= $this -> information -> where('user_id', $id) -> first();
        $age = $userInfo && $userInfo->birthday ? $this->getAge() : 20;
        $activityLevel = $userInfo && $userInfo->activity_level ? $userInfo->activity_level : 2;
        
        $palValues =[
            '1' => [
                [1,5,1],[6, 7, 1.35], [8, 9, 1.4], [10, 11, 1.45], [12, 14, 1.5], [15, 17, 1.55], [18, 64, 1.5], [65, 74, 1.45], [75, null, 1.4],  
            ],
            '2' => [
                [1, 2, 1.35], [3, 5, 1.45], [6, 7, 1.55], [8, 9, 1.6], [10, 11, 1.65], [12, 14, 1.7], [15, 64, 1.75], [65, 74, 1.7], [75, null, 1.65],
            ],
            '3' => [
                [1,5,1],[6, 7, 1.75], [8, 9, 1.8], [10, 11, 1.85], [12, 14, 1.9], [15, 17, 1.95], [18, 64, 2], [65, 74, 1.95], [75, null, 1], 
            ],
        ];

        $PAL = 1.725;
        foreach ($palValues[$activityLevel] as [$minAge, $maxAge, $pal]) {
            if ($age >= $minAge && ($maxAge === null || $age <= $maxAge)) {
                $PAL = $pal;
                break;
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
        $goal = $userInfo && $userInfo->goal ? $userInfo->goal : 2;
        $goalWeight = $userInfo && $userInfo->goal_weight ? $userInfo->goal_weight : $todaysWeight;
        $goalDate = $userInfo && $userInfo->goal_date ? $userInfo->goal_date : $date;

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
        $goal = $userInfo && $userInfo->goal ? $userInfo->goal : 2;
        $how = $userInfo && $userInfo->how_to_lose ? $userInfo->how_to_lose : 2;

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
        $goal = $userInfo && $userInfo->goal ? $userInfo->goal : 2;
        $how = $userInfo && $userInfo->how_to_lose ? $userInfo->how_to_lose : 2;
        
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
        $gender = $userInfo->gender ?? 'female';
        $age = $userInfo ? $this->getAge() : 20;
        $activityLevel = $userInfo->activity_level ?? 2;

        $proteinCases = [
            'male' => [
                '1' => [
                    [1,2,[20,20]], [3,5,[25,25]], [6,7,[44,68]], [8,9,[52,80]], [10,11,[63,98]], [12,14,[75,115]], [15,17,[81,125]], [18,49,[75,115]], [50,64,[77,110]], [65,74,[77,103]], [75,null,[68,90]]
                ],
                '2' => [
                    [1,2,[31,48]], [3,5,[42,65]], [6,7,[49,75]], [8,9,[60,93]], [10,11,[72,110]], [12,14,[85,130]], [15,17,[91,140]], [18,29,[86,133]], [30,49,[88,135]], [50,64,[91,130]], [65,74,[90,120]], [75,null,[79,105]]
                ],
                '3' => [
                    [1,2,[20,20]], [3,5,[25,25]], [6,7,[55,85]], [8,9,[67,103]], [10,11,[80,123]], [12,14,[94,145]], [15,17,[102,158]], [18,49,[99,153]], [50,64,[103,148]], [65,74,[103,138]], [75,null,[60,60]]
                ]
            ],
            'female' => [
                '1' => [
                    [1,2,[20,20]], [3,5,[25,25]], [6,7,[41,63]], [8,9,[47,73]], [10,11,[60,93]], [12,14,[68,105]], [15,17,[67,103]], [18,49,[57,88]], [50,64,[58,83]], [65,74,[58,78]], [75,null,[53,70]]
                ],
                '2' => [
                    [1,2,[29,45]], [3,5,[39,60]], [6,7,[46,70]], [8,9,[55,85]], [10,11,[68,105]], [12,14,[78,120]], [15,17,[75,115]], [18,29,[65,100]], [30,49,[67,103]], [50,64,[68,98]], [65,74,[69,93]], [75,null,[62,83]]
                ],
                '3' => [
                    [1,2,[20,20]], [3,5,[25,25]], [6,7,[52,80]], [8,9,[62,95]], [10,11,[76,118]], [12,14,[86,133]], [15,17,[83,128]], [18,29,[75,115]], [30,49,[76,118]], [50,64,[79,113]], [65,74,[79,105]], [75,null,[50,50]]
                ]
            ]
        ];
        $proteinMin = 0;
        $proteinMax = 0;
        foreach($proteinCases[$gender][$activityLevel] as $case){
            if (($case[1] === null && $age >= $case[0]) || ($age >= $case[0] && $age <= $case[1])) {
                list($proteinMin, $proteinMax) = $case[2];
                break;
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
        $gender = $userInfo->gender ?? 'female';
        $age = $userInfo ? $this->getAge() : 20;
        $activityLevel = $userInfo->activity_level ?? 2;

        $fatCases = [
            'male' => [
                '1' => [
                    [1,5,[0,0]], [6,7,[30,45]], [8,9,[36,53]], [10,11,[44,65]], [12,14,[52,76]], [15,17,[56,83]], [18,49,[52,76]], [50,64,[49,73]], [65,74,[46,68]], [75,null,[40,60]]
                ],
                '2' => [
                    [1,2,[22,31]], [3,5,[29,43]], [6,7,[35,51]], [8,9,[42,61]], [10,11,[50,75]], [12,14,[58,86]], [15,17,[63,93]], [18,29,[59,88]], [30,49,[60,90]], [50,64,[58,86]], [65,74,[54,80]], [75,null,[47,70]]
                ],
                '3' => [
                    [1,5,[0,0]], [6,7,[39,58]], [8,9,[47,70]], [10,11,[56,83]], [12,14,[65,96]], [15,17,[70,105]], [18,49,[68,101]], [50,64,[66,98]], [65,74,[62,91]], [75,null,[0,0]]
                ]
            ],
            'female' => [
                '1' => [
                    [1,5,[0,0]], [6,7,[28,41]], [8,9,[34,50]], [10,11,[42,61]], [12,14,[48,71]], [15,17,[46,68]], [18,29,[38,56]], [30,49,[39,58]], [50,64,[37,55]], [65,74,[35,51]], [75,null,[32,46]]
                ],
                '2' => [
                    [1,2,[20,30]], [3,5,[28,41]], [6,7,[33,48]], [8,9,[38,56]], [10,11,[47,70]], [12,14,[54,80]], [15,17,[52,76]], [18,29,[45,66]], [30,49,[46,68]], [50,64,[44,65]], [65,74,[42,61]], [75,null,[37,55]]
                ],
                '3' => [
                    [1,5,[0,0]], [6,7,[37,55]], [8,9,[43,63]], [10,11,[53,78]], [12,14,[60,90]], [15,17,[57,85]], [18,29,[52,76]], [30,49,[53,78]], [50,64,[50,75]], [65,74,[47,70]], [75,null,[0,0]]
                ]
            ]
        ];
        $fatMin = 0;
        $fatMax = 0;
        foreach($fatCases[$gender][$activityLevel] as $case){
            if (($case[1] === null && $age >= $case[0]) || ($age >= $case[0] && $age <= $case[1])) {
                list($fatMin, $fatMax) = $case[2];
                break;
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
        $gender = $userInfo->gender ?? 'female';
        $age = $userInfo ? $this->getAge() : 20;
        $activityLevel = $userInfo->activity_level ?? 2;

        $carbsCases = [
            'male' => [
                '1' => [
                    [1,5,[0,0]], [6,7,[169,219]], [8,9,[200,260]], [10,11,[244,316]], [12,14,[288,373]], [15,17,[313,406]], [18,49,[288,373]], [50,64,[275,357]], [65,74,[257,333]], [75,null,[225,292]]
                ],
                '2' => [
                    [1,2,[119,154]], [3,5,[163,211]], [6,7,[194,251]], [8,9,[232,300]], [10,11,[282,365]], [12,14,[325,422]], [15,17,[350,455]], [18,29,[332,430]], [30,49,[338,438]], [50,64,[325,422]], [65,74,[300,390]], [75,null,[263,34]]
                ],
                '3' => [
                    [1,5,[0,0]], [6,7,[219,284]], [8,9,[263,341]], [10,11,[313,406]], [12,14,[363,471]], [15,17,[394,511]], [18,49,[382,495]], [50,64,[369,479]], [65,74,[344,446]], [75,null,[0,0]]
                ]
            ],
            'female' => [
                '1' => [
                    [1,5,[0,0]], [6,7,[157,203]], [8,9,[188,243]], [10,11,[232,300]], [12,14,[269,349]], [15,17,[257,333]], [18,29,[213,276]], [30,49,[219,284]], [50,64,[207,268]], [65,74,[194,251]], [75,null,[176,227]]
                ],
                '2' => [
                    [1,2,[113,146]], [3,5,[157,203]], [6,7,[182,235]], [8,9,[213,276]], [10,11,[263,341]], [12,14,[300,390]], [15,17,[288,373]], [18,29,[250,325]], [30,49,[257,333]], [50,64,[244,316]], [65,74,[232,300]], [75,null,[207,268]]
                ],
                '3' => [
                    [1,5,[0,0]], [6,7,[207,268]], [8,9,[238,308]], [10,11,[294,381]], [12,14,[338,438]], [15,17,[319,414]], [18,29,[288,373]], [30,49,[294,381]], [50,64,[282,365]], [65,74,[263,341]], [75,null,[0,0]]
                ]
            ]
        ];
        $carbsMin = 0;
        $carbsMax = 0;
        foreach($carbsCases[$gender][$activityLevel] as $case){
            if (($case[1] === null && $age >= $case[0]) || ($age >= $case[0] && $age <= $case[1])) {
                list($carbsMin, $carbsMax) = $case[2];
                break;
            }
        }
        $carbsMinMax = [$carbsMin, $carbsMax];
        return $carbsMinMax;
    }
}