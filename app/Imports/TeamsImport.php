<?php

namespace App\Imports;

use App\Models\Team;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;

class TeamsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $team = Team::create([
           'name'       => $row['name'],
           'stadium'    => $row['stadium'],
           'created_at' => $row['created_at'],
           'updated_at' => $row['updated_at'],
           'slug'       => Str::slug($row['name'], '-')
        ]);
        return $team;
    }
}
