<?php

namespace Tests\App\Service;

use App\Manager\MatchPollManager;
use App\Models\MatchPoll;
use App\Service\MatchPollService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class MatchPollServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @var MatchPollManager&MockObject  */
    private MatchPollManager $matchPollManager;

    private MatchPollService $matchPollService;

    public function setUp(): void
    {
        $this->matchPollManager = $this->createMock(MatchPollManager::class);
        $this->matchPollService = new MatchPollService($this->matchPollManager);
    }

    /**
     * @dataProvider getByMatchIdProvider
     */
    public function testGetByMatchId(Collection $matchPollVotes, int $expectedLocalVotes, int $expectedVisitorVotes): void
    {
        $matchId = 1;
        $this->matchPollManager->method('findByMatchId')->willReturn($matchPollVotes);
        $pollVotes = $this->matchPollService->getByMatchId($matchId);

        self::assertEquals($expectedLocalVotes, $pollVotes['local']);
        self::assertEquals($expectedVisitorVotes, $pollVotes['visitor']);
    }

    public function getByMatchIdProvider(): \Iterator
    {
        $localVotes = 1;
        $visitorVotes = 3;
        $matchPollVotes = $this->getMatchPoll($localVotes, $visitorVotes);


        yield 'case 1: ' => [
            'match_poll_votes' => $matchPollVotes,
            'expected_local_votes' => $localVotes,
            'expected_visitor_votes' => $visitorVotes,
        ];

        $localVotes = 5;
        $visitorVotes = 2;
        $matchPollVotes = $this->getMatchPoll($localVotes, $visitorVotes);

        yield 'case 2: ' => [
            'match_poll_votes' => $matchPollVotes,
            'expected_local_votes' => $localVotes,
            'expected_visitor_votes' => $visitorVotes,
        ];
    }

    private function getMatchPoll(int $localVotes, int $visitorVotes): Collection
    {
        $result = new Collection();

        for ($i = 0; $i < $localVotes; $i++) {
            $poll = new MatchPoll();
            $poll->vote = 'local';
            $result->push($poll);
        }

        for ($i = 0; $i < $visitorVotes; $i++) {
            $poll = new MatchPoll();
            $poll->vote = 'visitor';
            $result->push($poll);
        }

        return $result;
    }
}
