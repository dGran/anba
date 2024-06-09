<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\MatchPollManager;

class MatchPollService
{
    private const VOTE_LOCAL = 'local';

    private const VOTE_VISITOR = 'visitor';

    private MatchPollManager $matchPollManager;

    public function __construct(MatchPollManager $matchPollManager)
    {
        $this->matchPollManager = $matchPollManager;
    }

    /**
     * @return array{local: int, visitor: int}
     */
    public function getByMatchId(int $matchId): array
    {
        $pollVotes = $this->matchPollManager->findByMatchId($matchId);

        if ($pollVotes->isEmpty()) {
            return [];
        }

        $local = 0;
        $visitor = 0;

        foreach ($pollVotes as $pollVote) {
            if ($pollVote->vote === self::VOTE_LOCAL) {
                $local++;

                continue;
            }

            $visitor++;
        }

        return [
            'local' => $local,
            'visitor' => $visitor,
        ];
    }
}
