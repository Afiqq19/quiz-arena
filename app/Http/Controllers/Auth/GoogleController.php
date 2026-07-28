<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Update avatar if it changed or was empty
                if ($user->avatar !== $googleUser->avatar) {
                    $user->update(['avatar' => $googleUser->avatar]);
                }
                Auth::login($user);
                return redirect()->intended('/dashboard');
            } else {
                // If user doesn't exist by google_id, check by email first
                $existingUser = User::where('email', $googleUser->email)->first();
                if ($existingUser) {
                    // Link the Google account to the existing manual account
                    $existingUser->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $existingUser->avatar ?? $googleUser->avatar
                    ]);
                    
                    if (!$existingUser->hasVerifiedEmail()) {
                        $existingUser->markEmailAsVerified();
                    }

                    Auth::login($existingUser);
                    return redirect()->intended('/dashboard');
                }

                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => null, // Password is null for social logins
                ]);

                $newUser->markEmailAsVerified();

                Auth::login($newUser);
                return redirect()->intended('/dashboard');
            }

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login menggunakan Google. Silakan coba lagi.');
        }
    }
}
