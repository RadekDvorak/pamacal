<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal;

use RadekDvorak\PamaCal\CalendarBuilder\CalendarBuilderInterface;
use RadekDvorak\PamaCal\Filter\FilterInterface;
use RadekDvorak\PamaCal\Loader\LoaderInterface;
use RadekDvorak\PamaCal\Parser\ContentsParserInterface;
use RadekDvorak\PamaCal\Saver\SaverInterface;

class CalendarCreator
{

    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * @var ContentsParserInterface
     */
    private $parser;

    /**
     * @var CalendarBuilderInterface
     */
    private $calendarBuilder;

    /**
     * @var SaverInterface
     */
    private $saver;

    /**
     * @var FilterInterface
     */
    private $filter;

    public function __construct(
        LoaderInterface $loader,
        ContentsParserInterface $parser,
        CalendarBuilderInterface $calendarBuilder,
        SaverInterface $saver,
        FilterInterface $filter
    ) {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->calendarBuilder = $calendarBuilder;
        $this->saver = $saver;
        $this->filter = $filter;
    }

    public function createCalendar(string $sourceUrl, string $targetUrl)
    {
        $contents = $this->loader->loadSource($sourceUrl);
        $matches = $this->parser->parse($contents);
        $filteredMatches = $this->filter->filterMatches($matches);
        $calendar = $this->calendarBuilder->createCalendar($filteredMatches);
        $this->saver->save($calendar, $targetUrl);
    }
}
