<?php

namespace App\Imports;

use App\Models\PlayerStat;
use App\Models\MatchModel;
use App\Models\User;
use App\Models\SeasonTeam;
use App\Models\Player;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class MatchesPlayerStatsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $match = MatchModel::find($row['match_id']);
        $before = $match->toJson(JSON_PRETTY_PRINT);
        $season_team = SeasonTeam::find($row['season_team_id']);
        $player = Player::find($row['player_id']);
        if ($match && $player && $season_team && ($season_team->id == $match->local_team_id || $season_team->id == $match->visitor_team_id)) {
            $regs = PlayerStat::where('match_id', $match->id)->where('player_id', $player->id)->get();
            foreach ($regs as $reg) {
                event(new TableWasUpdated($reg, 'delete'));
                $reg->delete();
            }
            $reg = PlayerStat::create([
                'match_id'          => $row['match_id'],
                'season_id'         => $match->season_id,
                'player_id'         => $row['player_id'],
                'season_team_id'    => $row['season_team_id'],
                'MIN'               => $row['min'],
                'PTS'               => $row['pts'],
                'REB'               => $row['reb'],
                'AST'               => $row['ast'],
                'STL'               => $row['stl'],
                'BLK'               => $row['blk'],
                'LOS'               => $row['los'],
                'FGM'               => $row['fgm'],
                'FGA'               => $row['fga'],
                'TPM'               => $row['tpm'],
                'TPA'               => $row['tpa'],
                'FTM'               => $row['ftm'],
                'FTA'               => $row['fta'],
                'ORB'               => $row['orb'],
                'PF'                => $row['pf'],
                'ML'                => $row['ml'],
                'headline'          => $row['headline'] ?: 0,
                'updated_user_id'   => User::find($row['updated_user_id']) ? $row['updated_user_id'] : null,
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

            $match->playerStats_state = $match->checkPlayerStats();
            $match->save();
            event(new TableWasUpdated($match, 'update', $match->toJson(JSON_PRETTY_PRINT), $before));

            return $reg;
        }
    }
}
