<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster\Provider;

use App\Import\Airline\RosterBuster\Parser\Period;
use App\Import\Airline\RosterBuster\Parser\PeriodExtractor;
use App\Import\Exception\ImportException;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class PeriodExtractorTest extends TestCase
{
    public function testExtract(): void
    {
        $document = new Document(\file_get_contents('tests/Data/RosterCrewConnex.html'));

        $extractor = new PeriodExtractor();

        $this->assertEquals(
            new Period(new \DateTimeImmutable('2022-01-10'), new \DateTimeImmutable('2022-01-23')),
            $extractor->extract($document)
        );
    }

    public function testSelectedOptionElementNotFound(): void
    {
        $this->expectException(ImportException::class);
        $this->expectExceptionMessage('Selected option not found');

        (new PeriodExtractor())->extract(new Document('test'));
    }

    public function testCannotFoundDates(): void
    {
        $this->expectException(ImportException::class);
        $this->expectExceptionMessage('Cannot found dates');

        (new PeriodExtractor())->extract(new Document('<select id="ctl00_Main_periodSelect"><option selected="" value="foo">bar</option>'));
    }
}
