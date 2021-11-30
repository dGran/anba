<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Http\Traits\PostTrait;
use App\Events\PostStored;
use Carbon\Carbon;

class Lobby extends Component
{
	use PostTrait;

    public function render()
    {
    	$seasonTeams = $this->getSeasonTeams();
    	$matches = $this->getMatches();

        return view('admin.lobby', [
        	'seasonTeams' => $seasonTeams,
        ]);
    }

    public function getSeasonTeams()
    {
    	$current_season_id = Season::where('current', 1)->first()->id;
    	$seasonTeams = SeasonTeam::
    		with('team', 'team.user')
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->where('seasons_teams.season_id', $current_season_id)
    		->where('users.ready_to_play', '>', now())
    		->orderBy('users.ready_to_play', 'asc')
    		->get();

    	return $seasonTeams;
    	// dd($seasonTeams);
    }

    public function getMatches()
    {
    	// $teams = $this->getTeams();

    }
}
