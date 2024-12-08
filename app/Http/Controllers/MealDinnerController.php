<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealDinner;

class MealDinnerController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d'); 
        $meals = MealDinner::where('date', $today)->get();
        return view('meals.index_dinner', compact('meals'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'item' => 'required|string',
            'calories' => 'required|integer',
            'amount_value' => 'required|integer',
            'amount_unit' => 'required|string',
            'protein' => 'nullable|integer',
            'carbohydrate' => 'nullable|integer',
            'lipid' => 'nullable|integer',
        ]);

        // amountフィールドの結合
        $amount = $request->amount_value . ' ' . $request->amount_unit;

        // データの保存
        MealDinner::create([
            'item' => $request->item,
            'calories' => $request->calories,
            'amount' => $amount,
            'protein' => $request->protein,
            'carbohydrate' => $request->carbohydrate,
            'lipid' => $request->lipid,
            'date' => date('Y-m-d'), // 日付を追加
        ]);

        // リダイレクト
        return redirect()->route('meals.index_dinner')->with('success', 'Meal added successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $meals = MealDinner::where('item', 'LIKE', "%$query%")->get();
        return view('meals.index_dinner', compact('meals'));
    }

    public function history()
    {
        $meals = MealDinner::all();
        return response()->json($meals);
    }


    public function edit($id)
    {
        $meal = MealDinner::findOrFail($id);
        return view('meals.edit', compact('meal'));
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'item' => 'required|string',
            'calories' => 'required|integer',
            'amount' => 'required|string',
            'protein' => 'nullable|integer',
            'carbohydrate' => 'nullable|integer',
            'lipid' => 'nullable|integer',
        ]);

        // データの更新
        $meal = MealDinner::findOrFail($id);
        $meal->update($request->all());

        // リダイレクト
        return redirect()->route('meals.index_dinner')->with('success', 'Meal updated successfully.');
    }
}
