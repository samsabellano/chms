<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';

    public static function toArray(): array
    {
        return array_column(Gender::cases(), 'value');
    }
}