<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

use App\Import\Exception\ImportException;
use DiDom\Document;

final readonly class PeriodExtractor
{
    public function extract(Document $document): Period
    {
        $periodElement = $document->find('#ctl00_Main_periodSelect > option[selected]');

        if (! $periodElement) {
            throw new ImportException('Selected option not found');
        }

        if (! preg_match('#(\d{4}-\d{2}-\d{2})\|(\d{4}-\d{2}-\d{2})#i', $periodElement[0]->attr('value'), $matches)) {
            throw new ImportException('Cannot found dates');
        }

        return new Period(new \DateTimeImmutable($matches[1]), new \DateTimeImmutable($matches[2]));
    }
}
