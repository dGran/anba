<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Match as MatchModel;
use App\Http\Traits\PostTrait;
use App\Events\PostStored;
use Carbon\Carbon;

class Lobby extends Component
{
	use PostTrait;

    public $filterTeam;

    protected $queryString = [
        'filterTeam' => ['except' => null],
    ];

    public function render()
    {
        $current_season_id = Season::where('current', 1)->first()->id;
        $user_id = 2;
        $matches = [];
        $matchesTeam = MatchModel::
            // leftJoin('seasons_teams as local_season_team', 'local_season_team.id', 'matches.local_team_id')
            // ->leftJoin('seasons_teams as visitor_season_team', 'visitor_season_team.id', 'matches.visitor_team_id')
            // ->leftJoin('teams as local_team', 'teams.id', 'local_season_team.team_id')
            // ->leftJoin('teams as visitor_team', 'teams.id', 'visitor_season_team.team_id')
            leftJoin('users as local_manager', 'local_manager.id', 'matches.local_manager_id')
            ->leftJoin('users as visitor_manager', 'visitor_manager.id', 'matches.visitor_manager_id')
            ->where('matches.season_id', $current_season_id)
            ->where(function ($query) use ($user_id) {
                $query->where('matches.local_manager_id', $user_id)
                      ->where('visitor_manager.ready_to_play', '>', now())
                      ->where('matches.played', 0);
            })
            // ->orWhere(function ($query) use ($user_id) {
            //     $query->where('local_manager.ready_to_play', '>', now())
            //           ->where('matches.visitor_manager_id', $user_id)
            //           ->where('matches.played', 0);
            // })
            ->get();

        // dd($matchesTeam);

    	$seasonTeams = $this->getSeasonTeams();
    	$matches = $this->getMatches();

        return view('admin.lobby', [
        	'seasonTeams' => $seasonTeams,
            'matches' => $matches,
        ]);
    }

    public function getSeasonTeams()
    {
    	$current_season_id = Season::where('current', 1)->first()->id;
    	$seasonTeams = SeasonTeam::
    		with('team', 'team.user')
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->where('seasons_teams.season_id', $current_season_id)
    		->where('users.ready_to_play', '>', now())
            ->select('seasons_teams.*')
    		->orderBy('users.ready_to_play', 'asc')
    		->get();
    	return $seasonTeams;
    }

    public function getMatches()
    {
    	$seasonTeams = $this->getSeasonTeams();
        $teams = [];
        foreach ($seasonTeams as $key => $team) {
            $teams[$key] = $team->id;
        }
        $filterTeam = $this->filterTeam;
        $matches = [];
        if ($filterTeam) {
            $matchesTeam = MatchModel::
            where(function ($query) use ($teams, $filterTeam) {
                $query->where('local_team_id', $filterTeam)
                      ->whereIn('visitor_team_id', $teams)
                      ->where('played', 0);
            })
            ->orWhere(function ($query) use ($teams, $filterTeam) {
                $query->whereIn('local_team_id', $teams)
                      ->where('visitor_team_id', $filterTeam)
                      ->where('played', 0);
            })
            ->get();

            if ($matchesTeam->count() > 0) {
                foreach ($matchesTeam as $key => $match) {
                    $matches[$key] = $match->id;
                }
            }
        } else {
            foreach ($seasonTeams as $key => $team) {
                $matchesTeam = MatchModel::
                where(function ($query) use ($teams, $team) {
                    $query->where('local_team_id', $team->id)
                          ->whereIn('visitor_team_id', $teams)
                          ->where('played', 0);
                })
                ->orWhere(function ($query) use ($teams, $team) {
                    $query->whereIn('local_team_id', $teams)
                          ->where('visitor_team_id', $team->id)
                          ->where('played', 0);
                })
                ->get();

                if ($matchesTeam->count() > 0) {
                    foreach ($matchesTeam as $key => $match) {
                        $matches[$match->id] = $match->id;
                    }
                }
            }
        }

        return $matchesFound = MatchModel::whereIn('id', $matches)->orderBy('id', 'asc')->get();
    }

    public function setFilterTeam($id)
    {
        if ($this->filterTeam == $id) {
            $this->filterTeam = null;
        } else {
            $this->filterTeam = $id;
        }
    }
}
