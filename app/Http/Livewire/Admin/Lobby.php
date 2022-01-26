<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\MatchModel;
use App\Events\PostStored;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Lobby extends Component
{
    public $filterTeam, $filterTeamName;

    // protected $queryString = [
    //     'filterTeam' => ['except' => null],
    // ];

    public function render()
    {
        $seasonTeams = $this->getSeasonTeams();
        $matches = $this->getMatches();
        $priorityMatch = $this->getPriorityMatch();

        return view('admin.lobby.index', [
            'seasonTeams' => $seasonTeams,
            'matches' => $matches,
            'priorityMatch' => $priorityMatch,
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

    public function getPriorityMatch()
    {
        if ($this->filterTeam) {
            $current_season_id = Season::where('current', 1)->first()->id;
            $filterSeasonTeam = SeasonTeam::find($this->filterTeam);
            $user_id = $filterSeasonTeam->team->user->id;
            $seasonTeams = $this->getSeasonTeams();

            foreach ($seasonTeams as $key => $seasonTeam) {
                $userTeam_id = $seasonTeam->team->user->id;
                if ($user_id != $userTeam_id) {
                    $priorityMatch = MatchModel::
                        where('season_id', $current_season_id)
                        ->where(function ($query) use ($user_id, $userTeam_id) {
                            $query->where('local_manager_id', $user_id)
                                  ->where('visitor_manager_id', $userTeam_id)
                                  ->where('played', 0);
                        })
                        ->orWhere(function ($query) use ($user_id, $userTeam_id) {
                            $query->where('local_manager_id', $userTeam_id)
                                  ->where('visitor_manager_id', $user_id)
                                  ->where('played', 0);
                        })
                        ->select('*')
                        ->first();

                    if ($priorityMatch) {
                        return $priorityMatch;
                    }
                }
            }
        }

        return false;
    }

    public function priorityMatchNotification($match_id)
    {
        $match = MatchModel::find($match_id);

        $webhook = config('discord.webhook_general');
        $title = $match->localTeam->team->short_name . ' vs ' . $match->visitorTeam->team->short_name;
        $description = 'Los ' . $match->localTeam->team->medium_name . ' y los ' . $match->visitorTeam->team->medium_name . ' saltan a la cancha.';
        $link = route('match', $match->id);
        return Http::post($webhook, [
            'content' => 'Próximo partido: ' . $match->localTeam->team->medium_name . ' vs ' . $match->visitorTeam->team->medium_name . ' <@&486604867293544458>',
            'embeds' => [
                [
                    'title' => $title,
                    'description' => $description,
                    'url' => $link,
                    // 'color' => '7506394',
                ]
            ],
        ]);
    }

    public function setFilterTeam($id)
    {
        if ($this->filterTeam == $id) {
            $this->filterTeam = null;
        } else {
            $this->filterTeam = $id;
            $this->filterTeamName = SeasonTeam::find($this->filterTeam)->team->name;
        }
    }
}
