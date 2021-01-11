<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Match extends Component
{
	public $match;

	public function mount($match)
	{
		$this->match = $match;
	}

    public function render()
    {
        return view('match.index', []);
    }
}
