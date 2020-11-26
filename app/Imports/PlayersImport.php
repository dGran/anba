<?php

namespace App\Imports;

use App\Models\Player;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;

class PlayersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Player::where('name', $row['name'])->exists()) {
            $player = Player::create([
                'name'         => $row['name'],
                'position'     => $row['position'],
                'img'          => $row['img'],
                'height'       => $row['height'],
                'weight'       => $row['weight'],
                'college'      => $row['college'],
                'birthdate'    => $row['birthdate'],
                'nation_name'  => $row['nation_name'],
                'draft_year'   => $row['draft_year'],
                'average'      => $row['average'],
                'slug'         => Str::slug($row['name'], '-')
            ]);
            return $player;
        }
    }
}
