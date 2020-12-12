<?php

namespace App\Imports;

use App\Models\Season;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class SeasonsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Season::where('name', $row['name'])->exists()) {
            $reg = Season::create([
                'name'          => $row['name'],
                'current'       => $row['current'] ?: 0,
                'slug'          => Str::slug($row['name'], '-')
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
            return $reg;
        }
    }
}
