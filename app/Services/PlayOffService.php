<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\MatchManager;
use App\Managers\MatchPollManager;
use App\Managers\PlayerStatManager;
use App\Managers\PlayOffClashManager;
use App\Managers\PlayOffManager;
use App\Managers\PlayOffRoundManager;
use App\Managers\PostManager;
use App\Managers\ScoreManager;
use App\Managers\SeasonConferenceManager;
use App\Managers\TeamStatManager;
use App\Models\Conference;
use App\Models\PlayoffRound;
use App\Models\Season;
use Symfony\Component\Console\Output\OutputInterface;

class PlayOffService
{
    private const NAME_PLAYIN_7TH_SEED = 'Play-In - 7th seed';

    private const NAME_PLAYIN_8TH_SEED = 'Play-In - 8th seed';

    private const NAME_PLAYOFFS = 'Playoffs';

    private StandingService $standingService;

    private SeasonService $seasonService;

    private SeasonConferenceManager $seasonConferenceManager;

    private PlayOffManager $playOffManager;

    private PlayOffRoundManager $playOffRoundManager;

    private PlayOffClashManager $playOffClashManager;

    private MatchManager $matchManager;

    private MatchPollManager $matchPollManager;

    private ScoreManager $scoreManager;

    private PlayerStatManager $playerStatManager;

    private TeamStatManager $teamStatManager;

    private PostManager $postManager;

    private array $tablePositionsIndexedByConferenceName;

    public function __construct(
        StandingService $standingService,
        SeasonService $seasonService,
        SeasonConferenceManager $seasonConferenceManager,
        PlayOffManager $playOffManager,
        PlayOffRoundManager $playOffRoundManager,
        PlayOffClashManager $playOffClashManager,
        MatchManager $matchManager,
        MatchPollManager $matchPollManager,
        ScoreManager $scoreManager,
        PlayerStatManager $playerStatManager,
        TeamStatManager $teamStatManager,
        PostManager $postManager
    ) {
        $this->standingService = $standingService;
        $this->seasonService = $seasonService;
        $this->seasonConferenceManager = $seasonConferenceManager;
        $this->playOffManager = $playOffManager;
        $this->playOffRoundManager = $playOffRoundManager;
        $this->playOffClashManager = $playOffClashManager;
        $this->matchManager = $matchManager;
        $this->matchPollManager = $matchPollManager;
        $this->scoreManager = $scoreManager;
        $this->playerStatManager = $playerStatManager;
        $this->teamStatManager = $teamStatManager;
        $this->postManager = $postManager;
    }

    public function generateSeasonPlayOffs(Season $season, ?OutputInterface $output = null): void
    {
        $seasonId = $season->getId();

        $this->writeOutput('Purge existing data start', $output);
        $this->purge($seasonId);
        $this->writeOutput('Purge existing data end', $output);

        if (empty($this->tablePositionsIndexedByConferenceName)) {
            $this->tablePositionsIndexedByConferenceName = $this->standingService->getTablePositions($season);
        }

        $seasonConferenceWesternId = ($this->seasonConferenceManager->findBySeasonIdAndConferenceId($seasonId, Conference::TYPE_WESTERN))->getId();
        $seasonConferenceEasternId = ($this->seasonConferenceManager->findBySeasonIdAndConferenceId($seasonId, Conference::TYPE_EASTERN))->getId();

        if ($seasonConferenceWesternId === null || $seasonConferenceEasternId === null) {
            $this->writeOutput('Seasons conferences not exists. Abort process', $output);

            return;
        }

        $this->writeOutput('Step 1: Generate playoffs start', $output);
        $playoffs = $this->generatePlayOffs($season);
        $this->writeOutput('Step 1: Generate playoffs end', $output);

        if (!$this->seasonService->hasPlayIn($season)) {
            return;
        }

        $this->writeOutput('Step 2: Generate Eastern playIn 8th seed start', $output);
        $playIn8thSeedEastern = $this->generatePlayIn8thSeed($seasonId, $seasonConferenceEasternId, Conference::NAME_EASTERN, $playoffs);
        $this->writeOutput('Step 2: Generate Eastern playIn 8th seed end', $output);

        $this->writeOutput('Step 3: Generate Western playIn 8th seed start', $output);
        $playIn8thSeedWestern = $this->generatePlayIn8thSeed($seasonId, $seasonConferenceEasternId, Conference::NAME_WESTERN, $playoffs);
        $this->writeOutput('Step 3: Generate Western playIn 8th seed end', $output);

        $this->writeOutput('Step 4: Generate Eastern playIn 7th seed start', $output);
        $this->generatePlayIn7thSeed($seasonId, $seasonConferenceEasternId, Conference::NAME_EASTERN, $playoffs, $playIn8thSeedEastern);
        $this->writeOutput('Step 4: Generate Eastern playIn 7th seed end', $output);

        $this->writeOutput('Step 5: Generate Western playIn 7th seed start', $output);
        $this->generatePlayIn7thSeed($seasonId, $seasonConferenceEasternId, Conference::NAME_WESTERN, $playoffs, $playIn8thSeedWestern);
        $this->writeOutput('Step 5: Generate Western playIn 7th seed end', $output);
    }

    /**
     * @return array{playoff_id: int, eastern_1vs8_clash_id: int, eastern_2vs7_clash_id: int, western_1vs8_clash_id: int,western_2vs7_clash_id: int}
     */
    public function generatePlayOffs(Season $season): array
    {
        $hasPlayIn = $this->seasonService->hasPlayIn($season);
        $seasonId = $season->getId();
        $playoffOrder = $hasPlayIn ? 5 : 1;

        $playOff = $this->playOffManager->create($seasonId, self::NAME_PLAYOFFS, $playoffOrder, 16, true);

        $firstRound = $this->playOffRoundManager->create($playOff->getId(), PlayOffRound::NAME_PRIMERA_RONDA, 4, 7, 1);
        $localData = $this->getTeamData(Conference::NAME_EASTERN, 1);
        $visitorData = !$hasPlayIn ? $this->getTeamData(Conference::NAME_EASTERN, 8) : [];
        $eastern1vs8Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 1, 1, true);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $eastern1vs8Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_EASTERN, 4);
        $visitorData = $this->getTeamData(Conference::NAME_EASTERN, 5);
        $eastern4vs5Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 2, 1, false);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $eastern4vs5Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_EASTERN, 3);
        $visitorData = $this->getTeamData(Conference::NAME_EASTERN, 6);
        $eastern3vs6Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 3, 2, true);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $eastern3vs6Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_EASTERN, 2);
        $visitorData = !$hasPlayIn ? $this->getTeamData(Conference::NAME_EASTERN, 7) : [];
        $eastern2vs7Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 4, 2, false);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $eastern2vs7Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_WESTERN, 1);
        $visitorData = !$hasPlayIn ? $this->getTeamData(Conference::NAME_WESTERN, 8): [];
        $western1vs8Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 5, 3, true);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $western1vs8Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_WESTERN, 4);
        $visitorData = $this->getTeamData(Conference::NAME_WESTERN, 5);
        $western4vs5Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 6, 3, false);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $western4vs5Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_WESTERN, 3);
        $visitorData = $this->getTeamData(Conference::NAME_WESTERN, 6);
        $western3vs6Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 7, 4, true);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $western3vs6Clash->getId());
        }

        $localData = $this->getTeamData(Conference::NAME_WESTERN, 2);
        $visitorData = !$hasPlayIn ? $this->getTeamData(Conference::NAME_WESTERN, 7) : [];
        $western2vs7Clash = $this->playOffClashManager->create($firstRound->getId(), $localData, $visitorData, 8, 4, false);

        if (!$hasPlayIn) {
            $this->matchManager->create($seasonId, $localData, $visitorData, $western2vs7Clash->getId());
        }

        $semifinalConferenceRound = $this->playOffRoundManager->create($playOff->getId(), PlayOffRound::NAME_SEMIFINAL_CONF, 4, 7, 2);
        $this->playOffClashManager->create($semifinalConferenceRound->getId(), [], [], 1, 1, true);
        $this->playOffClashManager->create($semifinalConferenceRound->getId(), [], [], 2, 1, false);
        $this->playOffClashManager->create($semifinalConferenceRound->getId(), [], [], 3, 2, true);
        $this->playOffClashManager->create($semifinalConferenceRound->getId(), [], [], 4, 2, false);

        $finalConferenceRound = $this->playOffRoundManager->create($playOff->getId(), PlayOffRound::FINAL_CONF, 4, 7, 3);
        $this->playOffClashManager->create($finalConferenceRound->getId(), [], [], 1, 1, false);
        $this->playOffClashManager->create($finalConferenceRound->getId(), [], [], 2, 1, true);

        $finalAnbaRound = $this->playOffRoundManager->create($playOff->getId(), PlayOffRound::FINAL_ANBA, 4, 7, 4);
        $this->playOffClashManager->create($finalAnbaRound->getId(), [], [], 1);

        return [
            'playoff_id' => $playOff->getId(),
            'eastern_1vs8_clash_id' => $eastern1vs8Clash->getId(),
            'eastern_2vs7_clash_id' => $eastern2vs7Clash->getId(),
            'western_1vs8_clash_id' => $western1vs8Clash->getId(),
            'western_2vs7_clash_id' => $western2vs7Clash->getId(),
        ];
    }

    /**
     * @param array{playoff_id: int, eastern_1vs8_clash_id: int, eastern_2vs7_clash_id: int, western_1vs8_clash_id: int,western_2vs7_clash_id: int} $playoffs
     *
     * @return array{playoff_id: int, semifinal_clash1_id: int}
     */
    public function generatePlayIn8thSeed(int $seasonId, int $seasonConferenceId, string $conferenceName, array $playoffs): array
    {
        $playoff = $this->playOffManager->create($seasonId, self::NAME_PLAYIN_8TH_SEED.' - '.$conferenceName, 1, 4, false, 8, $seasonConferenceId);
        $playfoffId = $playoff->getId();

        $finalRound = $this->playOffRoundManager->create($playoff->getId(), PlayOffRound::NAME_FINAL, 1, 1, 2);
        $destinyClash = match ($conferenceName) {
            Conference::NAME_EASTERN =>      $playoffs['eastern_1vs8_clash_id'],
            Conference::NAME_WESTERN => $playoffs['western_1vs8_clash_id'],
            default => null,
        };
        $finalClash = $this->playOffClashManager->create($finalRound->getId(), [], [], 1, $destinyClash, false, $playoffs['playoff_id']);
        $finalClashId = $finalClash->getId();

        $semifinalRound = $this->playOffRoundManager->create($playoff->getId(), PlayOffRound::NAME_SEMIFINAL, 1, 1, 1);
        $semifinal1Clash = $this->playOffClashManager->create($semifinalRound->getId(), [], [], 1, $finalClashId, true, $playfoffId);
        $localData = $this->getTeamData($conferenceName, 7);
        $visitorData = $this->getTeamData($conferenceName, 8);
        $semifinal2Clash = $this->playOffClashManager->create($semifinalRound->getId(), $localData, $visitorData, 2, $finalClashId, false, $playfoffId);

        $this->matchManager->create($seasonId, $localData, $visitorData, $semifinal2Clash->getId());

        return [
            'playoff_id' => $playfoffId,
            'semifinal_clash1_id' => $semifinal1Clash->getId(),
        ];
    }

    /**
     * @param array{playoff_id: int, eastern_1vs8_clash_id: int, eastern_2vs7_clash_id: int, western_1vs8_clash_id: int,western_2vs7_clash_id: int} $playoffs
     * @param array{playoff_id: int, semifinal_clash1_id: int} $playIn8thSeed
     */
    public function generatePlayIn7thSeed(int $seasonId, int $seasonConferenceId, string $conferenceName, array $playoffs, array $playIn8thSeed): void
    {
        $playOff = $this->playOffManager->create($seasonId, self::NAME_PLAYIN_7TH_SEED.' - '.$conferenceName, 1, 2, false, 7, $seasonConferenceId);

        $playOffRound = $this->playOffRoundManager->create($playOff->getId(), PlayOffRound::NAME_FINAL, 1, 1, 1);
        $destinyClashWinner = match ($conferenceName) {
            Conference::NAME_EASTERN => $playoffs['eastern_2vs7_clash_id'],
            Conference::NAME_WESTERN => $playoffs['western_2vs7_clash_id'],
            default => null,
        };
        $localData = $this->getTeamData($conferenceName, 7);
        $visitorData = $this->getTeamData($conferenceName, 8);
        $playOffClash = $this->playOffClashManager->create(
            $playOffRound->getId(),
            $localData,
            $visitorData,
            1,
            $destinyClashWinner,
            false,
            $playoffs['playoff_id'],
            $playIn8thSeed['semifinal_clash1_id'],
            true,
            $playIn8thSeed['playoff_id']
        );
        $this->matchManager->create($seasonId, $localData, $visitorData, $playOffClash->getId());
    }

    private function getTeamData(string $conference, int $position): array
    {
        $tablePositions = $this->tablePositionsIndexedByConferenceName[$conference];
        $arrayPosition = $position - 1;

        return [
            'team_id' => $tablePositions[$arrayPosition]['team']->id,
            'manager_id' => $tablePositions[$arrayPosition]['team']->team->user->id,
            'regular_position' => $position,
        ];
    }

    private function purge(int $seasonId): void
    {
        $playoffIds = $this->playOffManager->findIdsBySeasonId($seasonId);
        $playoffRoundIds = $this->playOffRoundManager->findIdsByPlayoffIds($playoffIds);
        $playoffClashIds = $this->playOffClashManager->findIdsByRoundIds($playoffRoundIds);
        $matchIds = $this->matchManager->findIdsByClashIds($playoffClashIds);
        $matchPollIds = $this->matchPollManager->findIdsByMatchIds($matchIds);
        $scoreIds = $this->scoreManager->findIdsByMatchIds($matchIds);
        $playerStatIds = $this->playerStatManager->findIdsByMatchIds($matchIds);
        $teamStatIds = $this->teamStatManager->findIdsByMatchIds($matchIds);
        $postIds = $this->postManager->findIdsByMatchIds($matchIds);

        if (!empty($postIds)) {
            $this->postManager->deleteByIds($postIds);
        }

        if (!empty($teamStatIds)) {
            $this->teamStatManager->deleteByIds($teamStatIds);
        }

        if (!empty($playerStatIds)) {
            $this->playerStatManager->deleteByIds($playerStatIds);
        }

        if (!empty($scoreIds)) {
            $this->scoreManager->deleteByIds($scoreIds);
        }

        if (!empty($matchPollIds)) {
            $this->matchPollManager->deleteByIds($matchPollIds);
        }

        if (!empty($matchIds)) {
            $this->matchManager->deleteByIds($matchIds);
        }

        if (!empty($playoffClashIds)) {
            $this->playOffClashManager->deleteByIds($playoffClashIds);
        }

        if (!empty($playoffRoundIds)) {
            $this->playOffRoundManager->deleteByIds($playoffRoundIds);
        }

        if (!empty($playoffIds)) {
            $this->playOffManager->deleteByIds($playoffIds);
        }
    }

    private function writeOutput(string $text, ?OutputInterface $output = null): void
    {
        if ($output !== null) {
            $output->writeln(\date(DATE_W3C).' - '.$text);
        }
    }
}
