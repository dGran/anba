<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Match as MatchModel;
use App\Models\User;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function pendingReports()
    {
        $user_id = Auth::id();
        $currentSeason = Season::where('current', 1)->first();

        $matches = MatchModel::with('scores', 'localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager')
            ->join('scores', 'scores.match_id', 'matches.id')
        	->where('season_id', $currentSeason->id)
        	->where('played', 1)
            ->where(function($q) use ($user_id) {
                $q->where('matches.local_manager_id', $user_id)
                    ->orWhere('matches.visitor_manager_id', $user_id);
                })
			->select('matches.*', 'scores.created_at as played_date')
            ->orderBy('played_date', 'desc')
            ->orderBy('matches.id', 'desc')
            ->get();

        $pending_reports = collect();

        foreach ($matches as $match) {
        	$date = Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
            if ($match->local_manager_id == $user_id) {
                if (!$match->hasLocalPlayerStats() || !$match->hasLocalTeamStats()) {
			        $pending_reports->push([
			        	'id' => $match->id,
			        	'round_id' => $match->round_id,
			        	'date' => $date,
			            'localTeam_short_name' => $match->localTeam->team->short_name,
			            'localTeam_medium_name' => $match->localTeam->team->medium_name,
			            'localTeam_img' => $match->localTeam->team->getImg(),
			            'localTeam_manager' => $match->localManager->name,
			            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
			            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
			            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
			            'visitorTeam_manager' => $match->visitorManager->name,
			            'score' => $match->score(),
			            'stadium' => $match->stadium,
			            'extra_times' => $match->extra_times,
			        ]);
                }
            } else {
                if (!$match->hasVisitorPlayerStats() || !$match->hasVisitorTeamStats()) {
			        $pending_reports->push([
			        	'id' => $match->id,
			        	'round_id' => $match->round_id,
			        	'date' => $date,
			            'localTeam_short_name' => $match->localTeam->team->short_name,
			            'localTeam_medium_name' => $match->localTeam->team->medium_name,
			            'localTeam_img' => $match->localTeam->team->getImg(),
			            'localTeam_manager' => $match->localManager->name,
			            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
			            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
			            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
			            'visitorTeam_manager' => $match->visitorManager->name,
			            'score' => $match->score(),
			            'stadium' => $match->stadium,
			            'extra_times' => $match->extra_times,
			        ]);
                }
            }
        }

		return view('manager.pending_reports', ['pending_reports' => $pending_reports]);
    }

    public function pendingMatches()
    {
		return view('manager.pending_matches');
    }

	public function readyToPlaySwitcher($user_id)
	{
		$user = User::findOrFail($user_id);
		if ($user->readyToPlay()) {
			$user->ready_to_play = null;
		} else {
			$user->ready_to_play = Carbon::now()->addHour();
		}
		$user->save();

		$match = $this->checkMatches($user_id);
		// dd($match);

		return back();
	}

	public function checkMatches($user_id)
	{
    	$current_season_id = Season::where('current', 1)->first()->id;
    	// $seasonTeams = SeasonTeam::
    	// 	with('team', 'team.user')
    	// 	->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    	// 	->leftJoin('users', 'users.id', 'teams.manager_id')
    	// 	->where('seasons_teams.season_id', $current_season_id)
    	// 	->where('users.ready_to_play', '>', now())
     //        ->select('seasons_teams.*')
    	// 	->orderBy('users.ready_to_play', 'asc')
    	// 	->get();

     //    $teams = [];
     //    foreach ($seasonTeams as $key => $team) {
     //        $teams[$key] = $team->id;
     //    }

        $matches = [];
        $matchesTeam = MatchModel::
			// leftJoin('seasons_teams as local_season_team', 'local_season_team.id', 'matches.local_team_id')
			// ->leftJoin('seasons_teams as visitor_season_team', 'visitor_season_team.id', 'matches.visitor_team_id')
			// ->leftJoin('teams as local_team', 'teams.id', 'local_season_team.team_id')
			// ->leftJoin('teams as visitor_team', 'teams.id', 'visitor_season_team.team_id')
			leftJoin('users as local_manager', 'local_manager.id', 'matches.local_manager_id')
			->leftJoin('users as visitor_manager', 'visitor_manager.id', 'matches.visitor_manager_id')
	        ->where('matches.season_id', $current_season_id)
	        ->where(function ($query) use ($user_id) {
	            $query->where('matches.local_manager_id', $user_id)
	                  ->where('visitor_manager.ready_to_play', '>', now())
	                  ->where('played', 0);
	        })
	        ->orWhere(function ($query) use ($user_id) {
	            $query->where('local_manager.ready_to_play', '>', now())
	                  ->where('matches.visitor_manager_id', $user_id)
	                  ->where('played', 0);
	        })
	        ->get();

	    dd($matches);

        if ($matchesTeam->count() > 0) {
            foreach ($matchesTeam as $key => $match) {
                $matches[$key] = $match->id;
            }

			return $matchesFound = MatchModel::whereIn('id', $matches)->orderBy('id', 'asc')->get();
        }

        return false;
	}
}
