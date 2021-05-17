<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Season;
use App\Models\SeasonDivision;
use App\Models\SeasonConference;
use App\Models\Playoff;
use App\Models\PlayoffRound;
use App\Models\PlayoffClash;
use App\Models\Match;

class Standings extends Component
{
	public $season, $active_season;
	public $view = "conference";
	public $phase = "regular";
	public $order = "wavg";

	public $blank_view = false;
	public $teamInfoModal = false;
	public $fieldTeamInfoTeam, $fieldTeamInfoTitle, $fieldTeamInfoMatches;

	// queryString
	protected $queryString = [
		'season',
		'phase' => ['except' => 'regular'],
		'view' => ['except' => 'conference'],
		'order' => ['except' => 'wavg'],
	];

	public function setOrder($name)
	{
    	$this->order = $name;
	}

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season->slug;
		} else {
			$this->blank_view = true;
		}
	}

 	public function render()
    {
    	if (!$this->blank_view) {
    		$current_season = Season::where('slug', $this->season)->first();
    		$seasons = Season::orderBy('id', 'desc')->get();
	    	$seasons_conferences = SeasonConference::
	    		leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_conferences.*', 'conferences.name')
	    		->where('season_id', $current_season->id)
	    		->orderBy('conferences.name')
	    		->get();
	    	$seasons_divisions = SeasonDivision::
	    		leftJoin('divisions', 'divisions.id', 'seasons_divisions.division_id')
	    		->leftJoin('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
	    		->leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_divisions.*', 'divisions.name')
	    		->where('seasons_divisions.season_id', $current_season->id)
	    		->orderBy('conferences.name', 'asc')
	    		->orderBy('divisions.name', 'asc')
	    		->get();

			if ($this->phase == 'regular') {
				$playoff = null;
				switch ($this->view) {
					case 'conference':
						foreach ($seasons_conferences as $key => $conference) {
							$table_positions[$key] = $current_season->generateTable($this->view, $this->order, $conference->id, null);
						}
						break;
					case 'division':
						foreach ($seasons_divisions as $key => $division) {
							$table_positions[$key] = $current_season->generateTable($this->view, $this->order, null, $division->id);
						}
						break;
					case 'general':
						$table_positions = $current_season->generateTable($this->view, $this->order, null, null);
						break;
				}
			} else {
				$table_positions = null;
				$playoff = Playoff::find($this->phase);
			}

	        return view('standings.index', [
	        	'current_season' => $current_season,
	        	'seasons' => $seasons,
	        	'seasons_conferences' => $seasons_conferences,
	        	'seasons_divisions' => $seasons_divisions,
				'table_positions' => $table_positions,
				'playoff' => $playoff,
	        ]);
    	} else {
	        return view('standings.index', [
	        ]);
    	}
    }

    public function openFieldTeamInfoMatches($field, $team)
    {
    	$current_season = Season::where('slug', $this->season)->first();
    	$team_id = $team;
    	$seasonTeam = \App\Models\SeasonTeam::find($team_id);

        $matches = \App\Models\Match::with('scores', 'localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager')
            ->join('scores', 'scores.match_id', 'matches.id')

            ->join('seasons_teams as local_seasons_teams', 'local_seasons_teams.id', 'matches.local_team_id')
            ->join('seasons_divisions as local_seasons_divisions', 'local_seasons_divisions.id', 'local_seasons_teams.season_division_id')
            ->join('seasons_conferences as local_seasons_conferences', 'local_seasons_conferences.id', 'local_seasons_divisions.season_conference_id')

            ->join('seasons_teams as visitor_seasons_teams', 'visitor_seasons_teams.id', 'matches.visitor_team_id')
            ->join('seasons_divisions as visitor_seasons_divisions', 'visitor_seasons_divisions.id', 'visitor_seasons_teams.season_division_id')
            ->join('seasons_conferences as visitor_seasons_conferences', 'visitor_seasons_conferences.id', 'visitor_seasons_divisions.season_conference_id')

            ->select('matches.*', 'local_seasons_divisions.id as local_division_id', 'local_seasons_conferences.id as local_conference_id', 'visitor_seasons_divisions.id as visitor_division_id', 'visitor_seasons_conferences.id as visitor_conference_id', 'scores.created_at as played_date')
            ->where('matches.season_id', $current_season->id)
            ->where('matches.played', 1)
            ->where(function($q) use ($team_id) {
                $q->where('matches.local_team_id', $team_id)
                    ->orWhere('matches.visitor_team_id', $team_id);
                })
            ->whereNull('round_id')
            ->orderBy('played_date', 'desc')
            ->orderBy('matches.id', 'desc')
            ->get();

		$this->fieldTeamInfoTeam =
		[
			'team_name' => $seasonTeam->team->medium_name,
			'team_img' => $seasonTeam->team->getImg(),
			'team_manager' => $seasonTeam->team->user->name,
			'team_manager_img' => $seasonTeam->team->user->getImg(),
		];

        $this->fieldTeamInfoMatches = collect();

    	switch ($field) {
    		case 'w':
    			$this->fieldTeamInfoMatches_w($matches, $team);
    			break;
    		case 'l':
    			$this->fieldTeamInfoMatches_l($matches, $team);
    			break;
    		case 'conf':
    			$this->fieldTeamInfoMatches_conf($matches, $team);
    			break;
    		case 'div':
    			$this->fieldTeamInfoMatches_div($matches, $team);
    			break;
    		case 'home':
    			$this->fieldTeamInfoMatches_home($matches, $team);
    			break;
    		case 'road':
    			$this->fieldTeamInfoMatches_road($matches, $team);
    			break;
    		case 'ot':
    			$this->fieldTeamInfoMatches_ot($matches, $team);
    			break;
    		case 'last10':
    			$this->fieldTeamInfoMatches_last10($matches, $team);
    			break;
    	}

    	$this->teamInfoModal = true;
    }

    public function fieldTeamInfoMatches_w($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "ganados";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");

            $local_score = $match->scores->sum('local_score');
        	$visitor_score = $match->scores->sum('visitor_score');
			if ($match->local_team_id == $team) {
				if ($local_score > $visitor_score) {
					$this->fieldTeamInfoMatches_push_data($date, $match);
				}
			} else {
				if ($visitor_score > $local_score) {
					$this->fieldTeamInfoMatches_push_data($date, $match);
				}
			}
		}
    }

    public function fieldTeamInfoMatches_l($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "perdidos";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
            $local_score = $match->scores->sum('local_score');
        	$visitor_score = $match->scores->sum('visitor_score');
			if ($match->local_team_id == $team) {
				if ($local_score < $visitor_score) {
					$this->fieldTeamInfoMatches_push_data($date, $match);
				}
			} else {
				if ($visitor_score < $local_score) {
					$this->fieldTeamInfoMatches_push_data($date, $match);
				}
			}
		}
    }

    public function fieldTeamInfoMatches_conf($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "misma conferencia";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
			$same_conf = $match->local_conference_id == $match->visitor_conference_id ? true : false;
			if ($same_conf) {
				$this->fieldTeamInfoMatches_push_data($date, $match);
			}
		}
    }

    public function fieldTeamInfoMatches_div($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "misma división";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
			$same_div = $match->local_division_id == $match->visitor_division_id ? true : false;
			if ($same_div) {
				$this->fieldTeamInfoMatches_push_data($date, $match);
			}
		}
    }

    public function fieldTeamInfoMatches_home($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "local";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
			if ($match->local_team_id == $team) {
				$this->fieldTeamInfoMatches_push_data($date, $match);
			}
		}
    }

    public function fieldTeamInfoMatches_road($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "visitante";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
			if ($match->visitor_team_id == $team) {
				$this->fieldTeamInfoMatches_push_data($date, $match);
			}
		}
    }

    public function fieldTeamInfoMatches_ot($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "con prórroga";

		foreach ($matches as $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
			if ($match->extra_times > 0) {
				$this->fieldTeamInfoMatches_push_data($date, $match);
			}
		}
    }

    public function fieldTeamInfoMatches_last10($matches, $team)
    {
    	$this->fieldTeamInfoTitle = "últimos 10";

		foreach ($matches as $key => $match) {
			$date = \Carbon\Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
			if ($key < 10) {
				$this->fieldTeamInfoMatches_push_data($date, $match);
			}
		}
    }


    public function fieldTeamInfoMatches_push_data($date, $match)
    {
        $this->fieldTeamInfoMatches->push([
        	'id' => $match->id,
        	'date' => $date,
            'localTeam_short_name' => $match->localTeam->team->short_name,
            'localTeam_medium_name' => $match->localTeam->team->medium_name,
            'localTeam_img' => $match->localTeam->team->getImg(),
            'localTeam_manager' => $match->localManager->name,
            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
            'visitorTeam_manager' => $match->visitorManager->name,
            'score' => $match->score(),
            'stadium' => $match->stadium,
            'extra_times' => $match->extra_times,
        ]);
    }

	public function generateRounds()
	{
		$playoff = Playoff::find($this->phase);
		$clashes = intdiv($playoff->num_participants, 2);
		$round_counter = 1;
		while ($clashes >= 1) {
			$round = PlayoffRound::create([
				"playoff_id" 	 => $playoff->id,
				"name"		 	 => $clashes == 1 ? 'Final' : 'Ronda ' . $round_counter,
				"matches_to_win" => 1,
				"matches_max" 	 => 1
			]);
			$clash_order = 1;
			for ($i=0; $i < $clashes ; $i++) {
				if ($clashes == 1) {
					$clash_destiny_order = null;
				} else {
					if ($clash_order % 2 == 0) {
						$clash_destiny_order = $clash_order / 2;
					} else {
						$clash_destiny_order = ($clash_order + 1) / 2;
					}
				}
				$clash = PlayoffClash::create([
					"round_id" 	 	  => $round->id,
					"local_team_id"	  => null,
					"visitor_team_id" => null,
					"order" 		  => $clash_order,
					"destiny_order"   => $clash_destiny_order,
				]);
				$clash_order++;
			}
			$round_counter++;
			$clashes = intdiv($clashes, 2);
		}
	}

	public function generateFirstMatches()
	{
		$playoff = Playoff::find($this->phase);
		$current_season = Season::where('slug', $this->season)->first();
		foreach ($playoff->rounds->first()->clashes as $clash) {
			if ($clash->local_team_id && $clash->visitor_team_id) {
				$match = Match::create([
					'season_id' 		 => $current_season->id,
					'clash_id' 			 => $clash->id,
					'local_team_id' 	 => $clash->local_team_id,
					'local_manager_id' 	 => $clash->localTeam->team->user->id,
					'visitor_team_id' 	 => $clash->visitor_team_id,
					'visitor_manager_id' => $clash->visitorTeam->team->user->id,
					'stadium' 			 => $clash->localTeam->team->stadium,
					'extra_times' 		 => 0,
					'played' 			 => 0,
					'teamStats_state' 	 => 'error',
					'playerStats_state'  => 'error'
				]);
			}
		}
	}

}