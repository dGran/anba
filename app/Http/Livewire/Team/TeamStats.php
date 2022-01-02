<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;

class TeamStats extends Component
{
    public $team;

	public function mount($team)
	{
		$this->team = $team;
	}

    public function render()
    {
        return view('team.team_stats.index', [

        ]);
    }
}
