<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;


class ExercisesController extends Controller
{
    private $exercise;

    public function __construct(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');

       $exercises = Exercise::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(10);

        return view('admin.exercises.exercise_list', [
            'exercises' => $exercises,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for editing the exercise
     */
    public function edit($id)
    {
        $food = Exercise::findOrFail($id);
        $foods = Exercise::all();
        return view('exercise.edit', compact('exercise', 'exercises'));
    }


    /**
     * Show confirmation page before updating
     */
    public function confirmEdit(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'calories_per_10min' => 'required|numeric|min:0',
        ]);

        $request->session()->put('temp_data', $request->all());

        $exercise = Exercise::findOrFail($id);
        return view('admin.exercises.confirm-edit', compact('food'));
    }

    /**
     * Update the food
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'calories_per_10min' => 'required|numeric|min:0',
        ]);

        $exercise = Exercise::findOrFail($id);
        $exercise->update($validated);

        return redirect()->route('admin.exercise.exercise_list')
            ->with('success', 'Exercise updated successfully');
    }

    /**
     * Show confirmation page before deleting
     */
    public function confirmDelete($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('admin.exercises.confirm-delete', compact('exercise'));
    }

    /**
     * Remove the food
     */
    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();

        return redirect()->route('admin.exercise.exercise_list')
             ->with('success', 'Exercise deleted successfully.');
    }
}