<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Saver;

interface SaverInterface
{

    /**
     * @param string $calendar
     * @param string $url
     */
    public function save(string $calendar, string $url);
}
