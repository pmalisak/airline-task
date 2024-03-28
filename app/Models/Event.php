<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type
 * @property string $activity
 * @property string $from
 * @property string $std
 * @property string $to
 * @property string $sta
 */
class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'event';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'activity',
        'from',
        'std',
        'to',
        'sta',
    ];
}
