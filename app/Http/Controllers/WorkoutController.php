<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    // Workout一覧を表示するメソッド
    public function index()
    {
        $workouts = Workout::all();
        return view('workouts.index', compact('workouts'));
    }

    // Workoutを保存するメソッド
    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'calories' => 'required|numeric',
        ]);

        Workout::create([
            'item' => $request->item,
            'calories' => $request->calories,
        ]);

        return redirect()->route('workouts.index')->with('success', 'Workout added successfully.');
    }

    // Workoutを検索するメソッド
    public function search(Request $request)
    {
        $query = $request->input('query');
        $workouts = Workout::where('item', 'LIKE', "%{$query}%")->get();
        return view('workouts.search', compact('workouts'));
    }
}

