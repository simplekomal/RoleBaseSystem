<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Show all users
    public function index()
    {
        if(Auth::check() == false){
            return redirect('/login');
        }
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner'){

            $users = User::all(); // fetch all users
            return view('admin', compact('users'));
        }else{
            return "You don't have admin access.";
        }
    }


        public function edit($id)
        {
            $user = User::find($id)->first();

            return view('edit', compact('user'));
        }
        

}
