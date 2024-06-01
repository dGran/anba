<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\MatchModel;
use App\Models\Statement;
use App\Models\Transfer;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Events\TableWasUpdated;

class PostsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Post::where('title', $row['title'])->exists()) {
            $reg = Post::create([
                'type'           => $row['type'],
                'category'       => $row['category'],
                'title'          => $row['title'],
                'description'    => $row['description'],
                'img'            => $row['img'],
                'match_id'       => MatchModel::find($row['match_id']) ? $row['match_id'] : null,
                'statement_id'   => Statement::find($row['statement_id']) ? $row['statement_id'] : null,
                'transfer_id'    => Transfer::find($row['transfer_id']) ? $row['transfer_id'] : null,
                'slug'           => Str::slug($row['title'], '-')
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));

            return $reg;
        }
    }
}
