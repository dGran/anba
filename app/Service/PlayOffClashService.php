<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\PlayoffClash;
use App\Models\PlayoffRound;
use App\Models\SeasonTeam;

class PlayOffClashService
{
    private const DEFAULT_RESULT = '-';

    private MatchService $matchService;

    private ScoreService $scoreService;

    public function __construct(MatchService $matchService, ScoreService $scoreService)
    {
        $this->matchService = $matchService;
        $this->scoreService = $scoreService;
    }

    /**
     * @return array{local_result: int|string, visitor_result: int|string}
     */
    public function getResult(PlayoffClash $playoffClash): array
    {
        $playoffClashTotalLocalResult = 0;
        $playoffClashTotalVisitorResult = 0;

        $roundMatchesToWin = $playoffClash->round->matches_to_win;

        if ($playoffClash->matches->count() > 0) {
            foreach ($playoffClash->matches as $match) {
                if ($roundMatchesToWin === 1) {
                    return [
                        'local_result' => $this->scoreService->getMatchLocalScore($match),
                        'visitor_result' => $this->scoreService->getMatchVisitorScore($match),
                    ];
                }

                $matchSeasonTeamWinner = $this->matchService->getSeasonTeamWinner($match);

                if ($matchSeasonTeamWinner === null) {
                    continue;
                }

                $matchSeasonTeamWinnerId = $matchSeasonTeamWinner->getId();

                if ($playoffClash->local_team_id === $match->local_team_id) {
                    if ($matchSeasonTeamWinnerId === $playoffClash->local_team_id) {
                        $playoffClashTotalLocalResult++;

                        continue;
                    }

                    $playoffClashTotalVisitorResult++;

                    continue;
                }

                if ($matchSeasonTeamWinnerId === $playoffClash->visitor_team_id) {
                    $playoffClashTotalVisitorResult++;

                    continue;
                }

                $playoffClashTotalLocalResult++;
            }
        }

        if ($playoffClashTotalLocalResult === 0 && $playoffClashTotalVisitorResult === 0) {
            return [
                'local_result' => self::DEFAULT_RESULT,
                'visitor_result' => self::DEFAULT_RESULT
            ];
        }

        return [
            'local_result' => $playoffClashTotalLocalResult,
            'visitor_result' => $playoffClashTotalVisitorResult
        ];
    }

    public function isFinished(PlayoffClash $playoffClash): bool
    {
        $roundMatchesToWin = $playoffClash->round->matches_to_win;
        $playoffClashResult = $this->getResult($playoffClash);

        return (
            $playoffClashResult['local_result'] === $roundMatchesToWin
            || $playoffClashResult['visitor_result'] === $roundMatchesToWin
        );
    }

    public function getNextByPlayOffClash(PlayoffClash $playoffClash): ?PlayoffClash
    {
        $next_round = PlayoffRound::where('playoff_id', $playoffClash->round->playoff->id)->where('order', '>', $playoffClash->round->order)->orderBy('order', 'asc')->first();

        if ($next_round) {
            return PlayoffClash::where('round_id', $next_round->id)->where('order', $playoffClash->destiny_clash)->first();
        }

        return null;
    }

    public function generateNextClass(PlayoffClash $clash, PlayoffClash $nextClash, int $seasonId, int $localRecord, int $visitorRecord): void
    {
        if ($clash->destiny_clash_local) {
            $nextClash->local_team_id = $clash->winner()->id;
            $nextClash->local_manager_id = $clash->winner()->team->user->id;
            $nextClash->regular_position_local = $clash->winner() && $clash->winner()->id == $clash->local_team_id ? $localRecord : $visitorRecord;
        }

        if (!$clash->destiny_clash_local) {
            $nextClash->visitor_team_id = $clash->winner()->id;
            $nextClash->visitor_manager_id = $clash->winner()->team->user->id;
            $nextClash->regular_position_visitor = $clash->winner() && $clash->winner()->id == $clash->local_team_id ? $localRecord : $visitorRecord;
        }

        $nextClash->save();

        if ($this->hasAllParticipants($nextClash)) {
            $this->matchService->generateFirstMatchByPlayOffClash($nextClash, $seasonId);
        }
    }

    public function getSeasonTeamWinner(PlayoffClash $playoffClash): SeasonTeam
    {
        $result = $this->getResult($playoffClash);

        if ($result['local_result'] > $result['visitor_result']) {
            return $playoffClash->localTeam;
        }

        return $playoffClash->visitorTeam;
    }

    public function getSeasonTeamLoser(PlayoffClash $playoffClash): SeasonTeam
    {
        $result = $this->getResult($playoffClash);

        if ($result['local_result'] < $result['visitor_result']) {
            return $playoffClash->localTeam;
        }

        return $playoffClash->visitorTeam;
    }

    private function hasAllParticipants(PlayoffClash $playoffClash): bool
    {
        return $playoffClash->local_team_id && $playoffClash->visitor_team_id;
    }
}
