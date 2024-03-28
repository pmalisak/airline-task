<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Saver;

use App\Import\Airline\RosterBuster\Parser\Data;
use App\Import\Exception\InvalidArgumentException;
use App\Models\Activity;
use App\Models\Crew;
use App\Models\Event;
use App\Models\Roster;

class RosterBusterBatchSaver
{
    /**
     * @throws InvalidArgumentException
     */
    public function save(Data $data): void
    {
        $crew = Crew::firstWhere('name', $data->crewName);

        foreach ($data->rows as $row) {
            if ($row->date || ! isset($roster)) {
                $roster = new Roster();
                $roster->crew_id = $crew->id;
                $roster->date = new \DateTimeImmutable($row->date);
                $roster->start_time = $row->checkInTime;
                $roster->save();
            }

            $event = new Event();
            $event->activity = $this->mapActivity($row->activity);
            $event->activity_details = $row->activity;
            $event->from = $row->from;
            $event->std = $row->std;
            $event->to = $row->to;
            $event->sta = $row->sta;
            $roster->events()->save($event);

            if ($row->checkOutTime) {
                $roster->end_time = $row->checkOutTime;
                $roster->block_hours = $row->blockHours;
                $roster->flight_time = $row->flightTime;
                $roster->duration_time = $row->durationTime;
                $roster->update();
            }
        }
    }

    private function mapActivity(string $activity): string
    {
        if (\str_starts_with($activity, 'DX')) {
            return Activity::FLT->value;
        }

        return match ($activity) {
            'SBY' => Activity::SBY->value,
            'OFF' => Activity::DO->value,
            default => Activity::UNK->value,
        };
    }
}
