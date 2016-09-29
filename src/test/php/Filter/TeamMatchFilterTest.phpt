<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Loader;

require __DIR__ . '/../../../../vendor/autoload.php';

use RadekDvorak\PamaCal\Filter\TeamMatchFilter;
use RadekDvorak\PamaCal\Match;
use RadekDvorak\PamaCal\TestCase;
use Tester\Assert;

class TeamMatchFilterTest extends TestCase
{

    const AWAY_TEAM = 'Arsenal';
    const HOME_TEAM = 'Manchester';
    const NOW = '2016-01-01 15:30:00';

    /**
     * @dataProvider provideData
     * @param string $filter
     * @param Match[] $matches
     * @param Match[] $expectation
     */
    public function testTeamMatchFilter(string $filter, array $matches, array $expectation)
    {
        $matchFilter = new TeamMatchFilter($filter);

        $actual = $matchFilter->filterMatches(new \ArrayIterator($matches));

        Assert::same($expectation, iterator_to_array($actual, false));
    }

    public function provideData() : array
    {
        $one = $this->createMatch(self::HOME_TEAM, self::AWAY_TEAM);
        $two = $this->createMatch('Bayern Munich', 'AC Milan');
        $three = $this->createMatch(self::AWAY_TEAM, self::HOME_TEAM);

        return [
            [self::HOME_TEAM, [$one, $two, $three], [$one, $three]],
            [self::AWAY_TEAM, [$one, $two, $three], [$one, $three]],
            ['Leicester', [$one, $two, $three], []],
        ];
    }

    private function createMatch(string $home, string $away) : Match
    {
        return new Match($home, $away, new \DateTime(self::NOW));
    }
}

(new TeamMatchFilterTest())->run();
