<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\Season;
use App\Models\SeasonTeam;

class Roster extends Component
{
    public $t;
    public $team;

    public $season_team;
    public $current_season;

    public $view = "table";
    public $order = 'position';

    public $playerInfo, $playerInfoStats;
    public $playerInfoModal = false;

    // queryString
    protected $queryString = [
        't',
        'view' => ['except' => "table"],
        'order' => ['except' => "position"],
    ];

    public function change_team($team)
    {
        $this->season_team = SeasonTeam::find($team);
        $this->t = $this->season_team->team->slug;
        $this->team = $this->season_team->team;
    }

    public function openPlayerInfo($player_id)
    {
        $this->playerInfo = Player::find($player_id);
        $current_season = Season::where('current', 1)->first();

        $this->playerInfoStats = PlayerStat::
            join('matches', 'matches.id', 'players_stats.match_id')
            ->join('players', 'players.id', 'players_stats.player_id')
            ->select('player_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('COUNT(player_id) as PJ')
            )
            ->where('players_stats.player_id', $this->playerInfo->id)
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $current_season->id)
            ->whereNotNull('players_stats.MIN')
            ->where('players.team_id', $this->team->id)
            ->get();

        $this->playerInfoModal = true;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    protected function getOrder($order) {
        $order_ext = [
            'name' => [
                'field'     => 'name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'name',
                'direction' => 'desc'
            ],
            'position' => [
                'field'     => 'position',
                'direction' => 'asc'
            ],
            'position_desc' => [
                'field'     => 'position',
                'direction' => 'desc'
            ],
            'height' => [
                'field'     => 'height',
                'direction' => 'asc'
            ],
            'height_desc' => [
                'field'     => 'height',
                'direction' => 'desc'
            ],
            'weight' => [
                'field'     => 'weight',
                'direction' => 'asc'
            ],
            'weight_desc' => [
                'field'     => 'weight',
                'direction' => 'desc'
            ],
            'age' => [
                'field'     => 'birthdate',
                'direction' => 'desc'
            ],
            'age_desc' => [
                'field'     => 'birthdate',
                'direction' => 'asc'
            ],
            'exp' => [
                'field'     => 'draft_year',
                'direction' => 'desc'
            ],
            'exp_desc' => [
                'field'     => 'draft_year',
                'direction' => 'asc'
            ],
            'nation' => [
                'field'     => 'nation_name',
                'direction' => 'asc'
            ],
            'nation_desc' => [
                'field'     => 'nation_name',
                'direction' => 'desc'
            ],
            'college' => [
                'field'     => 'college',
                'direction' => 'asc'
            ],
            'college_desc' => [
                'field'     => 'college',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

	public function mount($team, $t)
	{
		$this->team = $team;
        $this->t = $t;

        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season_team = SeasonTeam::where('season_id', $this->current_season->id)->where('team_id', $this->team->id)->first();
        }
	}

    public function render()
    {
        $players = Player::where('team_id', $this->team->id)
            ->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
            ->orderBy('name', 'asc')
            ->get();


        $more_teams = SeasonTeam::
            leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('seasons_teams.*')
            ->where('seasons_teams.season_id', $this->current_season->id)
            ->orderBy('teams.short_name')
            ->get();

        $prior_team = null;
        $next_team = null;
        foreach ($more_teams as $index => $season_team) {

            if ($season_team->id == $this->season_team->id) {
                if ($index-1 >= 0) {
                    $prior_team = $more_teams[$index-1]->id;
                } else {
                    $prior_team = $more_teams[$more_teams->count()-1]->id;
                }
                if ($index+1 < $more_teams->count()) {
                    $next_team = $more_teams[$index+1]->id;
                } else {
                    $next_team = $more_teams[0]->id;
                }
            }
        }

        return view('team.roster.index', [
            'players'           => $players,
            'more_teams'        => $more_teams,
            'prior_team'        => $prior_team,
            'next_team'         => $next_team
        ]);
    }
}
