<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster;

use App\Import\Airline\RosterBuster\Parser\Period;
use App\Import\Airline\RosterBuster\Parser\PeriodExtractor;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class PeriodExtractorTest extends TestCase
{
    public function testExtract(): void
    {
        $document = new Document(\file_get_contents(dirname(__FILE__) . '/RosterCrewConnex.html'));

        $extractor = new PeriodExtractor();

        $this->assertEquals(
            new Period(new \DateTimeImmutable('2022-01-10'), new \DateTimeImmutable('2022-01-23')),
            $extractor->extract($document)
        );
    }
}
