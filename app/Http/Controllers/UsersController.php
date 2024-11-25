<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

     /**
     * Display a listing of the foods
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function($query, $search) {
            return $query->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('user_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy('id', 'asc')
        ->get();

        return view('admin.users.user_list', compact('users'));
    }

    public function deactivate($id)
    {
        User::destroy($id);
        return redirect()->back();
    }

    public function activate($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
?>