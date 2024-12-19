<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\Weight;
use Carbon\Carbon;

class GoalController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    public function __construct(User $user)
    {
        $this->middleware('auth'); 
    }

    public function show($id)
    {
      if (Auth::user()->id != $id){
          // $id does not match the current user
          return redirect('/home');
      }
      $user_information = UserInformation::where('user_id', Auth::id())->get();
      return view('user.show')->with('user', $user_information);
    }
    
    public function goal(){
        $user_information = UserInformation::findOrFail(Auth::user()->id);
        $user = User::findOrFail(Auth::user()->id);
        $weights = Weight::where('user_id', Auth::user()->id)->where('date', Carbon::today())->get();
        $latest_weight = "";
        if(count($weights) != 0){
            $latest_weight = $weights->first()->weight;
        }

        $bmi = $this->calculateBMI($latest_weight, $user_information->height);
        $bmi_judgement = $this->getJudgementBMI($bmi);
        $goal_bmi = $this->calculateBMI($user_information->goal_weight, $user_information->height);
        $goal_bmi_judgement = $this->getJudgementBMI($goal_bmi);
                
        return view('user.goal')
            ->with('user', $user)
            ->with('user_information', $user_information)
            ->with('latest_weight', $latest_weight)
            ->with('bmi', $bmi)
            ->with('bmi_judgement', $bmi_judgement)
            ->with('goal_bmi', $goal_bmi)
            ->with('goal_bmi_judgement', $goal_bmi_judgement);
    }

    private function calculateBMI($weight, $height){
        if ($this->isNullOrEmpty($weight) || $this->isNullOrEmpty($height)) {
            return "-";
        }

        $heightInMeters = $height / 100;
        return round($weight / ($heightInMeters ** 2), 2);
    }

    private function getJudgementBMI($bmi): string{
        if ($this->isNullOrEmpty($bmi)) {
            return "-";
        }

        if ($bmi <19.8){
            return "Underweight";
        }elseif($bmi <24.2){
            return "Normal";
        }elseif($bmi <26.4){
            return "Overweight";
        }else{
            return "Obese";
        }
    }

    public function edit(){
        $user = User::findOrFail(Auth::user()->id);

        $user_information = UserInformation::where('user_id', Auth::user()->id)->get();
        $user_goal = "";
        $user_activity_level = "";
        $user_how_to_lose = "";
        $user_goal_weight = "";
        $user_goal_date = "";

        $weights = Weight::where('user_id', Auth::user()->id)->where('date', Carbon::today())->get();
        $latest_weight = "";
        if(count($weights) != 0){
            $latest_weight = $weights->first()->weight;
        }

        return view('user.goal', compact('user', 'user_goal', 'user_activity_level', 'user_how_to_lose', 'latest_weight','user_goal_weight', 'user_goal_date'));
    }

    public function update(Request $request){
        $request->validate([
            'goal' => 'required',
            'activity_level' => 'required',
            'how_to_lose' => 'required',
            'latest_weight' => 'required',
            'goal_weight' => 'required',
            'goal_date' => 'required|date',
        ]);

        $user_information = UserInformation::where('user_id', Auth::user()->id)->get();

        if(count($user_information) == 0){
            $user_information = new UserInformation();

            $user_information->user_id = Auth::user()->id;
            $user_information->goal = $request->goal;
            $user_information->activity_level = $request->activity_level;
            $user_information->how_to_lose = $request->how_to_lose;
            // $user_information->latest_weight = $request->latest_weight;
            $user_information->goal_weight = $request->goal_weight;
            $user_information->goal_date = $request->goal_date;
            $user_information->updated_at = Carbon::now();
            $user_information->save();
        }else{
            $user_information = $user_information->first();
            $user_information->goal = $request->goal;
            $user_information->activity_level = $request->activity_level;
            $user_information->how_to_lose = $request->how_to_lose;
            // $user_information->latest_weight = $request->latest_weight;
            $user_information->goal_weight = $request->goal_weight;
            $user_information->goal_date = $request->goal_date;
            $user_information->updated_at = Carbon::now();
            $user_information->save();
        }

        // $weights = Weight::where('user_id', Auth::user()->id)->where('date', Carbon::today())->get();
        $weight = new Weight();
        $weight->user_id = Auth::user()->id;
        $weight->date = Carbon::today();
        $weight->weight = $request->latest_weight;
        $weight->created_at = Carbon::now();
        $weight->updated_at = Carbon::now();
        $weight->save();
        // }else{
        //     $weight = $weights->first();
        //     $weight->weight = $request->weight;
        //     $weight->updated_at = Carbon::now();
        //     $weight->save();
        // }

        //go to edit page
        return redirect()->route('user.goal');
    }
    private function isNullOrEmpty($value){
        return $value==null || $value == '';
    }
}