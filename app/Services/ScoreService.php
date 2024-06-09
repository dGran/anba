<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MatchModel;

class ScoreService
{
    private const DEFAULT_SCORE = '-';

    private MatchService $matchService;

    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    /**
     * @return array{local_score: int, visitor_score: int}
     */
    public function getMatchTotalScores(MatchModel $match): array
    {
        $localScore = 0;
        $visitorScore = 0;

        foreach ($match->scores as $matchScore) {
            $localScore += $matchScore->local_score;
            $visitorScore += $matchScore->visitor_score;
        }

        return [
            'local_score' => $localScore,
            'visitor_score' => $visitorScore,
        ];
    }

    public function getMatchLocalScore(MatchModel $match): int|string
    {
        if (!$this->matchService->isPlayed($match)) {
            return self::DEFAULT_SCORE;
        }

        return $this->getMatchTotalScores($match)['local_score'];
    }

    public function getMatchVisitorScore(MatchModel $match): int|string
    {
        if (!$this->matchService->isPlayed($match)) {
            return self::DEFAULT_SCORE;
        }

        return $this->getMatchTotalScores($match)['visitor_score'];
    }

}
