<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

final readonly class Data
{
    /**
     * @param Row[] $rows
     */
    public function __construct(
        public string $crewName,
        public array $rows,
    ) {
    }
}
