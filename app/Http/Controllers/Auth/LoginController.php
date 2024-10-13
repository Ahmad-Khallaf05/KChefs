<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home'; // Default redirect for regular users
    protected $redirectAdmin = '/dash'; // Admin dashboard path
    protected $redirectChef = '/dash'; // Chef dashboard path

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user from the users table (for admin)
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            // Check if the logged-in user is an admin
            $user = Auth::user();
            if ($user->role === 'admin') { // Assuming you have a 'role' column in the users table
                return redirect()->intended($this->redirectAdmin);
            }
            return redirect()->intended($this->redirectTo); // Regular user redirection
        }

        // Attempt to log in the user from the chefs table (for chef)
        if (Auth::guard('chef')->attempt($credentials)) {
            return redirect()->intended($this->redirectChef); // Chef redirection
        }

        // If the login attempt was unsuccessful, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
