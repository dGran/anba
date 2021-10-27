<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Player;

class Players extends Component
{
    public $view = "table";

    public function render()
    {
        $injuriePlayers = Player::
            whereNotNull('injury_id')
            ->orderBy('injury_matches', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('players.injuries', [
            'injuriePlayers' => $injuriePlayers
        ]);
    }
}
