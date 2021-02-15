<?php

namespace App\Imports;

use App\Models\Score;
use App\Models\Match;
use App\Models\SeasonScoreHeader;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use App\Events\TableWasUpdated;

class MatchesScoresImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $match = Match::find($row['match_id']);
        $score_header = SeasonScoreHeader::find($row['seasons_scores_headers_id']);
        if ($match && $score_header) {
            $match->scores()->delete();
            $reg = Score::create([
                'match_id'                  => $row['match_id'],
                'seasons_scores_headers_id' => $row['seasons_scores_headers_id'],
                'local_score'               => $row['local_score'] ?: 0,
                'visitor_score'             => $row['visitor_score'] ?: 0,
                'order'                     => $row['order'] ?: 1,
                'updated_user_id'           => User::find($row['updated_user_id']) ? $row['updated_user_id'] : null,
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
            return $reg;
        }
    }
}
