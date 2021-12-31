<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Player;

class Player_manage extends Component
{
    public $player;

    public function mount($player)
    {
        $this->player = $player;
    }

    public function render()
    {
        return view('players.player.index', [
            // ..
        ]);
    }
}
