<?php

namespace App\Actions\Fortify;

use App\Events\UserLoggedIn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuthenticate
{
    public static function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            event(new UserLoggedIn($user, $request->ip()));
            $request->session()->regenerate();

            return $user;
        }

        return null;
    }
}
