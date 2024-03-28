<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

final readonly class Period
{
    public function __construct(
        public \DateTimeImmutable $from,
        public \DateTimeImmutable $to,
    ) {
    }

    public function isBetween(\DateTimeImmutable $date): bool
    {
        return $date >= $this->from && $date <= $this->to;
    }

}
