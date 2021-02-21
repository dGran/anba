<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\MatchPoll;
use App\Models\Player;
use App\Models\Score;

use App\Http\Traits\PostTrait;
use App\Events\PostStored;

class Match extends Component
{
	use PostTrait;

	public $match;
	public $players_stats;
	public $boxscore_order = "default";
	public $criteria;

	public $scoreReportModal = false;
	public $scores;
	public $total_scores = [];
	public $extra_times;

	protected $queryString = [
		'boxscore_order' => ['except' => 'default'],
	];

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

	public function openScoreReportModal()
	{
		$this->initializeScores();
		$this->scoreReportModal = true;
	}

	protected function initializeScores()
	{
    	$this->scores = Collection::make();
		foreach ($this->match->season->scores_headers as $header) {
			$score['seasons_scores_headers_id'] = $header->id;
			$score['seasons_scores_headers_name'] = $header->scoreHeader->name;
			$score['local_score'] = null;
			$score['visitor_score'] = null;
			$this->scores->push($score);
		}

		$this->extra_times = null;
	}

	protected function updateScores()
	{

        $total_local_scores = 0;
        $total_visitor_scores = 0;
        if ($this->scores != null) {
	        foreach ($this->scores as $score) {
				$local = $score['local_score'] == null ? 0 : $score['local_score'];
				$visitor = $score['visitor_score'] == null ? 0 : $score['visitor_score'];
				$total_local_scores += $local;
				$total_visitor_scores += $visitor;
	        }
        }
        $this->total_scores['local'] = $total_local_scores;
        $this->total_scores['visitor'] = $total_visitor_scores;
	}

	public function reportResult()
	{
		$this->storeResult();
		$this->createMatchPosts($this->match->id);

		$this->scoreReportModal = false;
		return redirect()->route('match', $this->match->id);
	}

	public function storeResult()
	{
		foreach ($this->scores as $key => $score_temp) {
			$score = Score::create([
				'match_id' => $this->match->id,
				'seasons_scores_headers_id' => $score_temp['seasons_scores_headers_id'],
				'local_score' => $score_temp['local_score'],
				'visitor_score' => $score_temp['visitor_score'],
				'order' => $key+1,
				'updated_user_id' => auth()->user()->id,
			]);
		}

		$this->match->extra_times = $this->extra_times ?: 0;
		$this->match->save();
	}

	protected function createMatchPosts($match_id)
	{
		$match = \App\Models\Match::find($match_id);

		if ($match->winner()) {
			$this->createResultPost($match);
			$this->createFeaturedPost($match);
			$this->createStreakPost($match);
		}
	}

	protected function createResultPost($match)
	{
		$descriptions = [
			$match->winner()->team->medium_name . ' logra la victoria frente a los ' . $match->loser()->team->medium_name . ' en el ' . $match->stadium,
			'Los ' . $match->winner()->team->medium_name . ' vencen a los ' . $match->loser()->team->medium_name . ' en el ' . $match->stadium,
			'Los ' . $match->loser()->team->medium_name . ' han caído derrotados ante los ' . $match->winner()->team->medium_name . ' en el ' . $match->stadium,
		];
		$description_index = rand(0,2);
		$description = $descriptions[$description_index];

		$description .= '.';

    	$post = $this->storePost(
			'resultados',
			$match->id,
			null,
			null,
			null,
			null,
			$match->localTeam->team->short_name . ' | ' . $match->visitorTeam->team->short_name,
			$match->localTeam->team->medium_name . '  ' . $match->score() . '  ' . $match->visitorTeam->team->medium_name,
			$description,
			null,
    	);
    	event(new PostStored($post));
	}

	protected function createFeaturedPost($match)
	{
		//votes
		$votes = $match->votes()['local'] + $match->votes()['visitor'];
		if ($votes > 0) {
			$votes_local = ($match->votes()['local'] / $votes) * 100;
			$votes_visitor = ($match->votes()['visitor'] / $votes) * 100;

			if ( $votes_local <= 20 && $match->localTeam == $match->winner() || $votes_visitor <= 20 && $match->visitorTeam == $match->winner() ) {
				$descriptions = [
					$match->winner()->team->name . ' dan la sorpresa al imponerse a ' . $match->loser()->team->name,
					$match->loser()->team->name . ' cayó de forma inesperada frente a ' . $match->winner()->team->name
				];
				$description_index = rand(0,1);
				$description = $descriptions[$description_index];
				$description .= '.';

		    	$post = $this->storePost(
					'destacados',
					$match->id,
					null,
					null,
					null,
					$match->winner()->team->id,
					'pronósticos' . ' | ' . $match->winner()->team->short_name,
					'Los ' . $match->winner()->team->medium_name . ' contra todo pronóstico',
					$description,
					$match->winner()->team->getImg(),
		    	);
		    	event(new PostStored($post));
			}
		}
	}

	protected function createStreakPost($match)
	{
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
			$player_stat['injury_id'] = $ps->injury_id;
			$player_stat['injury_matches'] = $ps->injury_matches;
			$player_stat['injury_days'] = $ps->injury_days;
			$player_stat['injury_playable'] = $ps->injury_playable;
			$player_stat['injury_name'] = $ps->injury ? $ps->injury->name : '';
			$player_stat['injuried'] = 0;
			if ($ps->injury_id > 0 && !$ps->injury_playable) {
				$player_stat['injuried'] = 1;
			}
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

        $comparer = $this->makeComparer($this->criteria);
        $sorted = $players_stats->sort($comparer);
        $this->players_stats = $sorted->values()->toArray();
	}

	public function mount($match)
	{
		$this->match = $match;
				$this->criteria = [
					"injuried" => "asc",
					"headline" => "desc",
					"MIN" => "desc",
					"player_pos_ordered" => "asc",
		        ];
	}

    public function render()
    {
    	$this->loadStats();

    	$this->updateScores();

        return view('match.index', [
        	'localInjuries' => $this->getLocalInjuries(),
        	'visitorInjuries' => $this->getVisitorInjuries(),
        ]);
    }

    public function getLocalInjuries()
    {
    	return $injuries = Player::whereNotNull('injury_id')->where('injury_playable', 0)->where('team_id', $this->match->localTeam->team->id)->get();
    }

    public function getVisitorInjuries()
    {
    	return $injuries = Player::whereNotNull('injury_id')->where('injury_playable', 0)->where('team_id', $this->match->visitorTeam->team->id)->get();
    }

	public function setOrder($boxscore_order)
	{
		$this->boxscore_order = $boxscore_order;
		switch ($boxscore_order) {
			case 'default':
				$this->criteria = [
					"injuried" => "asc",
					"headline" => "desc",
					"MIN" => "desc",
					"player_pos_ordered" => "asc",
		        ];
				break;
			case 'MIN_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "MIN" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'MIN':
				$this->criteria = [
					"injuried" => "asc",
		            "MIN" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'PTS_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "PTS" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'PTS':
				$this->criteria = [
					"injuried" => "asc",
		            "PTS" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'REB_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "REB" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'REB':
				$this->criteria = [
					"injuried" => "asc",
		            "REB" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'AST_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "AST" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'AST':
				$this->criteria = [
					"injuried" => "asc",
		            "AST" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'ROB_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "STL" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'ROB':
				$this->criteria = [
					"injuried" => "asc",
		            "STL" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'TAP_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "BLK" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'TAP':
				$this->criteria = [
					"injuried" => "asc",
		            "BLK" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'PER_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "LOS" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'PER':
				$this->criteria = [
					"injuried" => "asc",
		            "LOS" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'FGM_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "FGM" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'FGM':
				$this->criteria = [
					"injuried" => "asc",
		            "FGM" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'FGA_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "FGA" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'FGA':
				$this->criteria = [
					"injuried" => "asc",
		            "FGA" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case '3PM_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "TPM" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case '3PM':
				$this->criteria = [
					"injuried" => "asc",
		            "TPM" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case '3PA_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "TPA" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case '3PA':
				$this->criteria = [
					"injuried" => "asc",
		            "TPA" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'TLM_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "FTM" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'TLM':
				$this->criteria = [
					"injuried" => "asc",
		            "FTM" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'TLA_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "FTA" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'TLA':
				$this->criteria = [
					"injuried" => "asc",
		            "FTA" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'RO_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "ORB" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'RO':
				$this->criteria = [
					"injuried" => "asc",
		            "ORB" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'FP_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "PF" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case 'FP':
				$this->criteria = [
					"injuried" => "asc",
		            "PF" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case '+/-_desc':
				$this->criteria = [
					"injuried" => "asc",
		            "ML" => "desc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
			case '+/-':
				$this->criteria = [
					"injuried" => "asc",
		            "ML" => "asc",
		            "player_pos_ordered" => "asc",
		        ];
				break;
		}
	}
}
