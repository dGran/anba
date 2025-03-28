<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\MatchPoll;
use App\Models\Player;
use App\Models\Score;
use App\Models\TeamStat;
use App\Models\PlayerStat;

use App\Http\Traits\PostTrait;
use App\Events\PostStored;

class Matchl extends Component
{
	use PostTrait;

	public $match;
	public $players_stats;
	public $boxscore_order = "default";
	public $criteria;

	public $scoreReportModal = false;
	public $localBoxscoreReport = false;
	public $visitorBoxscoreReport = false;
	public $scores;
	public $total_scores = [];
	public $extra_times;
	public $local_team_stats, $local_players_stats;
	public $visitor_team_stats, $visitor_players_stats;
	public $local_players_stats_totals, $visitor_players_stats_totals;
	public $show_players_stats_totals_under = true;
	public $show_players_stats_totals_inline = false;

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

	protected function calcLocalPlayerStatsTotals()
	{
        $this->local_players_stats_totals = [
        	'MIN' => 0,
        	'PTS' => 0,
        	'REB' => 0,
        	'AST' => 0,
        	'STL' => 0,
        	'BLK' => 0,
        	'LOS' => 0,
        	'FGM' => 0,
        	'FGA' => 0,
        	'TPM' => 0,
        	'TPA' => 0,
        	'FTM' => 0,
        	'FTA' => 0,
        	'ORB' => 0,
			'PF' => 0,
			'ML' => 0,
        ];
        foreach ($this->local_players_stats as $stat) {
        	$this->local_players_stats_totals['MIN'] += $stat['MIN'] == null ? 0 : $stat['MIN'];
        	$this->local_players_stats_totals['PTS'] += $stat['PTS'] == null ? 0 : $stat['PTS'];
        	$this->local_players_stats_totals['REB'] += $stat['REB'] == null ? 0 : $stat['REB'];
        	$this->local_players_stats_totals['AST'] += $stat['AST'] == null ? 0 : $stat['AST'];
        	$this->local_players_stats_totals['STL'] += $stat['STL'] == null ? 0 : $stat['STL'];
        	$this->local_players_stats_totals['BLK'] += $stat['BLK'] == null ? 0 : $stat['BLK'];
        	$this->local_players_stats_totals['LOS'] += $stat['LOS'] == null ? 0 : $stat['LOS'];
        	$this->local_players_stats_totals['FGM'] += $stat['FGM'] == null ? 0 : $stat['FGM'];
        	$this->local_players_stats_totals['FGA'] += $stat['FGA'] == null ? 0 : $stat['FGA'];
        	$this->local_players_stats_totals['TPM'] += $stat['TPM'] == null ? 0 : $stat['TPM'];
        	$this->local_players_stats_totals['TPA'] += $stat['TPA'] == null ? 0 : $stat['TPA'];
        	$this->local_players_stats_totals['FTM'] += $stat['FTM'] == null ? 0 : $stat['FTM'];
        	$this->local_players_stats_totals['FTA'] += $stat['FTA'] == null ? 0 : $stat['FTA'];
        	$this->local_players_stats_totals['ORB'] += $stat['ORB'] == null ? 0 : $stat['ORB'];
        	$this->local_players_stats_totals['PF'] += $stat['PF'] == null ? 0 : $stat['PF'];
        	$this->local_players_stats_totals['ML'] += $stat['ML'] == null ? 0 : $stat['ML'];
        }
	}

	protected function calcVisitorPlayerStatsTotals()
	{
        $this->visitor_players_stats_totals = [
        	'MIN' => 0,
        	'PTS' => 0,
        	'REB' => 0,
        	'AST' => 0,
        	'STL' => 0,
        	'BLK' => 0,
        	'LOS' => 0,
        	'FGM' => 0,
        	'FGA' => 0,
        	'TPM' => 0,
        	'TPA' => 0,
        	'FTM' => 0,
        	'FTA' => 0,
        	'ORB' => 0,
			'PF' => 0,
			'ML' => 0,
        ];
        foreach ($this->visitor_players_stats as $stat) {
        	$this->visitor_players_stats_totals['MIN'] += $stat['MIN'] == null ? 0 : $stat['MIN'];
        	$this->visitor_players_stats_totals['PTS'] += $stat['PTS'] == null ? 0 : $stat['PTS'];
        	$this->visitor_players_stats_totals['REB'] += $stat['REB'] == null ? 0 : $stat['REB'];
        	$this->visitor_players_stats_totals['AST'] += $stat['AST'] == null ? 0 : $stat['AST'];
        	$this->visitor_players_stats_totals['STL'] += $stat['STL'] == null ? 0 : $stat['STL'];
        	$this->visitor_players_stats_totals['BLK'] += $stat['BLK'] == null ? 0 : $stat['BLK'];
        	$this->visitor_players_stats_totals['LOS'] += $stat['LOS'] == null ? 0 : $stat['LOS'];
        	$this->visitor_players_stats_totals['FGM'] += $stat['FGM'] == null ? 0 : $stat['FGM'];
        	$this->visitor_players_stats_totals['FGA'] += $stat['FGA'] == null ? 0 : $stat['FGA'];
        	$this->visitor_players_stats_totals['TPM'] += $stat['TPM'] == null ? 0 : $stat['TPM'];
        	$this->visitor_players_stats_totals['TPA'] += $stat['TPA'] == null ? 0 : $stat['TPA'];
        	$this->visitor_players_stats_totals['FTM'] += $stat['FTM'] == null ? 0 : $stat['FTM'];
        	$this->visitor_players_stats_totals['FTA'] += $stat['FTA'] == null ? 0 : $stat['FTA'];
        	$this->visitor_players_stats_totals['ORB'] += $stat['ORB'] == null ? 0 : $stat['ORB'];
        	$this->visitor_players_stats_totals['PF'] += $stat['PF'] == null ? 0 : $stat['PF'];
        	$this->visitor_players_stats_totals['ML'] += $stat['ML'] == null ? 0 : $stat['ML'];
        }
	}

	public function reportResult()
	{
		$this->storeResult();

		if ($this->match->clash_id) {
			$this->check_clash($this->match->clash_id);
			$this->createClashPosts($this->match->id);
		} else {
			$this->createMatchPosts($this->match->id);
		}

		$this->scoreReportModal = false;
		session()->flash('success', 'Reporte de resultado registrado correctamente.');
	}

	public function storeResult(): void
	{
        foreach ($this->scores as $key => $score_temp) {
            $score = Score::create([
                'match_id' => $this->match->id,
                'seasons_scores_headers_id' => $score_temp['seasons_scores_headers_id'],
                'local_score' => $score_temp['local_score'],
                'visitor_score' => $score_temp['visitor_score'],
                'order' => $key + 1,
                'updated_user_id' => auth()->user()->id,
            ]);
        }

		$match = \App\Models\MatchModel::find($this->match->id);
		$match->extra_times = $this->extra_times ?: 0;
		$match->played = $match->played() ? 1 : 0;
		$match->save();
	}

	protected function createMatchPosts($match_id)
	{
		$match = \App\Models\MatchModel::find($match_id);

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
			'Liga regular' . ' | ' . $match->localTeam->team->short_name . ' | ' . $match->visitorTeam->team->short_name,
			$match->localTeam->team->medium_name . '  ' . $match->score() . '  ' . $match->visitorTeam->team->medium_name,
			$description,
			null,
    	);
    	event(new PostStored($post));
	}

	protected function createFeaturedPost($match)
	{
		//votes
		$pollVotes = MatchPoll::where('match_id', $match->id)->count();
		if ($pollVotes > 4) {
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

	protected function check_clash($clash_id)
	{
		$clash = \App\Models\PlayoffClash::find($clash_id);
		$season = $clash->round->playoff->season;
		$matches_to_win = $clash->round->matches_to_win;
		$local_record = $season->get_table_data_team_record($clash->local_team_id)['w'];
		$visitor_record = $season->get_table_data_team_record($clash->visitor_team_id)['w'];

		if ($matches_to_win ==1 || $clash->result()['local_result'] == $matches_to_win || $clash->result()['visitor_result'] == $matches_to_win)
		{
			// clash finished
			$nextClash = $clash->nextClash();
			if ($nextClash) {
				if ($clash->destiny_clash_local) {
					$nextClash->local_team_id = $clash->winner()->id;
					$nextClash->local_manager_id = $clash->winner()->team->user->id;
					$nextClash->regular_position_local = $clash->winner() && $clash->winner()->id == $clash->local_team_id ? $local_record : $visitor_record;
				} else {
					$nextClash->visitor_team_id = $clash->winner()->id;
					$nextClash->visitor_manager_id = $clash->winner()->team->user->id;
					$nextClash->regular_position_visitor = $clash->winner() && $clash->winner()->id == $clash->local_team_id ? $local_record : $visitor_record;
				}
				$nextClash->save();

				if ($nextClash->local_team_id && $nextClash->visitor_team_id) {
					//generate first match
					$match = \App\Models\MatchModel::create([
						'season_id' 		 => $season->id,
						'clash_id' 			 => $nextClash->id,
						'local_team_id' 	 => $nextClash->regular_position_local >= $nextClash->regular_position_visitor ? $nextClash->local_team_id : $nextClash->visitor_team_id,
						'local_manager_id' 	 => $nextClash->regular_position_local >= $nextClash->regular_position_visitor ? $nextClash->localTeam->team->user->id : $nextClash->visitorTeam->team->user->id,
						'visitor_team_id' 	 => $nextClash->regular_position_local >= $nextClash->regular_position_visitor ? $nextClash->visitor_team_id : $nextClash->local_team_id,
						'visitor_manager_id' => $nextClash->regular_position_local >= $nextClash->regular_position_visitor ? $nextClash->visitorTeam->team->user->id : $nextClash->localTeam->team->user->id,
						'stadium' 			 => $nextClash->regular_position_local >= $nextClash->regular_position_visitor ? $nextClash->localTeam->team->stadium : $nextClash->visitorTeam->team->stadium,
						'extra_times' 		 => 0,
						'played' 			 => 0,
						'teamStats_state' 	 => 'error',
						'playerStats_state'  => 'error'
					]);
				}
			}
		} else {
			$order = \App\Models\MatchModel::where('clash_id', $clash->id)->count() + 1;
			$matches_to_win = $clash->round->matches_to_win;

			// generate next match
			switch ($matches_to_win) {
				case 3:
					switch ($order) {
						case 1:
						case 2:
						case 5:
							$local_team = $local_record >= $visitor_record ? $clash->local_team_id : $clash->visitor_team_id;
							$local_manager = $local_record >= $visitor_record ? $clash->localTeam->team->user->id : $clash->visitorTeam->team->user->id;
							$visitor_team = $local_record >= $visitor_record ? $clash->visitor_team_id : $clash->local_team_id;
							$visitor_manager = $local_record >= $visitor_record ? $clash->visitorTeam->team->user->id : $clash->localTeam->team->user->id;
							$stadium = $local_record >= $visitor_record ? $clash->localTeam->team->stadium : $clash->visitorTeam->team->stadium;
							break;
						case 3:
						case 4:
							$local_team = $local_record >= $visitor_record ? $clash->visitor_team_id : $clash->local_team_id;
							$local_manager = $local_record >= $visitor_record ? $clash->visitorTeam->team->user->id : $clash->localTeam->team->user->id;
							$visitor_team = $local_record >= $visitor_record ? $clash->local_team_id : $clash->visitor_team_id;
							$visitor_manager = $local_record >= $visitor_record ? $clash->localTeam->team->user->id : $clash->visitorTeam->team->user->id;
							$stadium = $local_record >= $visitor_record ? $clash->visitorTeam->team->stadium : $clash->localTeam->team->stadium;
							break;
					}
					break;
				case 4:
					switch ($order) {
						case 1:
						case 2:
						case 5:
						case 7:
							$local_team = $local_record >= $visitor_record ? $clash->local_team_id : $clash->visitor_team_id;
							$local_manager = $local_record >= $visitor_record ? $clash->localTeam->team->user->id : $clash->visitorTeam->team->user->id;
							$visitor_team = $local_record >= $visitor_record ? $clash->visitor_team_id : $clash->local_team_id;
							$visitor_manager = $local_record >= $visitor_record ? $clash->visitorTeam->team->user->id : $clash->localTeam->team->user->id;
							$stadium = $local_record >= $visitor_record ? $clash->localTeam->team->stadium : $clash->visitorTeam->team->stadium;
							break;
						case 3:
						case 4:
						case 6:
							$local_team = $local_record >= $visitor_record ? $clash->visitor_team_id : $clash->local_team_id;
							$local_manager = $local_record >= $visitor_record ? $clash->visitorTeam->team->user->id : $clash->localTeam->team->user->id;
							$visitor_team = $local_record >= $visitor_record ? $clash->local_team_id : $clash->visitor_team_id;
							$visitor_manager = $local_record >= $visitor_record ? $clash->localTeam->team->user->id : $clash->visitorTeam->team->user->id;
							$stadium = $local_record >= $visitor_record ? $clash->visitorTeam->team->stadium : $clash->localTeam->team->stadium;
							break;
					}
					break;
				default:
					// code...
					break;
			}

			$match = \App\Models\MatchModel::create([
				'season_id' 		 => $clash->round->playoff->season_id,
				'clash_id' 			 => $clash->id,
				'local_team_id' 	 => $local_team,
				'local_manager_id' 	 => $local_manager,
				'visitor_team_id' 	 => $visitor_team,
				'visitor_manager_id' => $visitor_manager,
				'stadium' 			 => $stadium,
				'extra_times' 		 => 0,
				'played' 			 => 0,
				'teamStats_state' 	 => 'error',
				'playerStats_state'  => 'error',
				'order'				 => $order
			]);
		}
	}

	protected function createClashPosts($match_id)
	{
		$match = \App\Models\MatchModel::find($match_id);

		if ($match->winner()) {
			$this->createClashResultPost($match);
			$this->createFeaturedPost($match);
			$this->createClashFeaturedPost($match);
		}
	}

	protected function createClashResultPost($match)
	{
		$clash = \App\Models\PlayoffClash::find($match->clash_id);
		$matches_to_win = $clash->round->matches_to_win;

		if ($clash->result()['local_result'] == $matches_to_win || $clash->result()['visitor_result'] == $matches_to_win) {
			// clash finished
	        $next_round = \App\Models\PlayoffRound::where('playoff_id', $clash->round->playoff->id)->where('order', '>', $clash->round->order)->orderBy('order', 'asc')->first();
	        if ($next_round) {
	        	if ($matches_to_win > 1) {
	        		$description = "Con una nueva victoria, los " . $clash->winner()->team->medium_name . " eliminan a los " . $clash->loser()->team->medium_name . " y avanzan a la siguiente ronda, " . $next_round->name;
	        	} else {
	        		$description = $clash->winner()->team->medium_name . " eliminan a los " . $clash->loser()->team->medium_name . " y avanzan a la siguiente ronda, " . $next_round->name;
	        	}
	        } else {
				if (!$clash->round->playoff->playin_place) {
					$description = "¡Campeones! Los " . $clash->winner()->team->medium_name . " han logrado el anillo de ANBA al imponerse a los " . $clash->loser()->team->medium_name;
				} else {
					$description = "Los " . $clash->winner()->team->medium_name . " consiguen la " . $clash->round->playoff->playin_place . "ª plaza de la conferencia " . $clash->round->playoff->seasonConference->conference->name .  " al imponerse a los " . $clash->loser()->team->medium_name;
				}
	        }
		} else {
			if ($match->winner() && $match->winner()->id == $clash->local_team_id) {
				if ($clash->result()['local_result'] > $clash->result()['visitor_result']) {
					if ($clash->result()['local_result'] > $clash->result()['visitor_result'] + 1) {
						$description = "Los " . $match->winner()->team->medium_name . " amplían su ventaja en la serie contra los " . $match->loser()->team->medium_name . ", " . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
					} else {
						$description = "Victoria de los " . $match->winner()->team->medium_name . " que toman ventaja en la serie frente a " . $match->loser()->team->medium_name . ", " . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
					}
				} elseif ($clash->result()['local_result'] == $clash->result()['visitor_result']) {
					$description = "Los " . $match->winner()->team->medium_name . " vencen y empatan la eliminatoria con los " . $match->loser()->team->medium_name . " a " . $clash->result()['local_result'] . ', ' . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
				} elseif ($clash->result()['visitor_result'] > $clash->result()['local_result']) {
					$description = "Victoria de los " . $match->winner()->team->medium_name . " que recortan la ventaja en la serie de los " . $match->loser()->team->medium_name . ", " . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
				}
			} else {
				if ($clash->result()['visitor_result'] > $clash->result()['local_result']) {
					if ($clash->result()['visitor_result'] > $clash->result()['local_result'] + 1) {
						$description = "Los " . $match->winner()->team->medium_name . " amplían su ventaja en la serie contra los " . $match->loser()->team->medium_name . ", " . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
					} else {
						$description = "Victoria de los " . $match->winner()->team->medium_name . " que toman ventaja en la serie frente a " . $match->loser()->team->medium_name . ", " . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
					}
				} elseif ($clash->result()['local_result'] == $clash->result()['visitor_result']) {
					$description = "Los " . $match->winner()->team->medium_name . " vencen y empatan la eliminatoria con los " . $match->loser()->team->medium_name . " a " . $clash->result()['local_result'] . ', ' . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
				} elseif ($clash->result()['local_result'] > $clash->result()['visitor_result']) {
					$description = "Victoria de los " . $match->winner()->team->medium_name . " que recortan la ventaja en la serie de los " . $match->loser()->team->medium_name . ", " . $clash->localTeam->team->short_name . ' ' . $clash->result()['local_result'] . ' - ' . $clash->result()['visitor_result'] . ' ' . $clash->visitorTeam->team->short_name;
				}
			}
		}

    	$post = $this->storePost(
			'resultados',
			$match->id,
			null,
			null,
			null,
			null,
			$clash->round->playoff->name . ' | ' . $clash->round->name . ' | ' . $match->localTeam->team->short_name . ' | ' . $match->visitorTeam->team->short_name,
			$match->localTeam->team->medium_name . '  ' . $match->score() . '  ' . $match->visitorTeam->team->medium_name,
			$description . '.',
			null,
    	);
    	event(new PostStored($post));
	}

	protected function createClashFeaturedPost($match)
	{
		$clash = \App\Models\PlayoffClash::find($match->clash_id);
		$matches_to_win = $clash->round->matches_to_win;
		$title = null;
		$description = null;

		if ($clash->result()['local_result'] == $matches_to_win || $clash->result()['visitor_result'] == $matches_to_win) {
			// clash finished
	        $next_round = \App\Models\PlayoffRound::where('playoff_id', $clash->round->playoff->id)->where('order', '>', $clash->round->order)->orderBy('order', 'asc')->first();
	        if ($next_round) {
	        	$title = $clash->winner()->team->medium_name . ' (' . $clash->winner()->team->user->name . ') ' . ' clasificados para ' . $next_round->name;
	        	$nextClash = $clash->nextClash();
	        	if ($clash->winner() && $clash->winner()->id === $nextClash->local_team_id) {
	        		$rival = $nextClash->visitorTeam;
	        	} else {
	        		$rival = $nextClash->localTeam;
	        	}
	        	if ($rival) {
	        		$description = "Se enfrentarán a los " . $rival->team->medium_name . " de " . $rival->team->user->name;
	        	} else {
	        		$description = "Quedan a la espera de rival";
	        	}
	        } else {
				if (!$clash->round->playoff->playin_place) {
		        	$title = '¡' . $clash->winner()->team->medium_name . ' (' . $clash->winner()->team->user->name . ') ' . ' campeones de ANBA!';
					$description = "Tras derrotar en la final a los " . $clash->loser()->team->medium_name . " de " . $clash->loser()->team->user->name . ". Enhorabuena por el anillo!";
				} else {
		        	$title = '¡' . $clash->winner()->team->medium_name . ' (' . $clash->winner()->team->user->name . ') ' . ' clasificados para los Playoffs!';
					$description = "Tras derrotar a los " . $clash->loser()->team->medium_name . " de " . $clash->loser()->team->user->name . " en el Play-In";
				}
	        }
		}

		if ($title != null && $description != null) {
	    	$post = $this->storePost(
				'destacados',
				$match->id,
				null,
				null,
				null,
				$clash->winner()->team->id,
				$clash->round->playoff->name . ' | ' . $clash->winner()->team->short_name,
				$title,
				$description . '.',
				$clash->winner()->team->getImg(),
	    	);
	    	event(new PostStored($post));
		}

	}

	public function openLocalBoxscoreReport()
	{
		$this->initializeLocalTeamStats();
		$this->initializeLocalPlayerStats();
		$this->localBoxscoreReport = true;
	}

	public function closeLocalBoxscoreReport()
	{
		$this->localBoxscoreReport = false;
	}

	protected function initializeLocalTeamStats()
	{
    	$this->local_team_stats = Collection::make();

		$team_stat['season_team_id'] = $this->match->local_team_id;
		$team_stat['counterattack'] = null;
		$team_stat['zone'] = null;
		$team_stat['second_oportunity'] = null;
		$team_stat['substitute'] = null;
		$team_stat['advantage'] = null;
		$team_stat['AST'] = null;
		$team_stat['DRB'] = null;
		$team_stat['ORB'] = null;
		$team_stat['STL'] = null;
		$team_stat['BLK'] = null;
		$team_stat['LOS'] = null;
		$team_stat['PF'] = null;
		$this->local_team_stats->push($team_stat);
	}

	protected function initializeLocalPlayerStats()
	{
    	$local_players_stats = Collection::make();

    	// local players
    	$players_stats = Player::where('team_id', $this->match->localTeam->team->id)->where('retired', false)->orderBy('name', 'asc')->get();
		foreach ($players_stats as $player) {
			$player_stat['player_id'] = $player->id;
			$player_stat['player_img'] = $player->getImg();
			$explode_name = explode(" ", $player->name);
			switch (count($explode_name)) {
				case 1:
					$player_stat['player_name'] = $explode_name[0];
					break;
				case 2:
					$player_stat['player_name'] = $explode_name[1] . ', ' . $explode_name[0];
					break;
				case (count($explode_name) > 2):
					$subname = '';
					for ($i=1; $i < count($explode_name) ; $i++) {
						if ($i == 1) {
							$subname .= $explode_name[$i];
						} else {
							$subname .= ' ' . $explode_name[$i];
						}
					}
					$player_stat['player_name'] = $subname . ', ' . $explode_name[0];
					break;
			}
			$player_stat['player_pos_ordered'] = $player->getPositionOrdered();
			$player_stat['player_pos'] = $player->getPosition();
			$player_stat['injury_id'] = $player->injury_id;
			$player_stat['injury_matches'] = $player->injury_matches;
			$player_stat['injury_days'] = $player->injury_days;
			$player_stat['injury_playable'] = $player->injury_playable;
			$player_stat['injury_name'] = $player->injury ? $player->injury->name : '';
			$player_stat['injuried'] = 0;
			if ($player->injury_id > 0 && !$player->injury_playable) {
				$player_stat['injuried'] = 1;
			}
			$player_stat['team_id'] = $this->match->localTeam->team->id;
			$player_stat['season_team_id'] = $this->match->local_team_id;
			$player_stat['MIN'] = null;
			$player_stat['PTS'] = null;
			$player_stat['REB'] = null;
			$player_stat['AST'] = null;
			$player_stat['STL'] = null;
			$player_stat['BLK'] = null;
			$player_stat['LOS'] = null;
			$player_stat['FGM'] = null;
			$player_stat['FGA'] = null;
			$player_stat['TPM'] = null;
			$player_stat['TPA'] = null;
			$player_stat['FTM'] = null;
			$player_stat['FTA'] = null;
			$player_stat['ORB'] = null;
			$player_stat['PF'] = null;
			$player_stat['ML'] = null;
			$player_stat['headline'] = 0;

			$local_players_stats->push($player_stat);
		}

		$criteria = [
			"injuried" => "asc",
			"player_name" => "asc",
            "headline" => "desc",
            "MIN" => "desc",
            "player_pos_ordered" => "asc",
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $local_players_stats->sort($comparer);
        $this->local_players_stats = $sorted->values()->toArray();
	}

	public function reportLocalStats()
	{
		$this->storeLocalStats();
		$this->localBoxscoreReport = false;
		session()->flash('success', 'Reporte de estadísticas registrado correctamente.');
	}

	public function storeLocalStats()
	{
		foreach ($this->local_team_stats as $key => $team_stat) {
			$teamStat = TeamStat::create([
				'match_id' 			=> $this->match->id,
				'season_id' 		=> $this->match->season_id,
				'season_team_id' 	=> $team_stat['season_team_id'] == null && $team_stat['season_team_id'] !== 0 ? null : $team_stat['season_team_id'],
				'counterattack'  	=> $team_stat['counterattack'] == null && $team_stat['counterattack'] !== 0 ? null : $team_stat['counterattack'],
				'zone' 			 	=> $team_stat['zone'] == null && $team_stat['zone'] !== 0 ? null : $team_stat['zone'],
				'second_oportunity' => $team_stat['second_oportunity'] == null && $team_stat['second_oportunity'] !== 0 ? null : $team_stat['second_oportunity'],
				'substitute' 		=> $team_stat['substitute'] == null && $team_stat['substitute'] !== 0 ? null : $team_stat['substitute'],
				'advantage' 		=> $team_stat['advantage'] == null && $team_stat['advantage'] !== 0 ? null : $team_stat['advantage'],
				'AST' 				=> $team_stat['AST'] == null && $team_stat['AST'] !== 0 ? null : $team_stat['AST'],
				'DRB' 				=> $team_stat['DRB'] == null && $team_stat['DRB'] !== 0 ? null : $team_stat['DRB'],
				'ORB' 				=> $team_stat['ORB'] == null && $team_stat['ORB'] !== 0 ? null : $team_stat['ORB'],
				'STL' 				=> $team_stat['STL'] == null && $team_stat['STL'] !== 0 ? null : $team_stat['STL'],
				'BLK' 				=> $team_stat['BLK'] == null && $team_stat['BLK'] !== 0 ? null : $team_stat['BLK'],
				'LOS' 				=> $team_stat['LOS'] == null && $team_stat['LOS'] !== 0 ? null : $team_stat['LOS'],
				'PF' 				=> $team_stat['PF'] == null && $team_stat['PF'] !== 0 ? null : $team_stat['PF'],
				'updated_user_id' 	=> auth()->user()->id,
			]);

			foreach ($this->local_players_stats as $key => $player_stat) {
				if ($player_stat['MIN'] > 0) {
					$PTS = $player_stat['PTS'] == null && $player_stat['PTS'] !== 0 ? null : $player_stat['PTS'];
					$REB = $player_stat['REB'] == null && $player_stat['REB'] !== 0 ? null : $player_stat['REB'];
					$AST = $player_stat['AST'] == null && $player_stat['AST'] !== 0 ? null : $player_stat['AST'];
					$STL = $player_stat['STL'] == null && $player_stat['STL'] !== 0 ? null : $player_stat['STL'];
					$BLK = $player_stat['BLK'] == null && $player_stat['BLK'] !== 0 ? null : $player_stat['BLK'];
					$LOS = $player_stat['LOS'] == null && $player_stat['LOS'] !== 0 ? null : $player_stat['LOS'];
					$FGM = $player_stat['FGM'] == null && $player_stat['FGM'] !== 0 ? null : $player_stat['FGM'];
					$FGA = $player_stat['FGA'] == null && $player_stat['FGA'] !== 0 ? null : $player_stat['FGA'];
					$TPM = $player_stat['TPM'] == null && $player_stat['TPM'] !== 0 ? null : $player_stat['TPM'];
					$TPA = $player_stat['TPA'] == null && $player_stat['TPA'] !== 0 ? null : $player_stat['TPA'];
					$FTM = $player_stat['FTM'] == null && $player_stat['FTM'] !== 0 ? null : $player_stat['FTM'];
					$FTA = $player_stat['FTA'] == null && $player_stat['FTA'] !== 0 ? null : $player_stat['FTA'];
					$ORB = $player_stat['ORB'] == null && $player_stat['ORB'] !== 0 ? null : $player_stat['ORB'];
					$PF = $player_stat['PF'] == null && $player_stat['PF'] !== 0 ? null : $player_stat['PF'];
					$ML = $player_stat['ML'] == null && $player_stat['ML'] !== 0 ? null : $player_stat['ML'];
					$headline = $player_stat['headline'];
				} else {
					$PTS = null;
					$REB = null;
					$AST = null;
					$STL = null;
					$BLK = null;
					$LOS = null;
					$FGM = null;
					$FGA = null;
					$TPM = null;
					$TPA = null;
					$FTM = null;
					$FTA = null;
					$ORB = null;
					$PF = null;
					$ML = null;
					$headline = 0;
				}
				$playerStat = PlayerStat::create([
					'match_id' => $this->match->id,
					'season_id' => $this->match->season_id,
					'player_id' => $player_stat['player_id'],
					'injury_id' => $player_stat['injury_id'],
					'injury_matches' => $player_stat['injury_matches'],
					'injury_days' => $player_stat['injury_days'],
					'injury_playable' => $player_stat['injury_playable'],
					'season_team_id' => $player_stat['season_team_id'],
					'MIN' 		=> $player_stat['MIN'] == null && $player_stat['MIN'] !== 0 ? null : $player_stat['MIN'],
					'PTS' 		=> $PTS,
					'REB' 		=> $REB,
					'AST' 		=> $AST,
					'STL' 		=> $STL,
					'BLK' 		=> $BLK,
					'LOS' 		=> $LOS,
					'FGM' 		=> $FGM,
					'FGA' 		=> $FGA,
					'TPM' 		=> $TPM,
					'TPA' 		=> $TPA,
					'FTM' 		=> $FTM,
					'FTA' 		=> $FTA,
					'ORB' 		=> $ORB,
					'PF' 		=> $PF,
					'ML' 		=> $ML,
					'headline' 	=> $headline,
					'updated_user_id' => auth()->user()->id,
				]);

				if ($player_stat['injury_id'] > 0) {
					$player = Player::find($player_stat['player_id']);

					$before = $player->toJson(JSON_PRETTY_PRINT);
					if ($player->injury_matches == 1) {
						$player->injury_id = null;
						$player->injury_matches = null;
						$player->injury_days = null;
						$player->injury_playable = 0;
					} else {
						$player->injury_matches = $player->injury_matches - 1;
					}
					$player->save();
				}
			}
		}

		$this->match->teamStats_state = $this->match->checkTeamStats();
		$this->match->playerStats_state = $this->match->checkPlayerStats();
		$this->match->save();
	}

	public function openVisitorBoxscoreReport()
	{
		$this->initializeVisitorTeamStats();
		$this->initializeVisitorPlayerStats();
		$this->visitorBoxscoreReport = true;
	}

	public function closeVisitorBoxscoreReport()
	{
		$this->visitorBoxscoreReport = false;
	}

	protected function initializeVisitorTeamStats()
	{
    	$this->visitor_team_stats = Collection::make();

		$team_stat['season_team_id'] = $this->match->visitor_team_id;
		$team_stat['counterattack'] = null;
		$team_stat['zone'] = null;
		$team_stat['second_oportunity'] = null;
		$team_stat['substitute'] = null;
		$team_stat['advantage'] = null;
		$team_stat['AST'] = null;
		$team_stat['DRB'] = null;
		$team_stat['ORB'] = null;
		$team_stat['STL'] = null;
		$team_stat['BLK'] = null;
		$team_stat['LOS'] = null;
		$team_stat['PF'] = null;
		$this->visitor_team_stats->push($team_stat);
	}

	protected function initializeVisitorPlayerStats()
	{
    	$visitor_players_stats = Collection::make();

    	// visitor players
    	$players_stats = Player::where('team_id', $this->match->visitorTeam->team->id)->where('retired', false)->orderBy('name', 'asc')->get();
		foreach ($players_stats as $player) {
			$player_stat['player_id'] = $player->id;
			$player_stat['player_img'] = $player->getImg();
			$explode_name = explode(" ", $player->name);
			switch (count($explode_name)) {
				case 1:
					$player_stat['player_name'] = $explode_name[0];
					break;
				case 2:
					$player_stat['player_name'] = $explode_name[1] . ', ' . $explode_name[0];
					break;
				case (count($explode_name) > 2):
					$subname = '';
					for ($i=1; $i < count($explode_name) ; $i++) {
						if ($i == 1) {
							$subname .= $explode_name[$i];
						} else {
							$subname .= ' ' . $explode_name[$i];
						}
					}
					$player_stat['player_name'] = $subname . ', ' . $explode_name[0];
					break;
			}
			$player_stat['player_pos_ordered'] = $player->getPositionOrdered();
			$player_stat['player_pos'] = $player->getPosition();
			$player_stat['injury_id'] = $player->injury_id;
			$player_stat['injury_matches'] = $player->injury_matches;
			$player_stat['injury_days'] = $player->injury_days;
			$player_stat['injury_playable'] = $player->injury_playable;
			$player_stat['injury_name'] = $player->injury ? $player->injury->name : '';
			$player_stat['injuried'] = 0;
			if ($player->injury_id > 0 && !$player->injury_playable) {
				$player_stat['injuried'] = 1;
			}
			$player_stat['team_id'] = $this->match->visitorTeam->team->id;
			$player_stat['season_team_id'] = $this->match->visitor_team_id;
			$player_stat['MIN'] = null;
			$player_stat['PTS'] = null;
			$player_stat['REB'] = null;
			$player_stat['AST'] = null;
			$player_stat['STL'] = null;
			$player_stat['BLK'] = null;
			$player_stat['LOS'] = null;
			$player_stat['FGM'] = null;
			$player_stat['FGA'] = null;
			$player_stat['TPM'] = null;
			$player_stat['TPA'] = null;
			$player_stat['FTM'] = null;
			$player_stat['FTA'] = null;
			$player_stat['ORB'] = null;
			$player_stat['PF'] = null;
			$player_stat['ML'] = null;
			$player_stat['headline'] = 0;

			$visitor_players_stats->push($player_stat);
		}

		$criteria = [
			"injuried" => "asc",
			"player_name" => "asc",
            "headline" => "desc",
            "MIN" => "desc",
            "player_pos_ordered" => "asc",
        ];
        $comparer = $this->makeComparer($criteria);
        $sorted = $visitor_players_stats->sort($comparer);
        $this->visitor_players_stats = $sorted->values()->toArray();
	}

	public function reportVisitorStats()
	{
		$this->storeVisitorStats();
		$this->visitorBoxscoreReport = false;
		session()->flash('success', 'Reporte de estadísticas registrado correctamente.');
	}

	public function storeVisitorStats()
	{
		foreach ($this->visitor_team_stats as $key => $team_stat) {
			$teamStat = TeamStat::create([
				'match_id' 			=> $this->match->id,
				'season_id' 		=> $this->match->season_id,
				'season_team_id' 	=> $team_stat['season_team_id'] == null && $team_stat['season_team_id'] !== 0 ? null : $team_stat['season_team_id'],
				'counterattack'  	=> $team_stat['counterattack'] == null && $team_stat['counterattack'] !== 0 ? null : $team_stat['counterattack'],
				'zone' 			 	=> $team_stat['zone'] == null && $team_stat['zone'] !== 0 ? null : $team_stat['zone'],
				'second_oportunity' => $team_stat['second_oportunity'] == null && $team_stat['second_oportunity'] !== 0 ? null : $team_stat['second_oportunity'],
				'substitute' 		=> $team_stat['substitute'] == null && $team_stat['substitute'] !== 0 ? null : $team_stat['substitute'],
				'advantage' 		=> $team_stat['advantage'] == null && $team_stat['advantage'] !== 0 ? null : $team_stat['advantage'],
				'AST' 				=> $team_stat['AST'] == null && $team_stat['AST'] !== 0 ? null : $team_stat['AST'],
				'DRB' 				=> $team_stat['DRB'] == null && $team_stat['DRB'] !== 0 ? null : $team_stat['DRB'],
				'ORB' 				=> $team_stat['ORB'] == null && $team_stat['ORB'] !== 0 ? null : $team_stat['ORB'],
				'STL' 				=> $team_stat['STL'] == null && $team_stat['STL'] !== 0 ? null : $team_stat['STL'],
				'BLK' 				=> $team_stat['BLK'] == null && $team_stat['BLK'] !== 0 ? null : $team_stat['BLK'],
				'LOS' 				=> $team_stat['LOS'] == null && $team_stat['LOS'] !== 0 ? null : $team_stat['LOS'],
				'PF' 				=> $team_stat['PF'] == null && $team_stat['PF'] !== 0 ? null : $team_stat['PF'],
				'updated_user_id' 	=> auth()->user()->id,
			]);

			foreach ($this->visitor_players_stats as $key => $player_stat) {
				if ($player_stat['MIN'] > 0) {
					$PTS = $player_stat['PTS'] == null && $player_stat['PTS'] !== 0 ? null : $player_stat['PTS'];
					$REB = $player_stat['REB'] == null && $player_stat['REB'] !== 0 ? null : $player_stat['REB'];
					$AST = $player_stat['AST'] == null && $player_stat['AST'] !== 0 ? null : $player_stat['AST'];
					$STL = $player_stat['STL'] == null && $player_stat['STL'] !== 0 ? null : $player_stat['STL'];
					$BLK = $player_stat['BLK'] == null && $player_stat['BLK'] !== 0 ? null : $player_stat['BLK'];
					$LOS = $player_stat['LOS'] == null && $player_stat['LOS'] !== 0 ? null : $player_stat['LOS'];
					$FGM = $player_stat['FGM'] == null && $player_stat['FGM'] !== 0 ? null : $player_stat['FGM'];
					$FGA = $player_stat['FGA'] == null && $player_stat['FGA'] !== 0 ? null : $player_stat['FGA'];
					$TPM = $player_stat['TPM'] == null && $player_stat['TPM'] !== 0 ? null : $player_stat['TPM'];
					$TPA = $player_stat['TPA'] == null && $player_stat['TPA'] !== 0 ? null : $player_stat['TPA'];
					$FTM = $player_stat['FTM'] == null && $player_stat['FTM'] !== 0 ? null : $player_stat['FTM'];
					$FTA = $player_stat['FTA'] == null && $player_stat['FTA'] !== 0 ? null : $player_stat['FTA'];
					$ORB = $player_stat['ORB'] == null && $player_stat['ORB'] !== 0 ? null : $player_stat['ORB'];
					$PF = $player_stat['PF'] == null && $player_stat['PF'] !== 0 ? null : $player_stat['PF'];
					$ML = $player_stat['ML'] == null && $player_stat['ML'] !== 0 ? null : $player_stat['ML'];
					$headline = $player_stat['headline'];
				} else {
					$PTS = null;
					$REB = null;
					$AST = null;
					$STL = null;
					$BLK = null;
					$LOS = null;
					$FGM = null;
					$FGA = null;
					$TPM = null;
					$TPA = null;
					$FTM = null;
					$FTA = null;
					$ORB = null;
					$PF = null;
					$ML = null;
					$headline = 0;
				}
				$playerStat = PlayerStat::create([
					'match_id' => $this->match->id,
					'season_id' => $this->match->season_id,
					'player_id' => $player_stat['player_id'],
					'injury_id' => $player_stat['injury_id'],
					'injury_matches' => $player_stat['injury_matches'],
					'injury_days' => $player_stat['injury_days'],
					'injury_playable' => $player_stat['injury_playable'],
					'season_team_id' => $player_stat['season_team_id'],
					'MIN' 		=> $player_stat['MIN'] == null && $player_stat['MIN'] !== 0 ? null : $player_stat['MIN'],
					'PTS' 		=> $PTS,
					'REB' 		=> $REB,
					'AST' 		=> $AST,
					'STL' 		=> $STL,
					'BLK' 		=> $BLK,
					'LOS' 		=> $LOS,
					'FGM' 		=> $FGM,
					'FGA' 		=> $FGA,
					'TPM' 		=> $TPM,
					'TPA' 		=> $TPA,
					'FTM' 		=> $FTM,
					'FTA' 		=> $FTA,
					'ORB' 		=> $ORB,
					'PF' 		=> $PF,
					'ML' 		=> $ML,
					'headline' 	=> $headline,
					'updated_user_id' => auth()->user()->id,
				]);

				if ($player_stat['injury_id'] > 0) {
					$player = Player::find($player_stat['player_id']);

					$before = $player->toJson(JSON_PRETTY_PRINT);
					if ($player->injury_matches == 1) {
						$player->injury_id = null;
						$player->injury_matches = null;
						$player->injury_days = null;
						$player->injury_playable = 0;
					} else {
						$player->injury_matches = $player->injury_matches - 1;
					}
					$player->save();
				}
			}
		}

		$this->match->teamStats_state = $this->match->checkTeamStats();
		$this->match->playerStats_state = $this->match->checkPlayerStats();
		$this->match->save();
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

    	$playerStats = PlayerStat::with('player.injury')->where('match_id', $this->match->id)->get();
		foreach ($playerStats as $ps) {
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
		if ($this->scoreReportModal || $this->localBoxscoreReport || $this->visitorBoxscoreReport) {
			if ($this->scoreReportModal) {
	    		$this->updateScores();
			}
			if ($this->localBoxscoreReport) {
	    		$this->calcLocalPlayerStatsTotals();
			}
			if ($this->visitorBoxscoreReport) {
	    		$this->calcVisitorPlayerStatsTotals();
			}
		} else {
			$this->match = \App\Models\MatchModel::find($this->match->id);
		}

		$this->loadStats();
		$localTeam_playerTotals = $this->match->localTeam_playerTotals();
		$localTeam_teamTotals = $this->match->localTeam_teamTotals();
		$visitorTeam_playerTotals = $this->match->visitorTeam_playerTotals();
		$visitorTeam_teamTotals = $this->match->visitorTeam_teamTotals();
		$mvp = $this->match->mvp();

        return view('match.index', [
        	'localInjuries' => $this->getLocalInjuries(),
        	'visitorInjuries' => $this->getVisitorInjuries(),
			'localTeam_playerTotals' => $localTeam_playerTotals,
			'localTeam_teamTotals' => $localTeam_teamTotals,
			'visitorTeam_playerTotals' => $visitorTeam_playerTotals,
			'visitorTeam_teamTotals' => $visitorTeam_teamTotals,
			'mvp' => $mvp,
        ]);
    }

    public function getLocalInjuries()
    {
    	return $injuries = Player::whereNotNull('injury_id')->where('team_id', $this->match->localTeam->team->id)->orderBy('injury_playable', 'asc')->get();
    }

    public function getVisitorInjuries()
    {
    	return $injuries = Player::whereNotNull('injury_id')->where('team_id', $this->match->visitorTeam->team->id)->orderBy('injury_playable', 'asc')->get();
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
