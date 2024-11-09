<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Food;


class ConfirmationController extends Controller
{
    private $food;
    private $exercise;

    public function __construct(Food $food , Exercise $exercise){
        $this->food = $food;
        $this->exercise = $exercise;
    }

    public function food_index(Request $request){
        $pending_foods = $this->food->where('status','pending')->paginate(10);

        $search_foods = [];
        if($request->search){
            $search_foods = $this->food->where('status','approved')
                                       ->where('item_name', 'LIKE', '%'.$request->search.'%')
                                       ->get();
        }

        return view('admin.confirmation.food-confirmation')->with('pending_foods', $pending_foods)
                                                           ->with('search_foods', $search_foods)
                                                           ->with('search', $request->search);

    }

    public function exercise_index(Request $request){
        $pending_exercises = $this->exercise->where('status','pending')->paginate(10);

        $search_exercises = [];
        if($request->search){
            $search_exercises = $this->exercise->where('status','approved')
                                       ->where('name', 'LIKE', '%'.$request->search.'%')
                                       ->get();
        }

        return view('admin.confirmation.exercise-confirmation')->with('pending_exercises', $pending_exercises)
                                                           ->with('search_exercises', $search_exercises)
                                                           ->with('search', $request->search);

    }

    public function confirm($id){
        $this->food->where('id', $id)->update(['status' => 'approved']);
        $this->exercise->where('id', $id)->update(['status' => 'approved']);
        return redirect()->back();
    }

    public function delete($id){
        $this->food->where('id', $id)->delete();
        $this->exercise->where('id', $id)->delete();
        return redirect()->back();
    }

}
