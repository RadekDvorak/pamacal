<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Filter;

use RadekDvorak\PamaCal\Match;

class TeamMatchFilter implements FilterInterface
{

    /**
     * @var string
     */
    private $teamName;

    public function __construct(string $teamName)
    {
        $this->teamName = $teamName;
    }

    /**
     * @inheritdoc
     */
    public function filterMatches(\Traversable $matches) : \Traversable
    {
        if (!$matches instanceof \Iterator) {
            $matches = new \IteratorIterator($matches);
        }

        return new \CallbackFilterIterator($matches, function (Match $match) :bool {
            return $this->accept($match);
        });
    }

    private function accept(Match $match) : bool
    {
        $isAccepted =
            $match->getAwayTeam() === $this->teamName
            || $match->getHomeTeam() === $this->teamName;

        return $isAccepted;
    }
}
