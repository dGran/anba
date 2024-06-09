<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\PostStored;
use App\Managers\MatchPollManager;
use App\Managers\PlayOffRoundManager;
use App\Models\MatchModel;
use App\Models\PlayoffClash;
use App\Models\PlayoffRound;
use App\Traits\PostTrait;

class PostService
{
    use PostTrait;

    public const POST_TYPE_GENERAL = 'general';

    public const POST_TYPE_FEATURED = 'destacados';

    public const POST_TYPE_RESULTS = 'resultados';

    public const POST_TYPE_INJURIES = 'lesiones';

    private MatchService $matchService;

    private PlayOffClashService $playoffClashService;

    private PlayOffRoundManager $playoffRoundManager;

    private MatchPollManager $matchPollManager;

    private MatchPollService $matchPollService;

    public function __construct(
        MatchService $matchService,
        PlayOffClashService $playoffClashService,
        PlayOffRoundManager $playoffRoundManager,
        MatchPollManager $matchPollManager,
        MatchPollService $matchPollService
    ) {
        $this->matchService = $matchService;
        $this->playoffClashService = $playoffClashService;
        $this->playoffRoundManager = $playoffRoundManager;
        $this->matchPollManager = $matchPollManager;
        $this->matchPollService = $matchPollService;
    }

    public function createFromPlayOffClash(MatchModel $match): void
    {
        if (!$this->matchService->isPlayed($match)) {
            return;
        }

        $this->createClashResultPost($match);
        $this->createFeaturedPost($match);
        $this->createClashFeaturedPost($match);
    }

    private function createClashResultPost($match): void
    {
        $playoffClash = $match->getClash();
        $matchesToWin = $playoffClash->round->matches_to_win;

        $playoffClashLocalTeamShortName = $playoffClash->localTeam->team->short_name;
        $playoffClashVisitorTeamShortName = $playoffClash->visitorTeam->team->short_name;
        $playoffClashResult = $this->playoffClashService->getResult($playoffClash);
        $playoffClashLocalResult = $playoffClashResult['local_result'];
        $playoffClashVisitorResult = $playoffClashResult['visitor_result'];
        $conferenceName = $playoffClash->round->playoff->seasonConference->conference->name;

        if ($this->playoffClashService->isFinished($playoffClash)) {
            $nextRound = $this->playoffRoundManager->getNextRoundByPlayfoffClash($playoffClash);
            $seasonTeamWinner = $this->playoffClashService->getSeasonTeamWinner($playoffClash);
            $winnerTeamMediumName = $seasonTeamWinner->team->medium_name;
            $seasonTeamLoser = $this->playoffClashService->getSeasonTeamLoser($playoffClash);
            $loserTeamMediumName = $seasonTeamLoser->team->medium_name;

            if ($nextRound) {
                $nextRoundName = $nextRound->getName();

                if ($matchesToWin > 1) {
                    $description = 'Con una nueva victoria, los '.$winnerTeamMediumName.' eliminan a los '.$loserTeamMediumName.' y avanzan a la siguiente ronda, '.$nextRoundName;
                    $this->storeClashResultPost($description, $match, $playoffClash);

                    return;
                }

                $description = $winnerTeamMediumName.' eliminan a los '.$loserTeamMediumName.' y avanzan a la siguiente ronda, '.$nextRoundName;
                $this->storeClashResultPost($description, $match, $playoffClash);

                return;
            }

            $playinPlace = $playoffClash->round->playoff->playin_place;

            if ($playinPlace) {
                if ($nextRound === null) {
                    $description = 'Los '.$winnerTeamMediumName.' consiguen la '.$playinPlace.'ª plaza de la conferencia '.$conferenceName.' al imponerse a los '.$loserTeamMediumName;
                    $this->storeClashResultPost($description, $match, $playoffClash);

                    return;
                }

                $description = 'Los '.$winnerTeamMediumName.' avanzan a la siguiente roda por la '.$playinPlace.'ª plaza de la conferencia '.$conferenceName.' al imponerse a los '.$loserTeamMediumName;
                $this->storeClashResultPost($description, $match, $playoffClash);

                return;
            }

            $description = '¡Campeones! Los '.$winnerTeamMediumName.' han logrado el anillo de ANBA al imponerse a los '.$loserTeamMediumName;
            $this->storeClashResultPost($description, $match, $playoffClash);

            return;
        }

        $matchSeasonTeamWinner = $this->matchService->getSeasonTeamWinner($match);
        $matchSeasonTeamLoser = $this->matchService->getSeasonTeamLoser($match);

        if ($matchSeasonTeamWinner === null || $matchSeasonTeamLoser === null) {
            return;
        }

        $winnerTeamMediumName = $matchSeasonTeamWinner->team->medium_name;
        $loserTeamMediumName = $matchSeasonTeamLoser->team->medium_name;

        if ($matchSeasonTeamWinner->getId() === $playoffClash->getLocalSeasonTeamId()) {
            if ($playoffClashLocalResult > $playoffClashVisitorResult) {
                if ($playoffClashLocalResult > $playoffClashVisitorResult + 1) {
                    $description = 'Los '.$winnerTeamMediumName.' amplían su ventaja en la serie contra los '.$loserTeamMediumName.', '.$playoffClashLocalTeamShortName.' '.$playoffClashLocalResult.' - '.$playoffClashVisitorResult.' '.$playoffClashVisitorTeamShortName;
                    $this->storeClashResultPost($description, $match, $playoffClash);

                    return;
                }

                $description = "Victoria de los " . $winnerTeamMediumName . " que toman ventaja en la serie frente a " . $loserTeamMediumName . ", " . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
                $this->storeClashResultPost($description, $match, $playoffClash);

                return;
            }

            if ($playoffClashLocalResult === $playoffClashVisitorResult) {
                $description = "Los " . $winnerTeamMediumName . " vencen y empatan la eliminatoria con los " . $loserTeamMediumName . " a " . $playoffClashLocalResult . ', ' . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
                $this->storeClashResultPost($description, $match, $playoffClash);

                return;
            }

            if ($playoffClashVisitorResult > $playoffClashLocalResult) {
                $description = "Victoria de los " . $winnerTeamMediumName . " que recortan la ventaja en la serie de los " . $loserTeamMediumName . ", " . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
                $this->storeClashResultPost($description, $match, $playoffClash);

                return;
            }
        }

        if ($playoffClashVisitorResult > $playoffClashLocalResult) {
            if ($playoffClashVisitorResult > $playoffClashLocalResult + 1) {
                $description = "Los " . $winnerTeamMediumName . " amplían su ventaja en la serie contra los " . $loserTeamMediumName . ", " . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
                $this->storeClashResultPost($description, $match, $playoffClash);

                return;
            }

            $description = "Victoria de los " . $winnerTeamMediumName . " que toman ventaja en la serie frente a " . $loserTeamMediumName . ", " . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
            $this->storeClashResultPost($description, $match, $playoffClash);

            return;
        }

        if ($playoffClashLocalResult === $playoffClashVisitorResult) {
            $description = "Los " . $winnerTeamMediumName . " vencen y empatan la eliminatoria con los " . $loserTeamMediumName . " a " . $playoffClashLocalResult . ', ' . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
            $this->storeClashResultPost($description, $match, $playoffClash);

            return;
        }

        if ($playoffClashLocalResult > $playoffClashVisitorResult) {
            $description = "Victoria de los " . $winnerTeamMediumName . " que recortan la ventaja en la serie de los " . $loserTeamMediumName . ", " . $playoffClashLocalTeamShortName . ' ' . $playoffClashLocalResult . ' - ' . $playoffClashVisitorResult . ' ' . $playoffClashVisitorTeamShortName;
            $this->storeClashResultPost($description, $match, $playoffClash);
        }
    }

    private function storeClashResultPost(string $description, MatchModel $match, PlayoffClash $playoffClash): void
    {
        $playoffName = $playoffClash->round->playoff->name;
        $roundName = $playoffClash->round->name;
        $matchLocalTeam = $match->localTeam->team;
        $matchVisitorTeam = $match->visitorTeam->team;
        $formattedScore = $this->matchService->getFormattedScore($match);

        $post = $this->storePost(
            self::POST_TYPE_RESULTS,
            $playoffName.' | '.$roundName.' | '.$matchLocalTeam->short_name.' | '.$matchVisitorTeam->short_name,
            $matchLocalTeam->medium_name.'  '.$formattedScore.'  '.$matchVisitorTeam->medium_name,
            $description.'.',
            null,
            $match->id
        );

        event(new PostStored($post));
    }

    //TODO: voy por aquí

    private function createFeaturedPost($match): void
    {
        $matchId = $match->getId();
        $countMatchVotes = $this->matchPollManager->countByMatchId($matchId);
        $seasonTeamWinner = $this->matchService->getSeasonTeamWinner($match);
        $seasonTeamLoser = $this->matchService->getSeasonTeamLoser($match);

        if ($seasonTeamWinner === null || $seasonTeamLoser === null) {
            return;
        }

        if ($countMatchVotes > 4) {
            $matchVotes = $this->matchPollService->getByMatchId($matchId);
            $localVotes = ($matchVotes['local'] / $countMatchVotes) * 100;
            $visitorVotes = ($matchVotes['visitor'] / $countMatchVotes) * 100;

            if (
                ($localVotes <= 20 && $match->localTeam === $seasonTeamWinner)
                || ($visitorVotes <= 20 && $match->visitorTeam === $seasonTeamWinner)
            ) {
                $descriptions = [
                    $seasonTeamWinner->team->name . ' dan la sorpresa al imponerse a ' . $seasonTeamLoser->team->name,
                    $seasonTeamLoser->team->name . ' cayó de forma inesperada frente a ' . $seasonTeamWinner->team->name
                ];
                $randomIndex = \random_int(0,1);
                $description = $descriptions[$randomIndex].'.';

                $post = $this->storePost(
                    self::POST_TYPE_FEATURED,
                    'pronósticos'.' | '.$seasonTeamWinner->team->short_name,
                    'Los '.$seasonTeamWinner->getTeam()->medium_name.' contra todo pronóstico',
                    $description,
                    $seasonTeamWinner->getTeam()->getImg(),
                    $match->id,
                    null,
                    null,
                    null,
                    $seasonTeamWinner->getTeam()->id
                );

                event(new PostStored($post));
            }
        }
    }

    //TODO: voy por aquí - ampliar test unitarios
    protected function createClashFeaturedPost($match)
    {
        $playoffClash = PlayoffClash::find($match->clash_id);
        $title = null;
        $description = null;

        if ($this->playoffClashService->isFinished($playoffClash)) {
            // clash finished
            $next_round = PlayoffRound::where('playoff_id', $playoffClash->round->playoff->id)->where('order', '>', $playoffClash->round->order)->orderBy('order', 'asc')->first();
            if ($next_round) {
                $title = $playoffClash->winner()->team->medium_name . ' (' . $playoffClash->winner()->team->user->name . ') ' . ' clasificados para ' . $next_round->name;
                $nextClash = $playoffClash->nextClash();
                if ($playoffClash->winner() && $playoffClash->winner()->id === $nextClash->local_team_id) {
                    $rival = $nextClash->visitorTeam;
                } else {
                    $rival = $nextClash->localTeam;
                }
                if ($rival) {
                    $description = "Se enfrentarán a los " . $rival->team->medium_name . " de " . $rival->team->user->name;
                } else {
                    $description = "Quedan a la espera de rival";
                }
            } else {
                if (!$playoffClash->round->playoff->playin_place) {
                    $title = '¡' . $playoffClash->winner()->team->medium_name . ' (' . $playoffClash->winner()->team->user->name . ') ' . ' campeones de ANBA!';
                    $description = "Tras derrotar en la final a los " . $playoffClash->loser()->team->medium_name . " de " . $playoffClash->loser()->team->user->name . ". Enhorabuena por el anillo!";
                } else {
                    $title = '¡' . $playoffClash->winner()->team->medium_name . ' (' . $playoffClash->winner()->team->user->name . ') ' . ' clasificados para los Playoffs!';
                    $description = "Tras derrotar a los " . $playoffClash->loser()->team->medium_name . " de " . $playoffClash->loser()->team->user->name . " en el Play-In";
                }
            }
        }

        if ($title !== null && $description !== null) {
            $post = $this->storePost(
                self::POST_TYPE_FEATURED,
                $playoffClash->winner()->team->id,
                $playoffClash->round->playoff->name . ' | ' . $playoffClash->winner()->team->short_name,
                $title,
                $description . '.',
                $playoffClash->winner()->team->getImg(),
                $match->id
            );
            event(new PostStored($post));
        }

    }
}
