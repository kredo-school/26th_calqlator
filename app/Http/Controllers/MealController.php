<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class MealController extends Controller
{
    public function index() {
        $meals = Meal::all();
        return view('meals.index', compact('meals'));
    }

    public function store(Request $request) {
        $meal = new Meal;
        $meal->item = $request->item;
        $meal->calories = $request->calories;
        $meal->amount = $request->amount;
        $meal->time_eaten = $request->time_eaten;
        $meal->save();
        return redirect('/meals');
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $results = Meal::where('item', 'LIKE', "%$query%")->get();
        return view('meals.search', compact('results'));
    }
}

