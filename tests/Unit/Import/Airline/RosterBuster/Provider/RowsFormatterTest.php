<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster\Provider;

use App\Import\Airline\RosterBuster\Parser\Period;
use App\Import\Airline\RosterBuster\Parser\Row;
use App\Import\Airline\RosterBuster\Parser\RowsExtractor;
use App\Import\Airline\RosterBuster\Parser\RowsFormatter;
use App\Import\Exception\ImportException;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class RowsFormatterTest extends TestCase
{
    public function testFormat(): void
    {
        $document = new Document(\file_get_contents('tests/Data/RosterCrewConnex.html'));

        $extractor = new RowsFormatter();
        $rows = $extractor->format(
            new Period(new \DateTimeImmutable('2022-01-10'), new \DateTimeImmutable('2022-01-23')),
            (new RowsExtractor())->extract($document),
        );

        $this->assertCount(35, $rows);
        $this->assertSame([
            '2022-01-11',
            '07:45',
            null,
            'DX77',
            'KRP',
            '08:45',
            'CPH',
            '09:35',
            null,
            null,
            null,
        ], array_values((array) $rows[4]));
        $this->assertSame([
            null,
            null,
            '17:55',
            'DX82',
            'CPH',
            '16:45',
            'KRP',
            '17:35',
            '3:20',
            '0:50',
            '10:10',
        ], array_values((array) $rows[7]));
    }

    public function testWrongDay(): void
    {
        $this->expectException(ImportException::class);
        $this->expectExceptionMessage('Wrong day, should be 24 is 11');

        $extractor = new RowsFormatter();
        $extractor->format(
            new Period(new \DateTimeImmutable('2022-01-10'), new \DateTimeImmutable('2022-01-23')),
            [new Row(
                'Mon 24',
                '1000',
                null,
                'OFF',
                'KRK',
                '',
                'KRK',
                '',
                null,
                null,
                null,
            )],
        );
    }

    public function testFormatDateFailed(): void
    {
        $this->expectException(ImportException::class);
        $this->expectExceptionMessage('Format date failed: 2022-01-11');

        $extractor = new RowsFormatter();
        $extractor->format(
            new Period(new \DateTimeImmutable('2022-01-10'), new \DateTimeImmutable('2022-01-10')),
            [
                new Row(
                    'Mon 11',
                    '1000',
                    null,
                    'OFF',
                    'KRK',
                    '',
                    'KRK',
                    '',
                    null,
                    null,
                    null,
                ),
            ]
        );
    }
}
