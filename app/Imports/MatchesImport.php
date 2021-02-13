<?php

namespace App\Imports;

use App\Models\Match;
use App\Models\SeasonTeam;
use App\Models\User;
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
        $reg = Match::create([
            'season_id'          => $row['season_id'],
            'round_id'           => $row['round_id'],
            'local_team_id'      => SeasonTeam::find($row['local_team_id']) ? $row['local_team_id'] : null,
            'local_manager_id'   => User::find($row['local_manager_id']) ? $row['local_manager_id'] : null,
            'visitor_team_id'    => SeasonTeam::find($row['visitor_team_id']) ? $row['visitor_team_id'] : null,
            'visitor_manager_id' => User::find($row['visitor_manager_id']) ? $row['visitor_manager_id'] : null,
            'stadium'            => $row['stadium'],
            'extra_times'        => $row['extra_times'] ?: 0,
        ]);
        event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
        return $reg;
    }
}
