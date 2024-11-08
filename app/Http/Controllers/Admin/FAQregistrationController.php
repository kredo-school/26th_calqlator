<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQregistrationController extends Controller
{
    public function index(){

        return view('admin.faqregistration.index');
    }
}
