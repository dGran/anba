<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function index($slug) {
        $player = Player::where('slug', $slug)->first();

        return view('player', ['player' => $player]);
    }

    public function gameLog($slug) {
        $player = Player::where('slug', $slug)->first();

        return view('player_gamelog', ['player' => $player]);
    }
}
