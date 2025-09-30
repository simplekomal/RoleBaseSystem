<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show all users
    public function index()
    {
        if(Auth::check() == false){
            return redirect('/login');
        }
        $roles = Role::where('name', Auth::user()->role)->first();


                // $users = User::all(); // fetch all users
$users = DB::table('users as u')
    ->join('roles as r', 'u.role', '=', 'r.id')
    ->select('u.*', 'r.name as role_name')
    ->get();


                return view('admin', compact('users', 'roles'));

    }


        public function edit($id)
        {
            // dd($id);
            $user = User::where('id','=',$id)->first();
            $roles = Role::all();

            return view('edit', compact('user','roles'));
        }
        

        // Show Add User form
    public function create()
    {

    $roles = Role::all(); // fetch all roles from the database
        return view('create', compact('roles'));
    }

    // Store new user
    public function store(Request $request)
    {

            if (!$request->has('role')) {
                $userRole = Role::where('name', 'user')->first(); 
                if ($userRole) {
                    $request->merge(['role' => $userRole->id]); 
                }
            }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'=>'required',
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
