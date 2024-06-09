<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\SeasonConferenceManager;
use App\Models\Season;

class StandingService
{
    public const TABLE_TYPE_CONFERENCE = 'conference';

    public const TABLE_ORDER_WAVG = 'wavg';

    private SeasonConferenceManager $seasonConferenceManager;

    public function __construct(SeasonConferenceManager $seasonConferenceManager)
    {
        $this->seasonConferenceManager = $seasonConferenceManager;
    }

    public function getTablePositions(Season $currentSeason): array
    {
        $seasonConferences = $this->seasonConferenceManager->findBySeasonId($currentSeason->id);
        $tablePositionsIndexedByConferenceName = [];

        foreach ($seasonConferences as $conference) {
            $tablePositionsIndexedByConferenceName[$conference->name] = $currentSeason->generateTable(
                self::TABLE_TYPE_CONFERENCE,
                self::TABLE_ORDER_WAVG,
                $conference->id,
                null
            );
        }

        return $tablePositionsIndexedByConferenceName;
    }
}
