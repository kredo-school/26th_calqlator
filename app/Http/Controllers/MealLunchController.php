<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealLunch;

class MealLunchController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d'); 
        $meals = MealLunch::where('date', $today)->get();
        return view('meals.index_lunch', compact('meals'));
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
        MealLunch::create([
            'item' => $request->item,
            'calories' => $request->calories,
            'amount' => $amount,
            'protein' => $request->protein,
            'carbohydrate' => $request->carbohydrate,
            'lipid' => $request->lipid,
            'date' => date('Y-m-d'), // 日付を追加
        ]);

        // リダイレクト
        return redirect()->route('meals.index_lunch')->with('success', 'Meal added successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $meals = MealLunch::where('item', 'LIKE', "%$query%")->get();
        return response()->json($meals);
    }

    public function history()
    {
        $meals = MealLunch::all();
        return response()->json($meals);
    }

    public function edit($id)
    {
        $meal = MealLunch::findOrFail($id);
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
        $meal = MealLunch::findOrFail($id);
        $meal->update($request->all());

        // 成功レスポンスを返す
        return response()->json(['success' => true]);
    }

    public function confirmationlunch()
    {
        $today = date('Y-m-d');
        $meals = MealLunch::where('date', $today)->get();
        $totalCalories = $meals->sum('calories');
        return view('meals.confirmation_lunch', compact('meals', 'totalCalories'));
    }
}