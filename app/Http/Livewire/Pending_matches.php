<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Auth;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Match;
use Carbon\Carbon;


class Pending_matches extends Component
{
	public $pending_matches;
	public $current_season;
	public $filterTeam = 'all';

	protected $queryString = [
		'filterTeam' => ['except' => 'all'],
	];

	public function mount()
	{
		$this->current_season = Season::where('current', 1)->first();
	}

	public function render()
	{
		$user_id = Auth::id();
		$season_teams = SeasonTeam::with('team')
    	->join('teams', 'teams.id', 'seasons_teams.team_id')
    	->join('users', 'users.id', 'teams.manager_id')
    	->where('season_id', $this->current_season->id)
    	->where('users.id', '!=', $user_id)
    	->select('seasons_teams.*')
    	->orderBy('teams.medium_name', 'asc')
    	->get();

    	$this->getData();

        return view('manager.pending_matches.index', [
        	'season_teams' => $season_teams,
        ]);
	}

	public function getData()
	{
        $this->pending_matches = collect();
        $user_id = Auth::id();
        $matches = Match::with('localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager')
        	->where('season_id', $this->current_season->id)
        	->where('played', 0)
            ->where(function($q) use ($user_id) {
                $q->where('matches.local_manager_id', $user_id)
                    ->orWhere('matches.visitor_manager_id', $user_id);
                });
            if ($this->filterTeam != 'all') {
            	$filterTeam = $this->filterTeam;
            	$matches = $matches->where(function($q) use ($filterTeam) {
                $q->where('matches.local_team_id', $filterTeam)
                    ->orWhere('matches.visitor_team_id', $filterTeam);
                });
            }
            $matches = $matches->select('matches.*')->orderBy('matches.id', 'desc')->get();

        foreach ($matches as $match) {
            if ($match->local_manager_id == $user_id) {
                if (!$match->hasLocalPlayerStats() || !$match->hasLocalTeamStats()) {
			        $this->pending_matches->push([
			        	'id' => $match->id,
			        	'round_id' => $match->round_id,
			            'localTeam_short_name' => $match->localTeam->team->short_name,
			            'localTeam_medium_name' => $match->localTeam->team->medium_name,
			            'localTeam_img' => $match->localTeam->team->getImg(),
			            'localTeam_manager' => $match->localManager->name,
			            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
			            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
			            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
			            'visitorTeam_manager' => $match->visitorManager->name,
			            'stadium' => $match->stadium,
			            'extra_times' => $match->extra_times,
			        ]);
                }
            } else {
                if (!$match->hasVisitorPlayerStats() || !$match->hasVisitorTeamStats()) {
			        $this->pending_matches->push([
			        	'id' => $match->id,
			        	'round_id' => $match->round_id,
			            'localTeam_short_name' => $match->localTeam->team->short_name,
			            'localTeam_medium_name' => $match->localTeam->team->medium_name,
			            'localTeam_img' => $match->localTeam->team->getImg(),
			            'localTeam_manager' => $match->localManager->name,
			            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
			            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
			            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
			            'visitorTeam_manager' => $match->visitorManager->name,
			            'stadium' => $match->stadium,
			            'extra_times' => $match->extra_times,
			        ]);
                }
            }
        }
	}

}
