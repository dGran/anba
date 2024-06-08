<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\SeasonDivision;

class SeasonDivisionRepository
{
    public function findOneById(int $seasonDivisionId): ?SeasonDivision
    {
        return SeasonDivision::find($seasonDivisionId);
    }
}
