<?php

namespace App\Imports;

use App\Models\Injury;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Events\TableWasUpdated;

class InjuriesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Injury::where('name', $row['name'])->exists()) {
            $reg = Injury::create([
                'name'          => $row['name'],
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

            return $reg;
        }
    }
}
