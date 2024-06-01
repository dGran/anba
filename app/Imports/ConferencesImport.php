<?php

namespace App\Imports;

use App\Models\Conference;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Events\TableWasUpdated;

class ConferencesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Conference::where('name', $row['name'])->exists()) {
            $reg = Conference::create([
                'name'         => $row['name'],
                'img'          => $row['img'],
                'active'       => $row['active'],
                'slug'         => Str::slug($row['name'], '-')
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

            return $reg;
        }
    }
}
