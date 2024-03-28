<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster\Provider;

use App\Import\Airline\RosterBuster\Parser\CrewNameExtractor;
use App\Import\Exception\ImportException;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class CrewNameExtractorTest extends TestCase
{
    public function testExtract(): void
    {
        $document = new Document(\file_get_contents('tests/Data/RosterCrewConnex.html'));

        $extractor = new CrewNameExtractor();

        $this->assertSame('Jan de Bosman', $extractor->extract($document));
    }

    public function testPeriodElementNotFound(): void
    {
        $this->expectException(ImportException::class);
        $this->expectExceptionMessage('Period element not found');

        (new CrewNameExtractor())->extract(new Document('test'));
    }

    public function testCannotFoundName(): void
    {
        $this->expectException(ImportException::class);
        $this->expectExceptionMessage('Cannot found name');

        (new CrewNameExtractor())->extract(new Document('<div class="printOnly"><b>foo bar</b></div>'));
    }
}
