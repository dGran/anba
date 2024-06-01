<?php

namespace App\Imports;

use App\Models\Team;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Events\TableWasUpdated;

class TeamsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Team::where('name', $row['name'])->exists()) {
            $reg = Team::create([
                'name'           => $row['name'],
                'medium_name'    => $row['medium_name'],
                'short_name'     => $row['short_name'],
                'division_id'    => Division::find($row['division_id']) ? $row['division_id'] : null,
                'manager_id'     => User::find($row['manager_id']) ? $row['manager_id'] : null,
                'img'            => $row['img'],
                'stadium'        => $row['stadium'],
                'color'          => $row['color'],
                'active'         => $row['active'],
                'slug'           => Str::slug($row['name'], '-')
            ]);
            if ($reg->user) {
                $reg->user->assignRole('manager');
            }
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

            return $reg;
        }
    }
}
