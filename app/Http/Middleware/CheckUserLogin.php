<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
      public function handle(Request $request, Closure $next)
    {
        // Check if the user is not logged in
        if (!Auth::check()) {
            // Redirect to login page if not logged in
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        // User is logged in, allow request to proceed
        return $next($request);
    }
}
