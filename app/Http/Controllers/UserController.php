<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);


        $user->name = $request->name;
        $user->email = $request->email;



        $user->save();

        // 4. Redirect back with success message
        return redirect()->back()->with('success', 'User updated successfully ');
    }
}
