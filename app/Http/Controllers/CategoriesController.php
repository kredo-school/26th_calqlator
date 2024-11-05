<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Food;


class CategoriesController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('search');

        $foods = Food::join('categories', 'foods.category_id', '=', 'categories.id')
        ->select('foods.*', 'categories.name as category_name')
        ->when($search, function($query, $search) {
            return $query->where('foods.name', 'like', "%{$search}%")
            ->orWhere('categories.name', 'like', "%{$search}%");
        })
        ->orderBy('foods.id', 'asc')
        ->paginate(10);

        $categories = Category::all();

        return view('admin.foods.index', compact('foods', 'search', 'categories'));
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric'
        ]);

        $food = Food::findOrFail($id);
        $food->update($request->all());

        return redirect()->route('admin.foods.index')
               ->with('success', 'Food updated successfully');
    }

    public function confirmDelete($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.foods.confirm-delete', compact('food'));
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('admin.foods.index')
        ->with('success', 'Food deleted successfully');
    }

    public function confirmEdit(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $categories = Category::all();
        return view('admin.foods.confirm-edit', compact('food', 'categories'));
    }



}
?>