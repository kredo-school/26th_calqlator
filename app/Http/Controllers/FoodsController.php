<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodsController extends Controller
{
    /**
     * Display a listing of the foods
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        //$foods = Food::join('categories', 'foods.category_id', '=', 'categories.id')
            //->select('foods.*', 'categories.name as category_name')
            //->when($search, function($query, $search) {
               // return $query->where('foods.name', 'like', "%{$search}%");
            //})
            //->orderBy('foods.id', 'asc')
            //->paginate(10);

        //$foods = Food::all();

        return view('admin/foods/food_list')->with('search', $search);
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
    public function confirmEdit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'calory' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'unit' => 'required|in:g,quantity,ml,one meal'
        ]);

        $request->session()->put('temp_data', $request->all());

        $food = Food::findOrFail($id);
        return view('admin.foods.confirm-edit', compact('food'));
    }

    /**
     * Update the food
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id' => 'required|exists:categories,id',
            'calory' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'unit' => 'required|in:g,quantity,ml,one meal'
        ]);

        $food = Food::findOrFail($id);
        $food->update($request->all());

        $request->session()->forget('temp_data');

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food updated successfully');
    }

    /**
     * Show confirmation page before deleting
     */
    public function confirmDelete($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.foods.confirm-delete', compact('food'));
    }

    /**
     * Remove the food
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food deleted successfully');
    }

    /**
     * Display food confirmation page
     */
    public function foodConfirmation(Request $request)
    {
        $search = $request->input('search');

        $pending_foods = Food::where('status', 'pending')
            ->orderBy('id', 'desc')
            ->get();

        $search_foods = Food::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->where('status', 'approved')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.confirmation.food-confirmation', compact('pending_foods', 'search_foods', 'search'));
    }

    /**
     * Approve the pending food
     */
    public function approvePendingFood($id)
    {
        $food = Food::findOrFail($id);
        $food->update(['status' => 'approved']);

        return redirect()->route('admin.food.confirmation')
            ->with('success', 'Food approved successfully');
    }

    /**
     * Reject the pending food
     */
    public function rejectPendingFood($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('admin.food.confirmation')
            ->with('success', 'Food rejected successfully');
    }
}