<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuthenticate
{
    public static function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $ip = $request->ip();
            $userLoggedSessionKey = \date(\DATE_W3C).'_user_'.$user->id.'_logged';

            if (!$request->session()->has($userLoggedSessionKey)) {
                $request->session()->put($userLoggedSessionKey, true);
                event(new \App\Events\UserLoggedIn($user, $ip));
            }

            $request->session()->regenerate();

            return $user;
        }

        return null;
    }
}
