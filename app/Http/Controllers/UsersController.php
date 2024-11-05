<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function($query, $search) {
            return $query->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
        })->paginate(10);

        return view('admin.users.index', compact('users', 'search'));
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