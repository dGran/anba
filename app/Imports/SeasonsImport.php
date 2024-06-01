<?php

namespace App\Imports;

use App\Models\Season;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Events\TableWasUpdated;

class SeasonsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Season::where('name', $row['name'])->exists()) {
            $reg = Season::create([
                'name'                  => $row['name'],
                'direct_playoffs_start' => $row['direct_playoffs_start'],
                'direct_playoffs_end'   => $row['direct_playoffs_end'],
                'play_in_start'         => $row['play_in_start'],
                'play_in_end'           => $row['play_in_end'],
                'current'               => $row['current'] ?: 0,
                'slug'                  => Str::slug($row['name'], '-')
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

            return $reg;
        }
    }
}
