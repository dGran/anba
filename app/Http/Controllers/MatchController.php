<?php

namespace App\Http\Controllers;
use App\Models\MatchModel;

use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(MatchModel $match)
    {
		return view('match', ['match' => $match]);
    }
}
