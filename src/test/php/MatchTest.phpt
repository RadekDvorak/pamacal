<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal;

require __DIR__ . '/../../../vendor/autoload.php';

use Tester\Assert;

/**
 * @testCase
 */
class MatchTest extends TestCase
{

    const AWAY_TEAM = 'Arsenal';
    const HOME_TEAM = 'Manchester';
    const NOW = '2016-01-01 15:30:00';

    public function testGetHomeTeam()
    {
        $date = new \DateTime(self::NOW);
        $match = new Match(self::HOME_TEAM, self::AWAY_TEAM, $date);

        Assert::same(self::HOME_TEAM, $match->getHomeTeam());
    }

    public function testGetAwayTeam()
    {
        $date = new \DateTime(self::NOW);
        $match = new Match(self::HOME_TEAM, self::AWAY_TEAM, $date);

        Assert::same(self::AWAY_TEAM, $match->getAwayTeam());
    }

    public function testGetDate()
    {
        $date = new \DateTime(self::NOW);
        $match = new Match(self::HOME_TEAM, self::AWAY_TEAM, $date);

        Assert::equal($date, $match->getDate());
        Assert::notSame($date, $match->getDate());
    }
}

(new MatchTest())->run();
