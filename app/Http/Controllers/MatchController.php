<?php

namespace App\Http\Controllers;
use App\Models\Match;

use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Match $match)
    {
		return view('match', ['match' => $match]);
    }
}
