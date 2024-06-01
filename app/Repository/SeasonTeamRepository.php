<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\SeasonTeam;

class SeasonTeamRepository
{
    public function findOneById(int $id): ?SeasonTeam
    {
        return SeasonTeam::find($id);
    }
}
