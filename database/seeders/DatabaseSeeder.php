<?php

namespace Database\Seeders;

use App\Models\Crew;
use Database\Factories\CrewFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Crew::factory()->create([
            'name' => 'Jan de Bosman',
        ]);
    }
}
