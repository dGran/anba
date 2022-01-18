<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Team;
use App\Models\Season;
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

        return view('teams.index', ['divisions' => $divisions]);
    }

    public function home($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.home', ['team' => $team]);
    }

    // public function roster($slug) {
    //     $team = Team::where('slug', $slug)->first();
    // 	return view('team.roster', ['team' => $team]);
    // }

    public function roster(Request $request) {
        $slug = $request->t;
        $team = Team::where('slug', $slug)->first();
        return view('team.roster', ['t' => $slug, 'team' => $team]);
    }

    public function leaders(Request $request) {
        $slug = $request->t;
        $team = Team::where('slug', $slug)->first();
        $season = $request->season;
        return view('team.leaders', ['t' => $slug, 'team' => $team, 'season' => $season]);
    }

    public function teamStats($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.team_stats', ['team' => $team]);
    }

    public function playerStats($slug) {
        $team = Team::where('slug', $slug)->first();
        return view('team.player_stats', ['team' => $team]);
    }

    public function schedule(Request $request) {
        $slug = $request->t;
        $team = Team::where('slug', $slug)->first();
        $season = $request->season;
        return view('team.schedule', ['t' => $slug, 'team' => $team, 'season' => $season]);
    }
}
