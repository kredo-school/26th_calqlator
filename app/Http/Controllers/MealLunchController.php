<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealLunch;

class MealLunchController extends Controller
{
    public function index()
    {
        $meals = MealLunch::all();
        return view('meals.index_lunch', compact('meals'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'item' => 'required|string',
            'calories' => 'required|integer',
            'amount' => 'required|string',
            'time_eaten' => 'nullable|date',
            'protein' => 'nullable|integer',
            'carbohydrate' => 'nullable|integer',
            'lipid' => 'nullable|integer',
        ]);

        // データの保存
        MealLunch::create($request->all());

        // リダイレクト
        return redirect()->route('meals.index_lunch')->with('success', 'Meal added successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $meals = MealLunch::where('item', 'LIKE', "%$query%")->get();
        return view('meals.index_lunch', compact('meals'));
    }
}
