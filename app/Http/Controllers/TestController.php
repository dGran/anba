<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $usersOnline = \App\Models\Session::whereNotNull('user_id')->distinct('user_id')->get();
        $visitorsOnline = \App\Models\Session::select('ip_address')->whereNull('user_id')->distinct('ip_address')->get();
        dd($usersOnline);
        // view()->share('usersOnline', $usersOnline);
    }
}
