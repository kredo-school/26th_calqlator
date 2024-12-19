<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ConfirmsEmails;
use Illuminate\Foundation\Auth\ChangeEmails;
use App\Http\Requests\ChangeEmail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class ChangeEmailController extends Controller
{
    public function userEmailChange(Request $request)
    {
   
    $this->validate($request, User::$editEmailRules);
   
    $auth = Auth::user();
    
    $form = $request->input('email');
    
    return [$auth, $form];
    }
   
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        try {
        $request->validate([
            'current_email' => ['required', 'email'],
            'new_email' => ['required', 'email', 'different:current_email', 'unique:users,email', 'confirmed'],
        ]);

        if ($request->current_email !== $user->email) {
              throw ValidationException::
              withMessages([ 'current_email' => 'The current email is incorrect.', ]); 
        }

        $user->email = $request->new_email;
        $user->save();

        } catch (ValidationException $e) {
        return redirect('/user/edit')->with('status', implode(' ', Arr::flatten($e->errors())));
        }
        return redirect('/user/edit')
                ->with('status', 'Your email has been changed.');
    }
}
