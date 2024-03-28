<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

use App\Import\Exception\ImportException;
use DiDom\Document;

final readonly class CrewNameExtractor
{
    public function extract(Document $document): string
    {
        $periodElement = $document->find('div.printOnly > b');

        if (! $periodElement) {
            throw new ImportException('Period element not found');
        }

        if (! preg_match('#- ([a-z ]+)\)$#i', $periodElement[0]->text(), $matches)) {
            throw new ImportException('Cannot found name');
        }

        return trim($matches[1]);
    }
}
