<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

use App\Import\Exception\ImportException;
use DiDom\Document;

final readonly class RosterBusterParser
{
    public function __construct(
        private Document $document,
        private CrewNameExtractor $crewNameExtractor,
        private PeriodExtractor $yearExtractor,
        private RowsExtractor $rowsExtractor,
        private RowsFormatter $rowsFormatter,
    ) {
    }

    public function supports(string $data): bool
    {
        $this->document->load($data);
        return (bool) $this->document->find('#ctl00_Main_activityGrid tr');
    }

    /**
     * @throws ImportException
     */
    public function parse(string $data): Data
    {
        $this->document->load($data);

        $crewName = $this->crewNameExtractor->extract($this->document);
        $period = $this->yearExtractor->extract($this->document);
        $rows = $this->rowsFormatter->format(
            $period,
            $this->rowsExtractor->extract($this->document)
        );

        return new Data($crewName, $rows);
    }

}
