<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Foundation\Auth\ChangePasswords;
use App\Http\Requests\ChangePassword;


class ChangePasswordController extends Controller
{ 
    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('auth');
   }

   protected function validator(array $data)
  {
      return Validator::make($data, [
          'new_password' => 'required|string|min:8|confirmed',
      ]);
  }
 
   public function edit()
   {
     return view('auth.passwords.edit')
             ->with('user', Auth::user());
   }
  
   public function update(Request $request)
   {
      $user = Auth::user();

      if (!Hash::check($request->current_password, Auth::user()->password)) {
      return back()->withInput()->with(['error'=>'Incorrect current password.','has_error'=> true]);
      }
      // Confirm current password
    //   if (!password_verify($request->current_password, $user->password)) {
    //     return redirect(
    //             ->back()->with('warning', 'Incorrect current password.');
    //   }

      // Validation（check the new password must be at least 8 characters long and it matches the confirmed password etc.）
      $this->validator($request->all())->validate();

      // save the new password
      $user->password = bcrypt($request->new_password);
      $user->save();

      return redirect('/user/edit')
              ->with('status', 'Your password has been changed.');
    }
  }
