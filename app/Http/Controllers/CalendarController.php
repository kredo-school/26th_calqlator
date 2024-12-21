<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner; 
use App\Models\UserSnack;
use App\Models\UserSupplement;
use App\Models\Condition;
use App\Models\Weight;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $weight;
    private $breakfast;
    private $lunch;
    private $dinner;
    private $snack;
    private $supplement;
    private $condition;
    protected $UserHomePageController;


    public function __construct(Weight $weight, UserFoodBreakfast $breakfast, UserFoodLunch $lunch, UserFoodDinner $dinner,  UserSnack $snack, UserSupplement $supplement, Condition $condition, UserHomePageController $UserHomePageController){
        $this -> breakfast = $breakfast;
        $this -> lunch = $lunch;
        $this -> dinner = $dinner;
        $this -> snack = $snack;
        $this -> supplement = $supplement;
        $this -> weight = $weight;
        $this -> condition = $condition;
        $this -> UserHomePageController = $UserHomePageController;
    }

    public function getStar(){
        $currentMonth = now()->format('m');
        $currentYear = now()->format('Y');
        
        $firstDay = Carbon::createFromFormat('Y-m-d', "{$currentYear}-{$currentMonth}-01");
        $lastDay = $firstDay->copy()->endOfMonth();
    
        $star = 0;
    
        for ($date = $firstDay; $date <= $lastDay; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            
            $totalCalories = $this->getTotalCalories($formattedDate);
            $goalcalories = $this -> UserHomePageController -> getGoalCalories($formattedDate);
            
            if ($totalCalories > $goalcalories-300 && $totalCalories < $goalcalories+300) {
                $star += 1;
            }
        }
    
        return $star;
    }
    
    public function index(){
        $smile1 = count($this -> condition -> where('user_id', Auth::user()->id)->where('condition', 1)->get());
        $smile2 = count($this -> condition -> where('user_id', Auth::user()->id)->where('condition', 2)->get());
        $smile3 = count($this -> condition -> where('user_id', Auth::user()->id)->where('condition', 3)->get());
        $smile4 = count($this -> condition -> where('user_id', Auth::user()->id)->where('condition', 4)->get());
        $smile5 = count($this -> condition -> where('user_id', Auth::user()->id)->where('condition', 5)->get());

        $star = $this -> getStar();

        return view('users.calendar')->with('smile1', $smile1)
                                     ->with('smile2', $smile2)
                                     ->with('smile3', $smile3)
                                     ->with('smile4', $smile4)
                                     ->with('smile5', $smile5)
                                     ->with('star', $star);
    }


    public function getTotalCalories($date){
        $id = Auth::user()->id;

        $breakfasts = $this->breakfast->where('user_id', $id)->where('date', $date)->get();
        $lunches = $this->lunch->where('user_id', $id)->where('date', $date)->get();
        $dinners = $this->dinner->where('user_id',$id)->where('date', $date)->get();
        $snacks = $this->snack->where('user_id', $id)->where('date', $date)->get();
        $supplements = $this->supplement->where('user_id', $id)->where('date', $date)->get();

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

        $totalCalories = $breakfastCalories + $lunchCalories + $dinnerCalories + $snackCalories + $supplementCalories;

        return $totalCalories;
    }

    public function everydayInfo(Request $request, $date){
        $weight = $this->weight->where('date','=', $date)->where('user_id', Auth::user()->id)->get();

        $totalCalories = $this ->getTotalCalories($date);

        $condition = $this -> condition -> where('user_id', Auth::user()->id)->where('date', $date)->first();

        return response()->json(['weight'=> $weight->first(),'totalCalories' => $totalCalories, 'condition' => $condition]);
    }
}