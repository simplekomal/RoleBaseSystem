<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show all users
    public function index()
    {
        if(Auth::check() == false){
            return redirect('/login');
        }


                $users = User::all(); // fetch all users
                 $roles = Role::where('name', Auth::user()->role)->first();
                 
                return view('admin', compact('users', 'roles'));


    }


        public function edit($id)
        {
            // dd($id);
            $user = User::where('id','=',$id)->first();


            return view('edit', compact('user'));
        }
        

        // Show Add User form
    public function create()
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'owner'])) {
            abort(403, "Unauthorized");
        }

        return view('create');
    }

    // Store new user
    public function store(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'owner'])) {
            abort(403, "Unauthorized");
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:user,admin',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully!');
    }
        

     // Delete user
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
