<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $date = now()->format('m / j / Y');
        return view('users.homepage')->with('date', $date);
    }
}
