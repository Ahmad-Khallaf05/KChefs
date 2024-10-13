<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Define guards (for user and chef)
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Check if the authenticated user is a regular user
                if (Auth::guard($guard)->user() instanceof \App\Models\User) {
                    return redirect(RouteServiceProvider::HOME);  // Redirect to user home
                }

                // Check if the authenticated user is a chef
                if (Auth::guard($guard)->user() instanceof \App\Models\Chef) {
                    return redirect('/chef/dashboard');  // Redirect to chef's dashboard
                }
            }
        }

        return $next($request);
    }
}
