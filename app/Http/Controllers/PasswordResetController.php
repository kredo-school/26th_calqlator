<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PasswordResetController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function findResetUser(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;
        $user = $this->user->where('email', $email)->first();

        if($user){
            return view('auth.passwords.reset')->with('id', $user->id);
        }else {
        return redirect()->back()->withErrors(['email' => 'No user found with this email address.']);
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = $this->user->where('id', $id)->first();

        $password = $request->password;
        $confirm_password = $request->password_confirmation;

        if($password === $confirm_password)
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password reset successfully.');
    }
}
