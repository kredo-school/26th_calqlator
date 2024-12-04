<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }


    public function profile(){
        $user_a = $this->user->findOrFail(Auth::user()->id);
        $now = date('Ymd');
        // Date of Birth
        $birthday = $user_a->date_of_birth;
        // $birthday = str_replace("-", "", $birthday);
        
        // Age
        // $age = floor(($now - $birthday) / 10000);
        $age = Carbon::parse($birthday)->age;
                
        return view('user.profile')->with('user', $user_a)->with('age', $age);
    }

    public function show($id){
        $user_a = $this->user->findOrFail($id);

        return view('user.show')->with('user', $user_a);
    }

    public function edit(){
        $user_a = $this->user->findOrFail(Auth::user()->id);
        return view('user.edit')->with('user', $user_a);
    }

    public function update(Request $request){
        $request->validate([
            'avatar' => 'max:1048|mimes:jpg,jpeg,png,gif',
            'username' => 'required|max:50',
            'first name' => 'required|max:50',
            'last name' => 'required|max:50',
            'date of birth' => 'required|date',
            'gender' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'email' => 'required|max:50|email|unique:users,email,'.Auth::user()->id,
            'password' => 'required|string|min:10|confirmed',
            //CREATING/ADDING  unique:<table>,<column>       ex: unique:users,email
            //UPDATING         unique:<table>,<column>,<id>  ex:unique:users,email,1
        ]);

        $user_a = $this->user->findOrFail(Auth::user()->id);

        $user_a->name = $request->name;
        $user_a->email = $request->email;
        if($request->avatar){
            //if user already has an avatar
            if($user_a->avatar){
                // delete current avatar file
                $this->deleteAvatarFile($user_a->avatar);
            }
            //save new avatar
            $user_a->avatar = $this->saveAvatarFile($request);
        }
        $user_a->save();

        //go to profile page
        return redirect()->route('user.profile');
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

    public function changePassword(Request $request){
    }

    public function changeEmail(Request $request){
    }

    public function bmi(Request $request){
        $height = $_GET['height'];
        $weight = $_GET['weight'];

        // if no errors, calculate BMI
        if (count($err_msg) === 0) {

        // BMI Formula
        $bmi = calc_bmi($height, $weight);
        }
    }
        
        // Round to 1 decimal place
        function calc_bmi($height, $weight){
        return round($weight / ($height/100 * $height/100), 1);

        // BMI Judgement
        if($bmi <19.8){
            return "Underweight";
        }elseif($bmi <24.2){
            return "Normal";
        }elseif($bmi <26.4){
            return "Overweight";
        }else{
            return "Obese";
        }
    }

    public function goal(){
        return view('user.goal');
    }
}