<?php

namespace App\Imports;

use App\Models\TeamStat;
use App\Models\Match;
use App\Models\User;
use App\Models\SeasonTeam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class MatchesTeamStatsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $match = Match::find($row['match_id']);
        $season_team = SeasonTeam::find($row['season_team_id']);
        if ($match && $season_team && ($season_team->id == $match->local_team_id || $season_team->id == $match->visitor_team_id)) {
            $regs = TeamStat::where('match_id', $match->id)->where('season_team_id', $season_team->id)->get();
            foreach ($regs as $reg) {
                event(new TableWasUpdated($reg, 'delete'));
                $reg->delete();
            }
            $reg = TeamStat::create([
                'match_id'          => $row['match_id'],
                'season_id'         => $match->season_id,
                'season_team_id'    => $row['season_team_id'],
                'counterattack'     => $row['counterattack'],
                'zone'              => $row['zone'],
                'second_oportunity' => $row['second_oportunity'],
                'substitute'        => $row['substitute'],
                'advantage'         => $row['advantage'],
                'AST'               => $row['ast'],
                'DRB'               => $row['drb'],
                'ORB'               => $row['orb'],
                'STL'               => $row['stl'],
                'BLK'               => $row['blk'],
                'LOS'               => $row['los'],
                'PF'                => $row['pf'],
                'updated_user_id'   => User::find($row['updated_user_id']) ? $row['updated_user_id'] : null,
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
            return $reg;
        }
    }
}
