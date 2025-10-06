<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

  
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return view('home'); 
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
     
        return redirect('/login');
    }


            public function profile()
            {
                $userId = auth()->id();

                // Join users with roles and only get role name
                $user = DB::table('users as u')
                    ->join('roles as r', 'u.role', '=', 'r.id')
                    ->select(
                        'u.id',
                        'u.name',
                        'u.email',
                        'r.name as role_name',
                        'u.created_at',
                        'u.updated_at'
                    )
                    ->where('u.id', $userId)
                    ->first();

                return view('profile', compact('user'));
            }
}
