<?php

namespace App\Enums;

enum CivilStatus: string
{
    case SINGLE = 'Single';
    case MARRIED = 'Married';
    case WIDOWED = 'Widowed';
    case SEPARATED = 'Separated';

    public static function toArray(): array
    {
        return array_column(CivilStatus::cases(), 'value');
    }
}