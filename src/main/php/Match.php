<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal;

class Match
{

    /**
     * @var string
     */
    private $homeTeam;

    /**
     * @var string
     */
    private $awayTeam;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @param string $homeTeam
     * @param string $awayTeam
     * @param \DateTime $date
     */
    public function __construct($homeTeam, $awayTeam, \DateTime $date)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getHomeTeam() : string
    {
        return $this->homeTeam;
    }

    /**
     * @return string
     */
    public function getAwayTeam() : string
    {
        return $this->awayTeam;
    }

    /**
     * @return \DateTime
     */
    public function getDate() : \DateTime
    {
        return clone $this->date;
    }
}
