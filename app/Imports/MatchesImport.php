<?php

namespace App\Imports;

use App\Models\Match;
use App\Models\SeasonTeam;
use App\Models\User;
use App\Models\Score;
use App\Models\SeasonScoreHeader;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class MatchesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if ($seasonTeam = SeasonTeam::find($row['local_team_id'])) {
            $stadium = $seasonTeam->team->stadium;
        }

        $reg = Match::create([
            'season_id'          => $row['season_id'],
            'round_id'           => $row['round_id'],
            'local_team_id'      => SeasonTeam::find($row['local_team_id']) ? $row['local_team_id'] : null,
            'local_manager_id'   => User::find($row['local_manager_id']) ? $row['local_manager_id'] : null,
            'visitor_team_id'    => SeasonTeam::find($row['visitor_team_id']) ? $row['visitor_team_id'] : null,
            'visitor_manager_id' => User::find($row['visitor_manager_id']) ? $row['visitor_manager_id'] : null,
            'stadium'            => $row['stadium'] ?: $stadium,
            'extra_times'        => $row['extra_times'] ?: 0,
            'played'             => $row['played'] ?: 0,
            'teamStats_state'    => 'error',
            'playerStats_state'    => 'error',
            // 'teamStats_state'    => $row['teamStats_state'] ?: 'error',
            // 'playerStats_state'    => $row['playerStats_state'] ?: 'error',
        ]);
        event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

        $score = Score::create([
            'match_id'                  => $reg->id,
            'seasons_scores_headers_id' => $row['seasons_scores_headers_id'],
            'local_score'               => $row['local_score'] ?: 0,
            'visitor_score'             => $row['visitor_score'] ?: 0,
            'order'                     => 1,
            'updated_user_id'           => User::find($row['updated_user_id']) ? $row['updated_user_id'] : null,
            'created_at'                => $row['fecha'] ?: now(),
            'updated_at'                => $row['fecha'] ?: now(),
        ]);
        event(new TableWasUpdated($score, 'insert', $score->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

        return $reg;
    }
}
