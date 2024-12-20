<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Condition;
use App\Models\Weight;
use Illuminate\Support\Facades\Auth;

class EverydayConditionController extends Controller
{
    private $condition;
    private $weight;

    public function __construct(Condition $condition, Weight $weight)
    {
        $this->condition = $condition;
        $this->weight = $weight;
    }

    function index($date){
        return view('daily_condition')->with('date', $date);
    }

    private function isValidDate($date){
        try {
            Carbon::parse($date);
            return true; 
        } catch (\Exception $e) {
            return false; 
        }
    }

    function store(Request $request, $date){
        if ($this->isValidDate($date)) {
            $date = Carbon::parse($date)->format('Y-m-d');
        } else {
            $date = now()->format('Y-m-d');
        }

        $todays_condition = $this->condition->where('user_id', Auth::user()->id)->where('date', $date)->first();
        if($todays_condition){
            $todays_condition->user_id = Auth::user()->id;
            $todays_condition->date = $date;
            if($request->smile == null){
                $todays_condition->condition = $todays_condition->condition;
            }else{
                $todays_condition->condition = $request->smile;
            }
            if($request->icon == null){
                $todays_condition->icon = $todays_condition->icon;
            }else{
                $todays_condition->icon = $request->icon;
            }
            if($request->comment == null){
                $todays_condition->comment = $todays_condition->comment;
            }else{
                $todays_condition->comment = $request->comment;
            }
            $todays_condition->save();
        }else{
            $this->condition->user_id = Auth::user()->id;
            $this->condition->date = $date;
            $this->condition->condition = $request->smile;
            $this->condition->icon = $request->icon;
            $this->condition->comment = $request->comment;
            $this->condition->save();
        }

        $todays_weight = $this->weight->where('user_id', Auth::user()->id)->where('date', $date)->first();
        if ($todays_weight) {
            $todays_weight->user_id = Auth::user()->id;
            $todays_weight->date = $date;
            if($request-> weight == null){
                $todays_weight->weight = $todays_weight->weight;
            }else{
                $todays_weight->weight = $request->weight;
            }
            $todays_weight->save();
        } else {
            $this->weight->user_id = Auth::user()->id;
            $this->weight->date = $date;
            $this->weight->weight = $request->weight;
            $this->weight->save();
        }
        
        return redirect()->route('user.home', ['date' => $date]);
    }

    
}

