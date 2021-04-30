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
            $regs = Score::where('match_id', $match->id)->get();
            foreach ($regs as $reg) {
                event(new TableWasUpdated($reg, 'delete'));
                $reg->delete();
            }
            $reg = Score::create([
                'match_id'                  => $row['match_id'],
                'seasons_scores_headers_id' => $row['seasons_scores_headers_id'],
                'local_score'               => $row['local_score'] ?: 0,
                'visitor_score'             => $row['visitor_score'] ?: 0,
                'order'                     => $row['order'] ?: 1,
                'updated_user_id'           => User::find($row['updated_user_id']) ? $row['updated_user_id'] : null,
                'created_at'                => $row['created_at'] ?: now(),
                'updated_at'                => $row['updated_at'] ?: now(),
            ]);
            event(new TableWasUpdated($reg, 'insert', $reg->toJson(JSON_PRETTY_PRINT), 'Registro importado'));
            if ($row['local_score'] > 0 && $row['visitor_score'] > 0) {
                $match = Match::find($row['match_id']);
                $before = $match->toJson(JSON_PRETTY_PRINT);
                $match->played = 1;
                $match->save();
                event(new TableWasUpdated($match, 'update', $match->toJson(JSON_PRETTY_PRINT), $before));
            }
            return $reg;
        }
    }
}
