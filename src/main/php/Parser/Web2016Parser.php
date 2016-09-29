<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Parser;

use RadekDvorak\PamaCal\Match;

class Web2016Parser implements ContentsParserInterface
{

    /**
     * @inheritdoc
     */
    public function parse(string $contents) : \Traversable
    {
        $originalXmlInternalErrors = libxml_use_internal_errors(true);

        try {
            $dom = new \DOMDocument();
            $dom->loadHTML($contents);

            $xml = simplexml_import_dom($dom);

            $dayBlocks = $xml->xpath('//div[@title="Rozlosování"]/table');

            foreach ($dayBlocks as $dayBlock) {
                /** @var \SimpleXMLElement $dayData */
                $dayData = $dayBlock->tr[0]->td[0]->b;

                $date = explode(' ', (string)$dayData[1])[1];

                $matchRows = $dayBlock->xpath('./tr[position() > 1]//tr');

                foreach ($matchRows as $matchRow) {
                    $hours = (string)$matchRow->td[0];
                    if (1 !== preg_match('~([\d]{1,2}):([\d]{2})~', $hours, $matches)) {
                        continue;
                    }

                    $homeTeam = (string)$matchRow->td[1];
                    $awayTeam = (string)$matchRow->td[2];

                    $matchTime = \DateTime::createFromFormat('d-m-Y', $date);
                    $matchTime->setTime(intval($matches[1]), intval($matches[2]), 0);

                    yield new Match($homeTeam, $awayTeam, $matchTime);
                }
            }
        } finally {
            libxml_use_internal_errors($originalXmlInternalErrors);
        }
    }
}
