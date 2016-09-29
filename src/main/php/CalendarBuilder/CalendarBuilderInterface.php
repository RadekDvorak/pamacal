<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\CalendarBuilder;

use RadekDvorak\PamaCal\Match;

interface CalendarBuilderInterface
{

    /**
     * @param Match[]|\Traversable $matches
     * @return string
     */
    public function createCalendar(\Traversable $matches) : string;
}
