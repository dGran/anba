<?php

namespace App\Http\Livewire\Players;

use Livewire\Component;
use App\Models\Player;

class Injuries extends Component
{
    public $view = "table";
    public $search;

    public function render()
    {
        $injuriePlayers = Player::
            leftJoin('teams', 'teams.id', 'players.team_id')
            ->select('players.*', 'teams.name as team_name')
            ->whereNotNull('injury_id')
            ->whereNotNull('team_id')
            ->name($this->search)
            ->orderBy('team_id', 'asc')
            ->orderBy('injury_playable', 'desc')
            ->orderBy('injury_matches', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('players.injuries', [
            'injuriePlayers' => $injuriePlayers
        ]);
    }
}
