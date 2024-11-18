<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Chef; // Add the Chef model
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);

              
                if ($user->role === 'admin') {
                    return redirect()->intended('/dash');
                }
                return redirect()->intended('/home');
            }

          
            $chef = Chef::where('email', $googleUser->getEmail())->first();

            if ($chef) {
                Auth::login($chef);
                return redirect()->intended('/dash');
            }

           
            return redirect()->route('register')->with([
                'googleUser' => $googleUser,
                'message' => 'We couldn\'t find an account with this email. Please register.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['msg' => 'Google login failed. Please try again.']);
        }
    }
}
