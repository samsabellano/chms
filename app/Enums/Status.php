<?php

namespace App\Enums;

enum Status: string
{
    case REGULAR = 'Regular';
    case IRREGULAR = 'Irregular';
    case DECEASED = 'Deceased';
    case LEFT_CHURCH = 'Left';

    public static function toArray(): array
    {
        return array_column(Status::cases(), 'value');
    }
}