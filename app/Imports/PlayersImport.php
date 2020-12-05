<?php

namespace App\Imports;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class PlayersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Player::where('name', $row['name'])->exists()) {
            $reg = Player::create([
                'name'         => $row['name'],
                'nickname'     => $row['nickname'],
                'team_id'      => Team::find($row['team_id']) ? $row['team_id'] : null,
                'img'          => $row['img'],
                'position'     => $row['position'],
                'height'       => $row['height'],
                'weight'       => $row['weight'],
                'college'      => $row['college'],
                'birthdate'    => $row['birthdate'],
                'nation_name'  => $row['nation_name'],
                'draft_year'   => $row['draft_year'],
                'average'      => $row['average'],
                'retired'      => $row['retired'] ?: 0,
                'slug'         => Str::slug($row['name'], '-')
            ]);
            event(new TableWasUpdated($reg, 'update', $reg->toJson(JSON_PRETTY_PRINT)));
            return $reg;
        }
    }
}
