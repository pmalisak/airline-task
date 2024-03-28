<?php

namespace Tests\Feature;

use App\Models\Activity;
use Tests\TestCase;

class RosterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $response = $this->call('POST', '/import', [], [], [], [], \file_get_contents('tests/Data/RosterCrewConnex.html'));
        $response->assertStatus(201);
    }

    public function test_the_roster_returns_a_successful_response(): void
    {
        $response = $this->get('/roster');
        $response->assertStatus(200);
    }

    public function test_date_criteria(): void
    {
        $response = $this->get('/roster?dateFrom=2022-01-12&dateTo=2022-01-12');
        $response->assertStatus(200);

        $json = $response->decodeResponseJson();

        $this->assertCount(1, $json->json('items'));
        $this->assertEquals([
            'id' => 9,
            'roster_id' => 3,
            'start_time' => null,
            'end_time' => null,
            'date' => '2022-01-12 00:00:00',
            'activity' => Activity::DO->value,
            'activity_details' => 'OFF',
            'from' => 'KRP',
            'sta' => '23:00',
            'to' => 'KRP',
            'std' => '23:00-1',
        ],
            $json->json('items')[0]
        );
    }
}
