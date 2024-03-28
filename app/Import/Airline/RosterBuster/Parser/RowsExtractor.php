<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

use DiDom\Document;
use DiDom\Element;

final readonly class RowsExtractor
{
    private const NON_BREAKING_SPACE = 0xA0;

    /**
     * @return Row[]
     */
    public function extract(Document $document): array
    {
        $trList = $document->find('#ctl00_Main_activityGrid tr');
        if (is_null($trList)) {
            return [];
        }

        $rows = [];
        foreach ($document->find('#ctl00_Main_activityGrid tr') as $tr) {
            if ($tr->has('.activity-table-header')) {
                continue;
            }

            $rows[] = new Row(
                $this->getText($tr, 'date'),
                $this->getText($tr, 'checkinutc'),
                $this->getText($tr, 'checkoututc'),
                $this->getText($tr, 'activity'),
                $this->getText($tr, 'fromstn'),
                $this->getText($tr, 'stdutc'),
                $this->getText($tr, 'tostn'),
                $this->getText($tr, 'stautc'),
                $this->getText($tr, 'blockhours'),
                $this->getText($tr, 'flighttime'),
                $this->getText($tr, 'duration'),
            );
        }

        return $rows;
    }

    private function getText(Element $tr, string $class): ?string
    {
        return $this->filter($tr->xpath('//td[contains(@class, "activitytablerow-' . $class . '")]')[0]->text());
    }

    private function filter(string $text): ?string
    {
        $text = trim(str_replace(mb_chr(self::NON_BREAKING_SPACE), '', $text));
        return $text ?: null;
    }
}
