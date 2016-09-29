<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Parser;

use RadekDvorak\PamaCal\Match;

interface ContentsParserInterface
{

    /**
     * @param string $contents
     * @return Match[]|\Traversable
     */
    public function parse(string $contents) : \Traversable;
}
