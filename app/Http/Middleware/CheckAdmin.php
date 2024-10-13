<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Check if the chef is authenticated and has the 'chef' role
        if (Auth::guard('chef')->check() && Auth::guard('chef')->user()->role === 'chef') {
            return $next($request);
        }

        // If the user is not an admin or chef, redirect them or return a 403 response
        return redirect('/home')->with('error', 'You do not have access to this area.');
    }
}
