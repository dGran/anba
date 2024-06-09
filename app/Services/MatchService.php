<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MatchModel;
use App\Models\PlayerStat;
use App\Models\PlayoffClash;
use App\Models\Score;
use App\Models\SeasonTeam;
use App\Models\TeamStat;
use Illuminate\Support\Collection;

class MatchService
{
    private ?int $userId = null;

    private PlayOffClashService $playOffClashService;

    private PostService $postService;

    private ScoreService $scoreService;

    public function __construct(PlayOffClashService $playOffClashService, PostService $postService, ScoreService $scoreService)
    {
        $this->playOffClashService = $playOffClashService;
        $this->postService = $postService;
        $this->scoreService = $scoreService;

        $user = auth()->user();

        if ($user) {
            $this->userId = $user->id;
        }
    }

    public function isClash(MatchModel $match): bool
    {
        if ($match->clash()) {
            return true;
        }

        return false;
    }

    public function storeResult(Collection $scores, MatchModel $match, int $extraTimes): void
    {
        foreach ($scores as $key => $score) {
            $order = $key + 1;
            Score::create([
                'match_id' => $match->getId(),
                'seasons_scores_headers_id' => $score['seasons_scores_headers_id'],
                'local_score' => $score['local_score'],
                'visitor_score' => $score['visitor_score'],
                'order' => $order,
                'updated_user_id' => $this->userId,
            ]);
        }

        $match->extra_times = $extraTimes;
        $match->played = $this->isPlayed($match);

        $match->save();
    }

    public function handleReportClashResult(MatchModel $match): void
    {
        if (!$this->isClash($match)) {
            return;
        }

        $playoffClash = $match->clash;
        $season = $playoffClash->round->playoff->season;
        $seasonId = $season->getId();
        $localRecord = $season->get_table_data_team_record($playoffClash->local_team_id)['w'];
        $visitorRecord = $season->get_table_data_team_record($playoffClash->visitor_team_id)['w'];

        //TODO: revisar los métodos del postService, mejorar y ampliar con los nuevos casos
        $this->postService->createFromPlayOffClash($playoffClash->match);

        if (!$this->playOffClashService->isFinished($playoffClash)) {
            //TODO: ampliar los nuevos casos de generar clashes siguientes tantos de ganador como de perdedor de la eliminatoria
            $this->generateNextMatchByPlayOffClash($playoffClash, $seasonId, $localRecord, $visitorRecord);

            return;
        }

        $nextClash = $this->playOffClashService->getNextByPlayOffClash($playoffClash);

        if ($nextClash !== null) {
            $this->playOffClashService->generateNextClass($playoffClash, $nextClash, $seasonId, $localRecord, $visitorRecord);
        }
    }

    public function generateFirstMatchByPlayOffClash(PlayoffClash $playoffClash, int $seasonId): void
    {
        MatchModel::create([
            'season_id' 		 => $seasonId,
            'clash_id' 			 => $playoffClash->id,
            'local_team_id' 	 => $playoffClash->regular_position_local >= $playoffClash->regular_position_visitor ? $playoffClash->local_team_id : $playoffClash->visitor_team_id,
            'local_manager_id' 	 => $playoffClash->regular_position_local >= $playoffClash->regular_position_visitor ? $playoffClash->localTeam->team->user->id : $playoffClash->visitorTeam->team->user->id,
            'visitor_team_id' 	 => $playoffClash->regular_position_local >= $playoffClash->regular_position_visitor ? $playoffClash->visitor_team_id : $playoffClash->local_team_id,
            'visitor_manager_id' => $playoffClash->regular_position_local >= $playoffClash->regular_position_visitor ? $playoffClash->visitorTeam->team->user->id : $playoffClash->localTeam->team->user->id,
            'stadium' 			 => $playoffClash->regular_position_local >= $playoffClash->regular_position_visitor ? $playoffClash->localTeam->team->stadium : $playoffClash->visitorTeam->team->stadium,
            'extra_times' 		 => 0,
            'played' 			 => 0,
            'teamStats_state' 	 => 'error',
            'playerStats_state'  => 'error'
        ]);
    }

    public function isPlayed(MatchModel $match): bool
    {
        if ($match->scores->count() === 0) {
            return false;
        }

        $matchTotalScores = $this->scoreService->getMatchTotalScores($match);

        return $matchTotalScores['local_score'] > 0 && $matchTotalScores['visitor_score'] > 0;
    }

    public function getSeasonTeamWinner(MatchModel $match): ?SeasonTeam
    {
        if (!$this->isPlayed($match)) {
            return null;
        }

        $matchTotalScores = $this->scoreService->getMatchTotalScores($match);

        if ($matchTotalScores['local_score'] === $matchTotalScores['visitor_score']) {
            return null;
        }

        return $matchTotalScores['local_score'] > $matchTotalScores['visitor_score'] ? $match->localTeam : $match->visitorTeam;
    }

    public function getSeasonTeamLoser(MatchModel $match): ?SeasonTeam
    {
        if (!$this->isPlayed($match)) {
            return null;
        }

        $matchTotalScores = $this->scoreService->getMatchTotalScores($match);

        if ($matchTotalScores['local_score'] < $matchTotalScores['visitor_score']) {
            return $match->localTeam;
        }

        return $match->visitorTeam;
    }

    public function getFormattedScore(MatchModel $match)
    {
        if ($this->isPlayed($match)) {
            $local = null;
            $visitor = null;

            foreach ($this->scores as $score) {
                $local += $score->local_score;
                $visitor += $score->visitor_score;
            }

            return $local.' - '.$visitor;
        }

        return '-';
    }

    private function generateNextMatchByPlayOffClash(PlayoffClash $playoffClash, int $seasonId, int $localRecord, int $visitorRecord): void
    {
        $order = MatchModel::where('clash_id', $playoffClash->id)->count() + 1;
        $matchData = $this->getNextMatchDataByPlayOffClash($playoffClash, $order, $localRecord, $visitorRecord);

        MatchModel::create([
            'season_id' 		 => $seasonId,
            'clash_id' 			 => $playoffClash->getId(),
            'local_team_id' 	 => $matchData['local_team_id'],
            'local_manager_id' 	 => $matchData['local_manager_id'],
            'visitor_team_id' 	 => $matchData['visitor_team_id'],
            'visitor_manager_id' => $matchData['visitor_manager_id'],
            'stadium' 			 => $matchData['stadium'],
            'extra_times' 		 => 0,
            'played' 			 => 0,
            'teamStats_state' 	 => TeamStat::STATE_ERROR,
            'playerStats_state'  => PlayerStat::STATE_ERROR,
            'order'				 => $order
        ]);
    }

    /**
     * @return array{local_team_id: int, local_manager_id: int, visitor_team_id: int, visitor_manager_id: int, stadium: string}
     */
    private function getNextMatchDataByPlayOffClash(PlayoffClash $playoffClash, int $order, int $localRecord, int $visitorRecord): array
    {
        $roundMatchesToWin = $playoffClash->round->matches_to_win;

        switch ($roundMatchesToWin) {
            case 3:
                switch ($order) {
                    case 1:
                    case 2:
                    case 5:
                        $localTeamId = $localRecord >= $visitorRecord ? $playoffClash->local_team_id : $playoffClash->visitor_team_id;
                        $localManagerId = $localRecord >= $visitorRecord ? $playoffClash->localTeam->team->user->id : $playoffClash->visitorTeam->team->user->id;
                        $visitorTeamId = $localRecord >= $visitorRecord ? $playoffClash->visitor_team_id : $playoffClash->local_team_id;
                        $visitorManagerId = $localRecord >= $visitorRecord ? $playoffClash->visitorTeam->team->user->id : $playoffClash->localTeam->team->user->id;
                        $stadium = $localRecord >= $visitorRecord ? $playoffClash->localTeam->team->stadium : $playoffClash->visitorTeam->team->stadium;

                        break;
                    case 3:
                    case 4:
                        $localTeamId = $localRecord >= $visitorRecord ? $playoffClash->visitor_team_id : $playoffClash->local_team_id;
                        $localManagerId = $localRecord >= $visitorRecord ? $playoffClash->visitorTeam->team->user->id : $playoffClash->localTeam->team->user->id;
                        $visitorTeamId = $localRecord >= $visitorRecord ? $playoffClash->local_team_id : $playoffClash->visitor_team_id;
                        $visitorManagerId = $localRecord >= $visitorRecord ? $playoffClash->localTeam->team->user->id : $playoffClash->visitorTeam->team->user->id;
                        $stadium = $localRecord >= $visitorRecord ? $playoffClash->visitorTeam->team->stadium : $playoffClash->localTeam->team->stadium;

                        break;
                }
                break;
            case 4:
                switch ($order) {
                    case 1:
                    case 2:
                    case 5:
                    case 7:
                        $localTeamId = $localRecord >= $visitorRecord ? $playoffClash->local_team_id : $playoffClash->visitor_team_id;
                        $localManagerId = $localRecord >= $visitorRecord ? $playoffClash->localTeam->team->user->id : $playoffClash->visitorTeam->team->user->id;
                        $visitorTeamId = $localRecord >= $visitorRecord ? $playoffClash->visitor_team_id : $playoffClash->local_team_id;
                        $visitorManagerId = $localRecord >= $visitorRecord ? $playoffClash->visitorTeam->team->user->id : $playoffClash->localTeam->team->user->id;
                        $stadium = $localRecord >= $visitorRecord ? $playoffClash->localTeam->team->stadium : $playoffClash->visitorTeam->team->stadium;

                        break;
                    case 3:
                    case 4:
                    case 6:
                        $localTeamId = $localRecord >= $visitorRecord ? $playoffClash->visitor_team_id : $playoffClash->local_team_id;
                        $localManagerId = $localRecord >= $visitorRecord ? $playoffClash->visitorTeam->team->user->id : $playoffClash->localTeam->team->user->id;
                        $visitorTeamId = $localRecord >= $visitorRecord ? $playoffClash->local_team_id : $playoffClash->visitor_team_id;
                        $visitorManagerId = $localRecord >= $visitorRecord ? $playoffClash->localTeam->team->user->id : $playoffClash->visitorTeam->team->user->id;
                        $stadium = $localRecord >= $visitorRecord ? $playoffClash->visitorTeam->team->stadium : $playoffClash->localTeam->team->stadium;

                        break;
                }
                break;
            default:
                break;
        }

        return [
            'local_team_id' => $localTeamId ?? null,
            'local_manager_id' => $localManagerId ?? null,
            'visitor_team_id' => $visitorTeamId ?? null,
            'visitor_manager_id' => $visitorManagerId ?? null,
            'stadium' => $stadium ?? null,
        ];
    }
}
