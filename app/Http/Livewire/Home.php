<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Season;

class Home extends Component
{
	public $season;

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season;
		}
	}

    public function render()
    {
        return view('home.index', []);
    }
}