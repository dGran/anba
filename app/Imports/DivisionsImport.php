<?php

namespace App\Imports;

use App\Models\Division;
use App\Models\Conference;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class DivisionsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Division::where('name', $row['name'])->exists()) {
            $reg = Division::create([
                'name'          => $row['name'],
                'conference_id' => Conference::find($row['conference_id']) ? $row['conference_id'] : null,
                'active'        => $row['active'],
                'slug'          => Str::slug($row['name'], '-')
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
            return $reg;
        }
    }
}
