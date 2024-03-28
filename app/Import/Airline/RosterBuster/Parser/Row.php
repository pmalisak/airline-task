<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

final readonly class Row
{
    public function __construct(
        public ?string $date,
        public ?string $checkInTime,
        public ?string $checkOutTime,
        public string $activity,
        public string $from,
        public string $std,
        public string $to,
        public string $sta,
        public ?string $blockHours,
        public ?string $flightTime,
        public ?string $durationTime,
    ) {
    }
}
