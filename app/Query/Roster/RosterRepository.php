<?php

declare(strict_types=1);

namespace App\Query\Roster;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final readonly class RosterRepository
{
    public function getBy(SearchCriteria $criteria): Collection
    {
        $qb = DB::table('roster')
            ->join('event', 'roster.id', '=', 'event.roster_id')
            ->select(
                'event.id',
                'roster.id as roster_id',
                'roster.date',
                'roster.start_time',
                'roster.end_time',
                'event.activity',
                'event.activity_details',
                'event.from',
                'event.sta',
                'event.to',
                'event.std',
            )
            ->orderBy('roster.id')
            ->orderBy('event.id');

        if ($criteria->nextWeek) {
            $currentDate = new \DateTimeImmutable('2022-01-14');
            $nextMonday = $currentDate->modify('next monday');

            $qb
                ->where('roster.date', '>=', $nextMonday->format('Y-m-d'))
                ->where('roster.date', '<', $nextMonday->modify('next monday')->format('Y-m-d'));
        } elseif ($criteria->dateFrom && $criteria->dateTo) {
            $qb
                ->where('roster.date', '>=', $criteria->dateFrom)
                ->where('roster.date', '<', (new \DateTimeImmutable($criteria->dateTo))->modify('+1 day'));
        }

        if ($criteria->activity) {
            $qb
                ->where('event.activity', '=', $criteria->activity);
        }

        if ($criteria->from) {
            $qb
                ->where('event.from', '=', $criteria->from);
        }

        return $qb->get();
    }
}
