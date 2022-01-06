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

    public function home($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.home', ['team' => $team]);
    }

    public function roster($slug) {
        $team = Team::where('slug', $slug)->first();
    	return view('team.roster', ['team' => $team]);
    }

    public function leaders($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.leaders', ['team' => $team]);
    }

    public function teamStats($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.team_stats', ['team' => $team]);
    }

    public function playerStats($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.player_stats', ['team' => $team]);
    }

    public function schedule($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.schedule', ['team' => $team]);
    }
}
