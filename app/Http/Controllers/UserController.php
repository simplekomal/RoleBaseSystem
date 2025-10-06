<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Update user
     public function update(Request $request, $id)
    {

      
        $user = User::findOrFail($id);

 

        // Prepare dynamic validation rules
        $rules = [];
        if ($request->has('name')) {
            $rules['name'] = 'sometimes|string|max:255';
        }
        if ($request->has('email')) {
            $rules['email'] = 'sometimes|email|max:255|unique:users,email,' . $id;
        }

        if ($request->filled('password')) {
            $rules['password'] = 'sometimes|min:6|confirmed';
        }

           if ($request->has('role')) {
            $rules['role'] = 'sometimes';
        }


        $validated = $request->validate($rules);

        // Update fields dynamically
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (isset($validated['role']) ) {
            $user->role = $validated['role'];
        }
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }
    
}
