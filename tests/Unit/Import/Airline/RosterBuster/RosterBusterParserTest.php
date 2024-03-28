<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster;

use App\Import\Airline\RosterBuster\Parser\CrewNameExtractor;
use App\Import\Airline\RosterBuster\Parser\PeriodExtractor;
use App\Import\Airline\RosterBuster\Parser\RosterBusterParser;
use App\Import\Airline\RosterBuster\Parser\RowsExtractor;
use App\Import\Airline\RosterBuster\Parser\RowsFormatter;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class RosterBusterParserTest extends TestCase
{
    private RosterBusterParser $parser;

    protected function setUp(): void
    {
        $this->parser = new RosterBusterParser(
            new Document(),
            new CrewNameExtractor(),
            new PeriodExtractor(),
            new RowsExtractor(),
            new RowsFormatter(),
        );
    }

    public function testFileSupported(): void
    {
        $this->assertTrue($this->parser->supports(\file_get_contents(dirname(__FILE__) . '/RosterCrewConnex.html')));
    }

    public function testFileNotSupported(): void
    {
        $this->assertFalse($this->parser->supports('some random string'));
    }

    public function testParse(): void
    {
        $result = $this->parser->parse(\file_get_contents(dirname(__FILE__) . '/RosterCrewConnex.html'));

        $this->assertSame('Jan de Bosman', $result->crewName);
        $this->assertCount(35, $result->rows);
    }
}
