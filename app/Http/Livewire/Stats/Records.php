<?php

namespace App\Http\Livewire\Stats;

use Livewire\Component;
use App\Models\Season;
use App\Models\PlayerStat;
use App\Models\TeamStat;

class Records extends Component
{
    public $current_season;

	public $season;
    public $phase = "regular";

    // queryString
    protected $queryString = [
        'season',
        'phase' => ['except' => "regular"],
    ];

    public function set_phase($phase)
    {
        $this->phase = $phase;
    }

    public function change_season()
    {
        $season = Season::where('slug', $this->season)->first();
        $this->current_season = $season;
    }

    public $filterType = 'team'; // default value

    public function changeFilterType()
    {
        if ($this->filterType == 'team') {
            // Fetch and set data for teams
        } else if ($this->filterType == 'player') {
            // Fetch and set data for players
        }

        // Additional logic to update the view based on the selected filter
    }

    public function getTopPlayerRecordsSimpleStatGAME($stat)
    {
        $seasonFilter = "";
        $seasonFilterID = $this->current_season ? $this->current_season->id : 0;

        // Conditionally add the season_id filter
        if ($seasonFilterID > 0) {
            $seasonFilter = "WHERE ps.season_id = $seasonFilterID";
        }

        $result = \DB::select("SELECT
                    max_ps.records as records,
                    s.name as seasonname,
                    p.name as playername,
                    p.slug as playerslug,
                    t.short_name as teamname,
                    t.slug as teamslug
                FROM
                    (SELECT
                        ps.player_id,
                        MAX(ps.$stat) as records
                    FROM players_stats ps
                    GROUP BY ps.player_id) max_ps
                INNER JOIN players_stats ps ON ps.player_id = max_ps.player_id AND ps.$stat = max_ps.records
                INNER JOIN matches m ON m.id = ps.match_id
                INNER JOIN players p ON p.id = ps.player_id
                INNER JOIN seasons s ON s.id = ps.season_id
                INNER JOIN seasons_teams st ON st.id = ps.season_team_id
                INNER JOIN teams t ON t.id = st.team_id
                $seasonFilter
                GROUP BY ps.player_id
                ORDER BY records DESC
                LIMIT 5");

        return $result;
    }

    public function getTopTeamRecordsSimpleStatGAME($stat)
    {
        $result = TeamStat::
            join('matches', 'matches.id', 'teams_stats.match_id')
            ->join('seasons_teams', 'seasons_teams.id', 'teams_stats.season_team_id')
            ->select('teams_stats.'.$stat, 'season_team_id');

        // Conditionally add the season_id filter
        if ($this->current_season) {
            $result = $result->where('teams_stats.season_id', $this->current_season->id);
        }

        $result = $result->orderByDesc(\DB::raw($stat))
            ->groupBy('teams_stats.season_team_id', 'teams_stats.match_id')
            ->take(5)
            ->get();

        return $result;
    }

    public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
		$this->season = $season->slug;
        $this->current_season = $season;
		}
	}

    public function render()
    {
        $seasons = Season::orderBy('name', 'desc')->get();

        return view('stats.records.index', [
            'seasons'       => $seasons,
            'tops_records_player_PTS'      => $this->getTopPlayerRecordsSimpleStatGAME('PTS'),
            'tops_records_player_AST'      => $this->getTopPlayerRecordsSimpleStatGAME('AST'),
            'tops_records_player_REB'      => $this->getTopPlayerRecordsSimpleStatGAME('REB'),
            'tops_records_player_BLK'      => $this->getTopPlayerRecordsSimpleStatGAME('BLK'),
            'tops_records_player_STL'      => $this->getTopPlayerRecordsSimpleStatGAME('STL'),
            'tops_records_player_FGM'      => $this->getTopPlayerRecordsSimpleStatGAME('FGM'),
            'tops_records_player_FGA'      => $this->getTopPlayerRecordsSimpleStatGAME('FGA'),
            'tops_records_player_TPM'      => $this->getTopPlayerRecordsSimpleStatGAME('TPM'),
            'tops_records_player_TPA'      => $this->getTopPlayerRecordsSimpleStatGAME('TPA'),
            'tops_records_player_FTM'      => $this->getTopPlayerRecordsSimpleStatGAME('FTM'),
            'tops_records_player_FTA'      => $this->getTopPlayerRecordsSimpleStatGAME('FTA'),
            'tops_records_player_LOS'      => $this->getTopPlayerRecordsSimpleStatGAME('LOS'),
            'tops_records_player_ORB'      => $this->getTopPlayerRecordsSimpleStatGAME('ORB'),
            'tops_records_player_ML'      => $this->getTopPlayerRecordsSimpleStatGAME('ML'),
            'tops_records_team_counterattack'      => $this->getTopTeamRecordsSimpleStatGAME('counterattack'),
            'tops_records_team_zone'      => $this->getTopTeamRecordsSimpleStatGAME('zone'),
            'tops_records_team_second_oportunity'      => $this->getTopTeamRecordsSimpleStatGAME('second_oportunity'),
            'tops_records_team_substitute'      => $this->getTopTeamRecordsSimpleStatGAME('substitute'),
            'tops_records_team_advantage'      => $this->getTopTeamRecordsSimpleStatGAME('advantage'),
            'tops_records_team_AST'      => $this->getTopTeamRecordsSimpleStatGAME('AST'),
            'tops_records_team_DRB'      => $this->getTopTeamRecordsSimpleStatGAME('DRB'),
            'tops_records_team_ORB'      => $this->getTopTeamRecordsSimpleStatGAME('ORB'),
            'tops_records_team_STL'      => $this->getTopTeamRecordsSimpleStatGAME('STL'),
            'tops_records_team_BLK'      => $this->getTopTeamRecordsSimpleStatGAME('BLK'),
            'tops_records_team_LOS'      => $this->getTopTeamRecordsSimpleStatGAME('LOS'),
            'tops_records_team_PF'      => $this->getTopTeamRecordsSimpleStatGAME('PF'),
        ]);
    }
}
