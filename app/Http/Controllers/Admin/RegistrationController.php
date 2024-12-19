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

    public function food_store(Request $request) {
        $request->validate([
            'item_name' => 'required|array',
            'item_name.*' => 'required|string',
            'image' => 'nullable|array',
            'image.*' => 'nullable||mimes:jpeg,jpg,png,gif|max:1048',
            'calories' => 'required|array',
            'calories.*' => 'required|integer',
            'amount' => 'required|array',
            'amount.*' => 'required|string'
        ]);

        $item_names = $request->item_name;
        $array_images = $this->uploadImages($request->file('image'));
        $calories = $request->calories;
        $amounts = $request->amount;

        foreach($request->item_name as $i => $item_name) {
            $food = new Food;
            $food->item_name = $item_name;
            $food->image = isset($array_images[$i]) ? $array_images[$i] : null;
            $food->calories = $calories[$i];
            $food->amount = $amounts[$i];
            $food->save();
        }

        session()->flash('status', 'success');
        session()->flash('item_names', $item_names);
        session()->flash('calories', $calories);
        session()->flash('images', $array_images);
        session()->flash('amounts', $amounts);

        return redirect()->route('admin.food.registration.complete');
    }

    public function uploadImages($images)
    {
        $array_images = [];

        if (is_array($images)) {
            foreach ($images as $image) {
                $array_image = 'data:image/' . $image->extension() . ';base64,' . base64_encode(file_get_contents($image));
                $array_images[] = $array_image;
            }
        }

        return $array_images;
    }

    public function food_complete() {
        return view('admin.registration.foods.comp');
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

        $names = $request->name;
        $calories = $request->calories;

        foreach($request->name as $i=>$name) {
            $exercise = new Exercise();
            $exercise->name = $name;
            $exercise->calories = $request->calories[$i];
            $exercise->save();
        }

        session()->flash('status', 'success');
        session()->flash('names', $names);
        session()->flash('calories', $calories);

        return redirect()->route('admin.exercise.registration.complete');
    }

    public function exercise_complete() {
        return view('admin.registration.exercises.comp');
    }
}
