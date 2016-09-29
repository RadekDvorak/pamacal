<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Filter;

interface FilterInterface
{

    public function filterMatches(\Traversable $matches) : \Traversable;
}
