<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster;

use App\Import\Airline\RosterBuster\Parser\CrewNameExtractor;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class CrewNameExtractorTest extends TestCase
{
    public function testExtract(): void
    {
        $document = new Document(\file_get_contents(dirname(__FILE__) . '/RosterCrewConnex.html'));

        $extractor = new CrewNameExtractor();

        $this->assertSame('Jan de Bosman', $extractor->extract($document));
    }
}
