<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\MatchPoll;
use App\Models\Player;

class Match extends Component
{
	public $match;
	public $players_stats;

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

    protected function makeComparer($criteria)
    {
        $comparer = function ($first, $second) use ($criteria) {
            foreach ($criteria as $key => $orderType) {
                // normalize sort direction
                $orderType = strtolower($orderType);
                if ($first[$key] < $second[$key]) {
                    return $orderType === "asc" ? -1 : 1;
                } else if ($first[$key] > $second[$key]) {
                    return $orderType === "asc" ? 1 : -1;
                }
            }
            // all elements were equal
            return 0;
        };
        return $comparer;
    }

	protected function loadStats()
	{
    	$players_stats = Collection::make();
		foreach ($this->match->playerStats as $ps) {
			$player_stat['player_id'] = $ps->player->id;
			$player_stat['player_img'] = $ps->player->getImg();
			$player_stat['player_name'] = $ps->player->name;
			$player_stat['player_pos_ordered'] = $ps->player->getPositionOrdered();
			$player_stat['player_pos'] = $ps->player->position;
			$player_stat['player_position'] = $ps->player->getPosition();
			$player_stat['player_injury'] = $ps->injury ? true : false;
			$player_stat['team_id'] = $ps->player->team_id;
			$player_stat['season_team_id'] = $ps->season_team_id;
			$player_stat['MIN'] = $ps->MIN;
			$player_stat['PTS'] = $ps->PTS;
			$player_stat['REB'] = $ps->REB;
			$player_stat['AST'] = $ps->AST;
			$player_stat['STL'] = $ps->STL;
			$player_stat['BLK'] = $ps->BLK;
			$player_stat['LOS'] = $ps->LOS;
			$player_stat['FGM'] = $ps->FGM;
			$player_stat['FGA'] = $ps->FGA;
			$player_stat['TPM'] = $ps->TPM;
			$player_stat['TPA'] = $ps->TPA;
			$player_stat['FTM'] = $ps->FTM;
			$player_stat['FTA'] = $ps->FTA;
			$player_stat['ORB'] = $ps->ORB;
			$player_stat['PF'] = $ps->PF;
			$player_stat['ML'] = $ps->ML;
			$player_stat['headline'] = $ps->headline;


			$players_stats->push($player_stat);
		}

		$criteria = [
			"player_injury" => "asc",
            "headline" => "desc",
            "MIN" => "desc",
            "player_pos_ordered" => "asc",
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $players_stats->sort($comparer);
        $this->players_stats = $sorted->values()->toArray();
	}

	public function mount($match)
	{
		$this->match = $match;
	}

    public function render()
    {
    	$this->loadStats();

        return view('match.index', [
        	'localInjuries' => $this->getLocalInjuries(),
        	'visitorInjuries' => $this->getVisitorInjuries(),
        ]);
    }

    public function getLocalInjuries()
    {
    	return $injuries = Player::whereNotNull('injury_id')->where('team_id', $this->match->localTeam->team->id)->get();
    }

    public function getVisitorInjuries()
    {
    	return $injuries = Player::whereNotNull('injury_id')->where('team_id', $this->match->visitorTeam->team->id)->get();
    }
}
