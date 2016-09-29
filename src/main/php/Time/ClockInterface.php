<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Time;

interface ClockInterface
{

    public function now() : \DateTime;
}
