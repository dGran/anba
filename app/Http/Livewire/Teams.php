<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Season;
use App\Models\SeasonTeam;

class Teams extends Component
{
	public $season;

	public function mount($season)
	{
		$this->season = $season;
	}

    public function render()
    {
    	$teams = SeasonTeam::
    		with('team.user')
    		->with('seasonDivision.division')
    		->with('seasonDivision.seasonConference.conference')
    		->join('teams', 'teams.id', 'seasons_teams.team_id')
    		->join('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
    		->join('divisions', 'divisions.id', 'seasons_divisions.division_id')
    		->where('seasons_teams.season_id', $this->season->id)
    		->orderBy('seasons_teams.season_division_id', 'asc')
    		// ->groupBy('seasons_teams.season_division_id')
    		->get();

        return view('teams.index', [
        	'teams' => $teams,
        ]);
    }
}