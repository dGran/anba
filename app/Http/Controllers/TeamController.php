<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function teams() {
        $divisions = Division::
            with('teams')
            ->select('divisions.*')
            ->join('conferences', 'conferences.id', 'divisions.conference_id')
            ->orderBy('conferences.name', 'asc')
            ->orderBy('divisions.name', 'asc')
            ->get();

        return view('teams.teams.index', ['divisions' => $divisions]);
    }

    public function team($slug, $op = null) {
        $team = Team::where('slug', $slug)->first();

    	return view('team', ['team' => $team, 'op' => $op]);
    }
}
