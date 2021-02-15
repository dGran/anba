<?php

namespace App\Imports;

use App\Models\PlayerStat;
use App\Models\Match;
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
        $match = Match::find($row['match_id']);
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
                'MIN'               => $row['min'] == null && $row['min'] !== 0 ? null : $row['min'],
                'PTS'               => $row['pts'] == null && $row['pts'] !== 0 ? null : $row['pts'],
                'REB'               => $row['reb'] == null && $row['reb'] !== 0 ? null : $row['reb'],
                'STL'               => $row['stl'] == null && $row['stl'] !== 0 ? null : $row['stl'],
                'BLK'               => $row['blk'] == null && $row['blk'] !== 0 ? null : $row['blk'],
                'LOS'               => $row['los'] == null && $row['los'] !== 0 ? null : $row['los'],
                'FGM'               => $row['fgm'] == null && $row['fgm'] !== 0 ? null : $row['fgm'],
                'FGA'               => $row['fga'] == null && $row['fga'] !== 0 ? null : $row['fga'],
                'TPM'               => $row['tpm'] == null && $row['tpm'] !== 0 ? null : $row['tpm'],
                'TPA'               => $row['tpa'] == null && $row['tpa'] !== 0 ? null : $row['tpa'],
                'FTM'               => $row['ftm'] == null && $row['ftm'] !== 0 ? null : $row['ftm'],
                'FTA'               => $row['fta'] == null && $row['fta'] !== 0 ? null : $row['fta'],
                'ORB'               => $row['orb'] == null && $row['orb'] !== 0 ? null : $row['orb'],
                'PF'                => $row['pf'] == null && $row['pf'] !== 0 ? null : $row['pf'],
                'ML'                => $row['ml'] == null && $row['ml'] !== 0 ? null : $row['ml'],
                'headline'          => $row['headline'] ?: 0,
                'updated_user_id'   => User::find($row['updated_user_id']) ? $row['updated_user_id'] : null,
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
            return $reg;
        }
    }
}
