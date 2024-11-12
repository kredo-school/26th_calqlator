<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserFoodBreakfast;
use App\Models\UserFoodLunch;
use App\Models\UserFoodDinner; 
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function index(){
        return view('users.calendar');
    }
}