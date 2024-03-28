<?php

declare(strict_types=1);

namespace App\Query\Roster;

final readonly class SearchCriteria
{
    public function __construct(
        public ?string $dateFrom,
        public ?string $dateTo,
        public ?string $activity,
        public ?string $from,
        public bool $nextWeek,
    ) {
    }
}
