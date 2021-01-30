<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MatchPoll;

class Match extends Component
{
	public $match;

	public function pollVote($match_id, $vote)
	{
		MatchPoll::create([
			'match_id'	=> $match_id,
			'user_id'	=> auth()->user()->id,
			'vote'		=> $vote
		]);
	}

	public function pollDestroy($match_id, $user_id)
	{
		$poll = MatchPoll::where('match_id', $match_id)->where('user_id', $user_id)->first();
		if ($poll) {
			$poll->delete();
		}
	}

	public function mount($match)
	{
		$this->match = $match;
	}

    public function render()
    {
        return view('match.index', []);
    }
}
