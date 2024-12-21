<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\Weight;
use Carbon\Carbon;

class UserController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;
    private $weight;

    public function __construct(User $user, Weight $weight)
    {
        $this->middleware('auth'); 
        $this->weight = $weight;
    }

    public function show($id)
    {
      if (Auth::user()->id != $id){
          // $id does not match the current user
          return redirect('/home');
      }
      $user_a = User::findOrFail($id);
      return view('user.show')->with('user', $user_a);
}

    public function profile(){
        $user_a = UserInformation::find(Auth::user()->id);
        $user = User::findOrFail(Auth::user()->id); 
        $latest_weight = $this->weight->where('user_id', Auth::user()->id)->orderBy('date', 'DESC')->first();
        $oldest_weight = $this->weight->where('user_id', Auth::user()->id)->orderBy('date', 'ASC')->first();
        $weight_difference = ($latest_weight && $oldest_weight) ? $latest_weight->weight - $oldest_weight->weight : 0;
        $bmi = ($latest_weight && $user_a && isset($user_a->height)) ? $this->calculateBMI($latest_weight->weight, $user_a->height) : 0;
        if($bmi === 0){
            $bmi_judgement = 'No data';
        }else{
            $bmi_judgement = $this->getJudgementBMI($bmi);
        }
        // birthday
        $birthday = $user_a ? $user_a->birthday ?? 'No data' : 'No data';
        
        // Age
        if ($birthday && $birthday != 'No data') {
            $years = Carbon::parse($birthday)->age;
        } else {
            $years = 'No data'; 
        }
                
        return view('user.profile')->with('user', $user_a)->with('age', $years)->with('latest_weight', $latest_weight)->with('weight_difference', $weight_difference)->with('bmi', $bmi)->with('bmi_judgement', $bmi_judgement)->with('oldest_weight', $oldest_weight);
    }
    private function calculateBMI(float $weight, float $height): float{
        if ($height <= 0) {
        throw new \InvalidArgumentException("Height must be greater than zero.");
        }
        $heightInMeters = $height / 100;
        return round($weight / ($heightInMeters ** 2), 2);
    }

    private function getJudgementBMI($bmi): string{
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
        $user_birthday = "";
        $user_gender = "";
        $user_height = "";
        if(count($user_information) != 0){
            $user_birthday = $user_information->first()->birthday;
            $user_gender = $user_information->first()->gender;
            $user_height = $user_information->first()->height;
        }
        

        $weights = Weight::where('user_id', Auth::user()->id)->where('date', Carbon::today())->get();
        $current_weight = "";
        if(count($weights) != 0){
            $current_weight = $weights->first()->weight;
        }

        return view('user.edit', compact('user', 'current_weight', 'user_birthday', 'user_gender', 'user_height'));
    }

    public function update(Request $request){
        // dd($request->file('avatar'));
        $request->validate([
            'avatar' => 'max:1048|mimes:jpg,jpeg,png,gif',
            'username' => 'required|max:50',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'birthday' => 'required|date',
            'gender' => 'required',
            'height' => 'required',
            'weight' => 'required',
            //CREATING/ADDING  unique:<table>,<column>       ex: unique:users,email
            //UPDATING         unique:<table>,<column>,<id>  ex:unique:users,email,1
        ]);
        $user_a = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $file_name = Auth::user()->id . "." .$extension;
            $path = $request->file('avatar')->storeAs('avatar', $file_name, 'public');
            // $request->file('avatar')->storeAs('public',$file_name);
            $user_a->avatar = $file_name;
        }

        $user_a->username = $request->username;
        $user_a->first_name = $request->first_name;
        $user_a->last_name = $request->last_name;
        $user_a->updated_at = Carbon::now();
        $user_a->save();


        $user_information = UserInformation::where('user_id', Auth::user()->id)->get();

        if(count($user_information) == 0){
            $user_information = new UserInformation();

            $user_information->user_id = Auth::user()->id;
            $user_information->birthday = $request->birthday;
            $user_information->gender = $request->gender;
            $user_information->height = $request->height;
            $user_information->created_at = Carbon::now();
            $user_information->updated_at = Carbon::now();
            $user_information->save();
        }else{
            $user_information = $user_information->first();
            $user_information->birthday = $request->birthday;
            $user_information->gender = $request->gender;
            $user_information->height = $request->height;
            $user_information->updated_at = Carbon::now();
            $user_information->save();
        }
        

        $weights = Weight::where('user_id', Auth::user()->id)->where('date', Carbon::today())->get();

        if(count($weights) == 0){
            $weight = new Weight();
            $weight->user_id = Auth::user()->id;
            $weight->date = Carbon::today();
            $weight->weight = $request->weight;
            $weight->created_at = Carbon::now();
            $weight->updated_at = Carbon::now();
            $weight->save();
        }else{
            $weight = $weights->first();
            $weight->weight = $request->weight;
            $weight->updated_at = Carbon::now();
            $weight->save();
        }

        //go to edit page
        return redirect()->route('user.edit');
    }

    private function deleteAvatarFile($file_name){
        $file_path = self::LOCAL_STORAGE_FOLDER . $file_name;

        if(Storage::disk('local')->exists($file_path))
            Storage::disk('local')->delete($file_path);
    }

    private function saveAvatarFile($request){
        $new_file_name = time() . "." . $request->avatar->extension();
        //17890790.jpg

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $new_file_name);

        return $new_file_name;
    }
}