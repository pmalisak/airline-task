<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crew', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('crew_name_unq');
        });

        Schema::create('roster', function (Blueprint $table) {
            $table->id();
            $table->integer('crew_id');
            $table->timestamp('date');
            $table->unique(['crew_id', 'date']);
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('block_hours')->nullable();
            $table->string('flight_time')->nullable();
            $table->string('duration_time')->nullable();
        });

        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('activity');
            $table->string('activity_details');
            $table->string('from');
            $table->string('std')->nullable();
            $table->string('to');
            $table->string('sta')->nullable();
            $table->unsignedBigInteger('roster_id');
            $table->foreign('roster_id')->references('id')->on('roster')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event');
        Schema::dropIfExists('roster');
        Schema::dropIfExists('crew');
    }
};
