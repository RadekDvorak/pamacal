<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Time;

class SystemClock implements ClockInterface
{

    public function now() : \DateTime
    {
        return new \DateTime();
    }
}
