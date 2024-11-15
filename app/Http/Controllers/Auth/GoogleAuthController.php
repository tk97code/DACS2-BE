<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function googlePage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();


            $finduser = User::where('google_id', $user->id)->first();

            // dd($finduser);

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended(route('dashboard.index'));
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect()->intended(route('dashboard.index'));
            }

            request()->session()->regenerate();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
