<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Season;
use App\Models\SeasonTeam;

class Team_management extends Component
{
	public $seasonTeam;

	public function mount($seasonTeam)
	{
		$this->seasonTeam = $seasonTeam;
	}

    public function render()
    {
        return view('teams.team.index', [
        	// 'teams' => $teams,
        ]);
    }
}