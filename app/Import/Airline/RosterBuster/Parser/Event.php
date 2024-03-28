<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

final readonly class Event
{
    public function __construct(
        public \DateTimeImmutable $date,
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
