<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Season;

class SeasonService
{
    public function hasPlayIn(Season $season): bool
    {
        return $season->getPlayInStart() !== null && $season->getPlayInEnd() !== null;
    }
}
