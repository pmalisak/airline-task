<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Crew extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'crew';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}
