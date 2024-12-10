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
        $search = $request->input('search');

       $exercises = Exercise::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->orderBy('id', 'asc')
            ->get();
            
        return view('admin.exercises.exercise_list', compact('exercises'));
    }

    /**
     * Show the form for editing the exercise
     */
    public function edit($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercises = Exercise::all();
        return view('exercise.edit', compact('exercise', 'exercises'));
    }


    /**
     * Show confirmation page before updating
     */
    public function exerciseEdit(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'calories_per_10min' => 'required|numeric|min:0',
        ]);

        $request->session()->put('temp_data', $request->all());

        $exercise = Exercise::findOrFail($id);
        return view('admin.exercises.modals.action', compact('exercise'));
    }

    /**
     * Update the exercise
     */
    public function update(Request $request, $id)
    {

       $validated = $request->validate([
            'name' => 'required|max:255',
            'calories' => 'required|numeric|min:0',
        ]);

        $exercise = Exercise::findOrFail($id);
        $exercise->update($validated);

        return redirect()->route('admin.exercises.list');
            
    }

    /**
     * Show confirmation page before deleting
     */
    public function exerciseDelete($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('admin.exercises.modals.action', compact('exercise'));
    }

    /**
     * Remove the exercise
     */
    public function delete($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();

        return redirect()->route('admin.exercises.list');
    }
}