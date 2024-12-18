<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodsController extends Controller
{
    private $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
    }
    /**
     * Display a listing of the foods
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $foods = Food::when($search, function ($query, $search) {
            return $query->where('item_name', 'like', "%{$search}%");
        })
            ->where('status','approved')    
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.foods.food_list', compact('foods'));
    }

    
    /**
     * Show the form for editing the food
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $foods = Food::all();
        return view('foods.edit', compact('food', 'foods'));
    }

    /**
     * Show confirmation page before updating
     */
    public function foodEdit(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'calories' => 'required|numeric',
            'amount' => 'required|string|max*255',
        ]);

        $request->session()->put('temp_data', $request->all());

        $food = Food::findOrFail($id);
        return view('admin.foods.modals.action', compact('foods'));
    }

    /**
     * Update the food
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'calories' => 'required|numeric',
            'amount' => 'required|string|max:255',
        ]);

        $food = Food::findOrFail($id);
        $food->update($request->all());

        return redirect()->route('admin.foods.food_list');
     
    }

    /**
     * Show confirmation page before deleting
     */
    public function foodDelete($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.foods.modals.action', compact('foods'));
    }

    /**
     * Remove the food
     */
    public function delete($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('admin.foods.food_list');
            
    }
}
 