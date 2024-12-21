<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Carbon\Carbon;

class MealSnackController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d'); 
        $meals = Meal::where('date', $today)->get();
        return view('meals.index_snack', compact('meals'));
    }

    public function storeSnack(Request $request)
{
    // バリデーション
    //dd($meals);
    $request->validate([
        'item' => 'required|array',
        'calories' => 'required|array',
        'amount' => 'required|array',
        'protein' => 'nullable|array',
        'carbohydrate' => 'nullable|array',
        'lipid' => 'nullable|array',
        'date' => 'required|array'
    ]);
    $ids = array();
    // データの保存
    for ($i = 0; $i < count($request->item); $i++) {
        $date = $request->date[$i] ?? Carbon::today()->toDateString();
        $timeEaten = Carbon::createFromFormat('Y-m-d H:i', $date. ' ' . $request->time_eaten[$i]);
        $meal = Meal::create([
            'item' => $request->item[$i],
            'amount' => $request->amount[$i],
            'calories' => $request->calories[$i],
            'protein' => $request->protein[$i],
            'carbohydrate' => $request->carbohydrate[$i],
            'lipid' => $request->lipid[$i],
            'date' => $date, // 今日の日付をセット
            'time_eaten' => $timeEaten,
        ]);
        $ids[] = $meal->id;
    }

    // 総カロリー計算
    // $today = date('Y-m-d');
    // $meals = Meal::where('date', $today)->get();
    // $totalCalories = $meals->sum('calories');

    // JSONレスポンスを返す（リダイレクトURL含む）
    // return response()->json([
    //     'success' => true,
    //     'redirect_url' => route('meals.confirmation_', ['ids' => implode(',', $ids)]),
    // ]);
    return redirect()->route('meals.confirmation_snack', ['ids' => implode(',', $ids)]);
}


    public function search(Request $request)
    {
        $query = $request->input('query');
        $meals = Meal::where('item', 'LIKE', "%$query%")->get();
        return response()->json($meals);
    }

    public function history()
    {
        $meals = Meal::all();
        return response()->json($meals);
    }

    public function edit($id)
    {
        $meal = Meal::findOrFail($id);
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
        $meal = Meal::findOrFail($id);
        $meal->update($request->all());

        // 成功レスポンスを返す
        return response()->json(['success' => true]);
    }

    public function confirmationSnack(Request $request)
    {   $ids = explode(',', $request->query('ids'));
        $today = date('Y-m-d');
        //$meals = Meal::where('date', $today)->get();
        $meals = Meal::whereIn('id', $ids)->get();
        $totalCalories = $meals->sum('calories');
        return view('meals.confirmation_snack', compact('meals', 'totalCalories'));
    }
}