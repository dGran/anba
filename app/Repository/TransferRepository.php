<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Transfer;

class TransferRepository
{
    public function countSeasonTeamUses(int $seasonTeamId): int
    {
        return (int)Transfer::where('season_team_from', $seasonTeamId)
            ->orWhere('season_team_to', $seasonTeamId)
            ->count();
    }
}
