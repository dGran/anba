<?php

namespace App\Imports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;

class TeamsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $Team = Team::create([
           'name'     => $row['name'],
           'img'      => $row['img'],
           'stadium'  => $row['stadium'],
           'created_at' => $row['created_at'],
           'updated_at' => $row['updated_at'],
        ]);
        return $user;
    }
}
