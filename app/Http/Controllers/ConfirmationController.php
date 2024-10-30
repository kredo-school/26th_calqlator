<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;


class ConfirmationController extends Controller
{
    private $food;
    public function __construct(Food $food){
        $this->food = $food;
    }

    public function index(Request $request){
        $pending_foods = $this->food->where('status','pending')->get();

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

    public function confirm($id){
        $this->food->where('id', $id)->update(['status' => 'approved']);
        return redirect()->back();
    }

    public function delete($id){
        $this->food->where('id', $id)->delete();
        return redirect()->back();
    }

}
