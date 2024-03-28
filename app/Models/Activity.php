<?php

declare(strict_types=1);

namespace App\Models;

enum Activity: string
{
    case FLT = 'FLT';
    case DO = 'DO';
    case SBY = 'SBY';
    case CI = 'CI';
    case CO = 'CO';
    case UNK = 'UNK';

    public function label(): string
    {
        return match ($this) {
            self::FLT => 'Flight,',
            self::DO => 'Day Off',
            self::SBY => 'Standby',
            self::CI => 'Check-in',
            self::CO => 'Check-out',
            self::UNK => 'Unknown',
        };
    }
}
