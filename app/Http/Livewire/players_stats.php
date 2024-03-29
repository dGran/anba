<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Season;
use App\Models\PlayerStat;
use App\Models\Player;
use App\Models\SeasonTeam;
use App\Models\SeasonDivision;
use App\Models\SeasonConference;

use Livewire\WithPagination;

class players_stats extends Component
{
    use WithPagination;

    public $advanced_filters = false;

	public $current_season;
    public $season;
    public $phase = "regular";
    public $mode = "per_game";

    public $name = null;
    public $position = "all";
    public $position_text = "todas";
    public $experience = "all";
    public $draft_year = "all";
    public $college = "all";
    public $nation = "all";

    public $team = "all";
    public $team_text = "todos";
    public $division = "all";
    public $division_text = "todas";
    public $conference = "all";
    public $conference_text = "todas";

    public $filter_AGE = null;
    public $filter_PJ = 1;
    public $filter_SUM_MIN = 1;
    public $filter_AVG_MIN_min = 0.1;

    public $per_page = 20;
    public $order = "player_name";
    public $order_direction = "asc";

    // queryString
    protected $queryString = [
        'season',
        'phase' => ['except' => 'regular'],
        'mode' => ['except' => 'per_game'],

        'name' => ['except' => ''],
        'position' => ['except' => 'all'],
        'experience' => ['except' => 'all'],
        'draft_year' => ['except' => 'all'],
        'college' => ['except' => 'all'],
        'nation' => ['except' => 'all'],

        'team' => ['except' => 'all'],
        'division' => ['except' => 'all'],
        'conference' => ['except' => 'all'],

        'per_page' => ['except' => 20],
        'order',
        'order_direction',
    ];

    public function reset_all_filters()
    {
        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season = $season->slug;
        }
        $this->phase = "regular";
        $this->mode = "per_game";

        $this->name = null;
        $this->position = "all";
        $this->experience = "all";
        $this->draft_year = "all";
        $this->college = "all";
        $this->nation = "all";

        $this->team = "all";
        $this->division = "all";
        $this->conference = "all";

        $this->change_mode();
    }

    public function change_season()
    {
        $this->current_season = Season::where('slug', $this->season)->first();
    }

    public function change_mode()
    {
        $pre_order = substr($this->order, 0, 3);
        $rest_order = substr($this->order, 4, strlen($this->order));
        if ($pre_order == 'AVG' || $pre_order == 'SUM') {
            if ($this->mode == "per_game") {
                $pre_order = 'AVG';
            } else {
                $pre_order = 'SUM';
            }
            // $order = $pre_order . $rest_order;
            $this->change_order_mode($rest_order);
        } else {
            $this->change_order_mode($this->order);
        }
    }

    public function change_order_mode($order)
    {
        if ($order != 'player_name' && $order != 'teams.short_name' && $order != 'AGE' && $order != 'PJ' && $order != 'PT' && $order != 'PER_FG' && $order != 'PER_TP' && $order != 'PER_FT') {
            if ($this->mode == "per_game") {
                $this->order = 'AVG_' . $order;
            } else {
                $this->order = 'SUM_' . $order;
            }
        }
        $this->page = 1;
    }

    public function change_order($order)
    {
        if ($order != 'player_name' && $order != 'teams.short_name' && $order != 'AGE' && $order != 'PJ' && $order != 'PT' && $order != 'PER_FG' && $order != 'PER_TP' && $order != 'PER_FT') {
            if ($this->mode == "per_game") {
                $order = 'AVG_' . $order;
            } else {
                $order = 'SUM_' . $order;
            }
        }
        if ($this->order == $order) {
            if ($this->order_direction == "asc") {
                $this->order_direction = "desc";
            } else {
                $this->order_direction = "asc";
            }
        } else {
            $this->order = $order;
            if ($this->order != 'player_name' && $this->order != 'teams.short_name') {
                $this->order_direction = "desc";
            } else {
                $this->order_direction = "asc";
            }
        }
        $this->page = 1;
    }

    public function change_per_page()
    {
        $this->page = 1;
    }

    // Pagination
    public function setNextPage()
    {
        $this->page++;
    }

    public function setPreviousPage()
    {
        $this->page--;
    }

    public function set_phase($phase)
    {
        $this->phase = $phase;
    }

    public function getPlayersStats()
    {
        $PlayersStats = PlayerStat::with('player', 'seasonTeam.team')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
                ->join('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->select('player_id', 'season_team_id',
                    // \DB::raw("POSITION(' ' IN players.name) AS space_position"),
                    // \DB::raw("LEFT(players.name, POSITION(' ' IN players.name)-1) AS player_name"),
                    // \DB::raw("RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name)) AS player_surname"),
                    \DB::raw("CONCAT(RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name)), ', ', LEFT(players.name, POSITION(' ' IN players.name)-1)) AS player_name"),
                    \DB::raw('timestampdiff(YEAR, players.birthdate, now()) AS AGE'),
                    \DB::raw('SUM(MIN) as SUM_MIN'),
                    \DB::raw('AVG(MIN) as AVG_MIN'),
                    \DB::raw('AVG(PTS) as AVG_PTS'),
                    \DB::raw('SUM(PTS) as SUM_PTS'),
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('AVG(FGM) as AVG_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('AVG(FGA) as AVG_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('AVG(TPM) as AVG_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('AVG(TPA) as AVG_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('AVG(FTM) as AVG_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('AVG(FTA) as AVG_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('SUM(REB) as SUM_REB'),
                    \DB::raw('AVG(REB) as AVG_REB'),
                    \DB::raw('SUM(ORB) as SUM_ORB'),
                    \DB::raw('AVG(ORB) as AVG_ORB'),
                    \DB::raw('SUM(REB) - SUM(ORB)  as SUM_DRB'),
                    \DB::raw('AVG(REB) - AVG(ORB)  as AVG_DRB'),
                    \DB::raw('AVG(AST) as AVG_AST'),
                    \DB::raw('SUM(AST) as SUM_AST'),
                    \DB::raw('AVG(STL) as AVG_STL'),
                    \DB::raw('SUM(STL) as SUM_STL'),
                    \DB::raw('AVG(BLK) as AVG_BLK'),
                    \DB::raw('SUM(BLK) as SUM_BLK'),
                    \DB::raw('AVG(LOS) as AVG_LOS'),
                    \DB::raw('SUM(LOS) as SUM_LOS'),
                    \DB::raw('AVG(PF) as AVG_PF'),
                    \DB::raw('SUM(PF) as SUM_PF'),
                    \DB::raw('AVG(ML) as AVG_ML'),
                    \DB::raw('SUM(ML) as SUM_ML'),
                    \DB::raw('COUNT(player_id) as PJ'),
                    \DB::raw('SUM(headline) as PT'),
                );
        $PlayersStats = $PlayersStats->where('players_stats.season_id', $this->current_season->id);
        if ($this->phase == "regular") {
            $PlayersStats = $PlayersStats->whereNull('matches.clash_id');
        } else {
            $PlayersStats = $PlayersStats->whereNotNull('matches.clash_id');
        }

        if ($this->position != "all") {
            $PlayersStats = $PlayersStats->where('players.position', $this->position);
        }
        if ($this->experience != "all") {
            switch ($this->experience) {
                case 'rookie':
                    // 0 años de experiencia
                    // $PlayersStats = $PlayersStats->where('players.position', $this->position);
                    break;
                case 'sophomore':
                    // 1 año de experiencia
                    break;
                case 'veterano':
                    // 2 o mas años de experiencia
                    break;
            }
        }
        if ($this->draft_year != "all") {
            $PlayersStats = $PlayersStats->where('players.draft_year', $this->draft_year);
        }
        if ($this->college != "all") {
            $PlayersStats = $PlayersStats->where('players.college', 'LIKE', "%$this->college%");
        }
        if ($this->nation != "all") {
            $PlayersStats = $PlayersStats->where('players.nation_name', 'LIKE', "%$this->nation%");
        }

        if ($this->team != "all") {
            $PlayersStats = $PlayersStats->where('players_stats.season_team_id', $this->team);
        }
        if ($this->division != "all") {
            $PlayersStats = $PlayersStats->where('seasons_teams.season_division_id', $this->division);
        }
        if ($this->conference != "all") {
            $PlayersStats = $PlayersStats->where('seasons_divisions.season_conference_id', $this->conference);
        }

        if ($this->filter_SUM_MIN > 0) {
            $PlayersStats = $PlayersStats->where('players_stats.MIN', '>=', $this->filter_SUM_MIN);
        } else {
            $PlayersStats = $PlayersStats->where('players_stats.MIN', '>=', 1);
            $this->filter_SUM_MIN = 1;
        }

        if ($this->name != null) {
            $PlayersStats = $PlayersStats->having('player_name', 'LIKE', "%$this->name%");
        }
        $PlayersStats = $PlayersStats
            ->having('PJ', '>', $this->filter_PJ)
            ->orderBy($this->order, $this->order_direction)
            ->orderBy('PJ', 'desc')
            ->orderBy('AVG_MIN', 'desc')
            ->orderBy('player_name', 'asc')
            ->groupBy('player_id')
            ->paginate($this->per_page);

        return $PlayersStats;
    }

    public function getTeamsStats()
    {
        $TeamStats = PlayerStat::with('player', 'seasonTeam.team')
                ->join('matches', 'matches.id', 'players_stats.match_id')
                ->join('players', 'players.id', 'players_stats.player_id')
                ->join('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
                ->join('seasons_divisions', 'seasons_divisions.id', 'seasons_teams.season_division_id')
                ->join('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
                ->join('teams', 'teams.id', 'seasons_teams.team_id')
                ->select('season_team_id',
                    // \DB::raw("POSITION(' ' IN players.name) AS space_position"),
                    \DB::raw("LEFT(players.name, POSITION(' ' IN players.name)-1) AS player_name"),
                    // \DB::raw("RIGHT(players.name, LENGTH(players.name) - POSITION(' ' IN players.name)) AS player_surname"),
                    \DB::raw('SUM(MIN) as SUM_MIN'),
                    \DB::raw('AVG(MIN) as AVG_MIN'),
                    \DB::raw('SUM(PTS) / COUNT(DISTINCT(match_id)) as AVG_PTS'),
                    \DB::raw('SUM(PTS) as SUM_PTS'),
                    \DB::raw('SUM(FGM) as SUM_FGM'),
                    \DB::raw('SUM(FGM) / COUNT(DISTINCT(match_id)) as AVG_FGM'),
                    \DB::raw('SUM(FGA) as SUM_FGA'),
                    \DB::raw('SUM(FGA) / COUNT(DISTINCT(match_id)) as AVG_FGA'),
                    \DB::raw('(SUM(FGM) / SUM(FGA)) * 100 as PER_FG'),
                    \DB::raw('SUM(TPM) as SUM_TPM'),
                    \DB::raw('SUM(TPM) / COUNT(DISTINCT(match_id)) as AVG_TPM'),
                    \DB::raw('SUM(TPA) as SUM_TPA'),
                    \DB::raw('SUM(TPA) / COUNT(DISTINCT(match_id)) as AVG_TPA'),
                    \DB::raw('(SUM(TPM) / SUM(TPA)) * 100 as PER_TP'),
                    \DB::raw('SUM(FTM) as SUM_FTM'),
                    \DB::raw('SUM(FTM) / COUNT(DISTINCT(match_id)) as AVG_FTM'),
                    \DB::raw('SUM(FTA) as SUM_FTA'),
                    \DB::raw('SUM(FTA) / COUNT(DISTINCT(match_id)) as AVG_FTA'),
                    \DB::raw('(SUM(FTM) / SUM(FTA)) * 100 as PER_FT'),
                    \DB::raw('SUM(REB) as SUM_REB'),
                    \DB::raw('SUM(REB) / COUNT(DISTINCT(match_id)) as AVG_REB'),
                    \DB::raw('SUM(ORB) as SUM_ORB'),
                    \DB::raw('SUM(ORB) / COUNT(DISTINCT(match_id)) as AVG_ORB'),
                    \DB::raw('SUM(REB) - SUM(ORB) as SUM_DRB'),
                    \DB::raw('(SUM(REB) / COUNT(DISTINCT(match_id))) - (SUM(ORB) / COUNT(DISTINCT(match_id))) as AVG_DRB'),
                    \DB::raw('SUM(AST) / COUNT(DISTINCT(match_id)) as AVG_AST'),
                    \DB::raw('SUM(AST) as SUM_AST'),
                    \DB::raw('SUM(STL) / COUNT(DISTINCT(match_id)) as AVG_STL'),
                    \DB::raw('SUM(STL) as SUM_STL'),
                    \DB::raw('SUM(BLK) / COUNT(DISTINCT(match_id)) as AVG_BLK'),
                    \DB::raw('SUM(BLK) as SUM_BLK'),
                    \DB::raw('SUM(LOS) / COUNT(DISTINCT(match_id)) as AVG_LOS'),
                    \DB::raw('SUM(LOS) as SUM_LOS'),
                    \DB::raw('SUM(PF) / COUNT(DISTINCT(match_id)) as AVG_PF'),
                    \DB::raw('SUM(PF) as SUM_PF'),
                    \DB::raw('SUM(ML) / COUNT(DISTINCT(match_id)) as AVG_ML'),
                    \DB::raw('SUM(ML) as SUM_ML'),
                    \DB::raw('COUNT(DISTINCT(match_id)) AS PJ'),
                );
        $TeamStats = $TeamStats->where('players_stats.season_id', $this->current_season->id);
        if ($this->phase == "regular") {
            $TeamStats = $TeamStats->whereNull('matches.clash_id');
        } else {
            $TeamStats = $TeamStats->whereNotNull('matches.clash_id');
        }

        if ($this->position != "all") {
            $TeamStats = $TeamStats->where('players.position', $this->position);
        }
        if ($this->experience != "all") {
            switch ($this->experience) {
                case 'rookie':
                    // 0 años de experiencia
                    // $TeamStats = $TeamStats->where('players.position', $this->position);
                    break;
                case 'sophomore':
                    // 1 año de experiencia
                    break;
                case 'veterano':
                    // 2 o mas años de experiencia
                    break;
            }
        }

        if ($this->team != "all") {
            $TeamStats = $TeamStats->where('players_stats.season_team_id', $this->team);
        }
        if ($this->division != "all") {
            $TeamStats = $TeamStats->where('seasons_teams.season_division_id', $this->division);
        }
        if ($this->conference != "all") {
            $TeamStats = $TeamStats->where('seasons_divisions.season_conference_id', $this->conference);
        }

        if ($this->filter_SUM_MIN > 0) {
            $TeamStats = $TeamStats->where('players_stats.MIN', '>=', $this->filter_SUM_MIN);
        } else {
            $TeamStats = $TeamStats->where('players_stats.MIN', '>=', 1);
            $this->filter_SUM_MIN = 1;
        }

        if ($this->name != null) {
            $TeamStats = $TeamStats->having('player_name', 'LIKE', "%$this->name%");
        }
        $TeamStats = $TeamStats
            ->having('PJ', '>', $this->filter_PJ)
            ->orderBy($this->order, $this->order_direction)
            ->orderBy('PJ', 'desc')
            ->orderBy('AVG_MIN', 'desc')
            ->orderBy('teams.name', 'asc')
            ->groupBy('season_team_id')
            ->paginate($this->per_page);

        return $TeamStats;
    }

    public function cancel_season_filter()
    {
        if ($season = Season::where('current', 1)->first()) {
            $this->current_season = $season;
            $this->season = $season->slug;
        }
    }

    public function set_filters_texts()
    {
        switch ($this->position) {
            case 'all':
                $this->position_text = "Todas";
                break;
            case 'pg':
                $this->position_text = "Base";
                break;
            case 'sg':
                $this->position_text = "Escolta";
                break;
            case 'sf':
                $this->position_text = "Alero";
                break;
            case 'pf':
                $this->position_text = "Ala-Pivot";
                break;
            case 'c':
                $this->position_text = "Pivot";
                break;
        }

        if ($this->team != "all") {
            $this->team_text = SeasonTeam::find($this->team)->team->name;
        }

        if ($this->division != "all") {
            $this->division_text = SeasonDivision::find($this->division)->division->name;
        }

        if ($this->conference != "all") {
            $this->conference_text = SeasonConference::find($this->conference)->conference->name;
        }
    }

	public function mount()
	{
	}

    public function render()
    {
        if ($this->season == null) {
            if ($season = Season::where('current', 1)->first()) {
                $this->current_season = $season;
                $this->season = $season->slug;
            }
        } else {
            $season = Season::where('slug', $this->season)->first();
            $this->current_season = $season;
            $this->season = $season->slug;
        }

        $seasons = Season::orderBy('name', 'desc')->get();
        $positions = collect([
            ['id' => 'pg', 'name' => 'Base'],
            ['id' => 'sg', 'name' => 'Escolta'],
            ['id' => 'sf', 'name' => 'Alero'],
            ['id' => 'pf', 'name' => 'Ala-Pivot'],
            ['id' => 'c', 'name' => 'Pivot'],
        ]);
        $draft_years = Player::select('draft_year')->distinct()->whereNotNull('draft_year')->orderBy('draft_year', 'asc')->get();
        $nations = Player::select('nation_name')->distinct()->whereNotNull('nation_name')->orderBy('nation_name', 'asc')->get();
        $colleges = Player::select('college')->distinct()->whereNotNull('college')->orderBy('college', 'asc')->get();
        $teams = SeasonTeam::join('teams', 'teams.id', 'seasons_teams.team_id')->select('seasons_teams.id as team_id', 'teams.name as team_name')->where('season_id', $this->current_season->id)->orderBy('teams.name', 'asc')->get();
        $divisions = SeasonDivision::join('divisions', 'divisions.id', 'seasons_divisions.division_id')->select('seasons_divisions.id as division_id', 'divisions.name as division_name')->where('season_id', $this->current_season->id)->orderBy('divisions.name', 'asc')->get();
        $conferences = SeasonConference::join('conferences', 'conferences.id', 'seasons_conferences.conference_id')->select('seasons_conferences.id as conference_id', 'conferences.name as conference_name')->where('season_id', $this->current_season->id)->orderBy('conferences.name', 'asc')->get();
        $players_stats = $this->getPlayersStats();
        $teams_stats = $this->getTeamsStats();

        $this->set_filters_texts();

        return view('stats.players', [
            'players_stats'     => $players_stats,
            'teams_stats'       => $teams_stats,
            'positions'         => $positions,
            'seasons'           => $seasons,
            'nations'           => $nations,
            'colleges'          => $colleges,
            'draft_years'       => $draft_years,
            'teams'             => $teams,
            'divisions'         => $divisions,
            'conferences'       => $conferences,
        ]);
    }
}
