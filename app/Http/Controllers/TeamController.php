<?php

namespace App\Http\Controllers;

// use App\Models\Team;
// use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index() {
    	// $teams = Team::factory()->count(32)->create();
    	// $users = User::factory()->count(90)->create();
    	return view('teams.list.index');
    }
}
