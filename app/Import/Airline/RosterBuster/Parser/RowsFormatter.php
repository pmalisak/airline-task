<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Parser;

use App\Import\Exception\ImportException;

final readonly class RowsFormatter
{
    /**
     * @param Row[] $rows
     * @return Row[]
     * @throws ImportException
     */
    public function format(Period $period, array $rows): array
    {
        $newRows = [];
        $currentDate = clone $period->from;
        foreach ($rows as $row) {
            if ($newDate = $this->formatDate($currentDate, (int) $this->extractDay($row->date))) {
                $currentDate = $newDate;
            }

            if ($currentDate && ! $period->isBetween($currentDate)) {
                throw new ImportException(\sprintf('Format date failed: %s', $currentDate->format('Y-m-d')));
            }

            $newRows[] = new Row(
                $newDate?->format('Y-m-d'),
                $this->formatTime($row->checkInTime),
                $this->formatTime($row->checkOutTime),
                $row->activity,
                $row->from,
                $this->formatTime($row->std),
                $row->to,
                $this->formatTime($row->sta),
                $row->blockHours,
                $row->flightTime,
                $row->durationTime,
            );
        }

        return $newRows;
    }

    private function formatTime(?string $time): ?string
    {
        return $time ? \substr_replace($time, ":", 2, 0) : null;
    }

    private function formatDate(\DateTimeImmutable $currentDate, int $day): ?\DateTimeImmutable
    {
        if (! $day) {
            return null;
        }

        if ((int) $currentDate->format('d') === $day) {
            return $currentDate;
        }

        $newDate = $currentDate->modify('+1 day');
        if ((int) $newDate->format('d') === $day) {
            return $newDate;
        }

        throw new ImportException(\sprintf('Wrong day, should be %d is %d', $day, $newDate->format('d')));
    }

    private function extractDay(?string $text): ?string
    {
        return $text ? \substr($text, 4) : null;
    }
}
