<?php

declare(strict_types=1);

namespace Tests\Unit\Import\Airline\RosterBuster;

use App\Import\Airline\RosterBuster\Parser\RowsExtractor;
use DiDom\Document;
use PHPUnit\Framework\TestCase;

class RowsExtractorTest extends TestCase
{
    public function testExtract(): void
    {
        $document = new Document(\file_get_contents(dirname(__FILE__) . '/RosterCrewConnex.html'));

        $extractor = new RowsExtractor();
        $rows = $extractor->extract($document);

        $this->assertCount(35, $rows);
        $this->assertSame([
            'Tue 11',
            '0745',
            null,
            'DX77',
            'KRP',
            '0845',
            'CPH',
            '0935',
            null,
            null,
            null,
        ], array_values((array) $rows[4]));
        $this->assertSame([
            null,
            null,
            '1755',
            'DX82',
            'CPH',
            '1645',
            'KRP',
            '1735',
            '3:20',
            '0:50',
            '10:10',
        ], array_values((array) $rows[7]));
    }
}
