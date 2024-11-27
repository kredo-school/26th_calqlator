<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Exercise;

class RegistrationController extends Controller
{
    private $food;
    private $exercise;

    public function __construct(Food $food , Exercise $exercise){
        $this->food = $food;
        $this->exercise = $exercise;
    }

    public function food_index() {

        return view('admin.registration.foods.index');
    }

    public function complete() {

        return view('admin.registration.foods.complete');
    }

    public function exercise_index() {
        $exercise = $this->exercise->latest();

        return view('admin.registration.exercises.index')->with([
                                                                    'exercise' => $exercise,
                                                            ]);
    }

    public function exercise_store(Request $request) {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string',
            'calories' => 'required|array',
            'calories.*' => 'required|integer'
        ]);

        foreach($request->name as $i=>$name) {
            $exercise = new Exercise();
            $exercise->name = $name;
            $exercise->calories = $request->calories[$i];
            $exercise->save();
        }

        return response()->json(['success' => true]);
    }
}
