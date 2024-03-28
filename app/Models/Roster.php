<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \DateTime $date
 * @property int $crew_id
 * @property string $start_time
 * @property string $end_time
 * @property string $block_hours
 * @property string $flight_time
 * @property string $duration_time
 */
class Roster extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'roster';

    protected $primaryKey = 'id';

    protected $casts = [
        'crew_id' => 'string',
    ];

    protected $fillable = [
        'crew_id',
        'date',
        'start_time',
        'end_time',
        'block_hours',
        'flight_time',
        'duration_time',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
