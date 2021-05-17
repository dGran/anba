<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Season;
use App\Models\Match;
use App\Models\SeasonTeam;
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
        if ($row['id'] == null) {
            if ($season = Season::find($row['season_id'])) {
                $local_team = SeasonTeam::where('season_id', $season->id)->where('id', $row['local_team_id'])->get();
                $visitor_team = SeasonTeam::where('season_id', $season->id)->where('id', $row['visitor_team_id'])->get();

                if ($local_team->count() > 0 && $visitor_team->count() > 0) {
                    $stadium = $local_team->first()->team->stadium;

                    $reg = Match::create([
                        'season_id'          => $row['season_id'],
                        'clash_id'           => $row['clash_id'],
                        'local_team_id'      => $row['local_team_id'],
                        'local_manager_id'   => User::find($row['local_manager_id']) ? $row['local_manager_id'] : null,
                        'visitor_team_id'    => $row['visitor_team_id'],
                        'visitor_manager_id' => User::find($row['visitor_manager_id']) ? $row['visitor_manager_id'] : null,
                        'stadium'            => $row['stadium'] ?: $stadium,
                        'extra_times'        => 0,
                        'played'             => 0,
                        'teamStats_state'    => 'error',
                        'playerStats_state'  => 'error',
                    ]);
                    event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
                    return $reg;
                }
            }
        } else {
            if ($reg = Match::find($row['id'])) {
                $before = $reg->toJson(JSON_PRETTY_PRINT);
                $local_team = SeasonTeam::where('season_id', $reg->season_id)->where('id', $row['local_team_id'])->get();
                $visitor_team = SeasonTeam::where('season_id', $reg->season_id)->where('id', $row['visitor_team_id'])->get();

                if ($local_team->count() > 0 && $visitor_team->count() > 0) {
                    $stadium = $local_team->first()->team->stadium;

                    $reg->update([
                        'local_team_id'      => $row['local_team_id'],
                        'local_manager_id'   => User::find($row['local_manager_id']) ? $row['local_manager_id'] : null,
                        'visitor_team_id'    => $row['visitor_team_id'],
                        'visitor_manager_id' => User::find($row['visitor_manager_id']) ? $row['visitor_manager_id'] : null,
                        'stadium'            => $row['stadium'] ?: $stadium,
                    ]);

                    event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT), $before));
                    return $reg;
                }
            }
        }

    }
}
