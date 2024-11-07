<?php

namespace App\Enums;

enum AgeCategory: string
{
    case CHILDREN = 'Children';
    case YOUTH = 'Youth';
    case ADULT = 'Adult';

    public static function toArray(): array
    {
        return array_column(AgeCategory::cases(), 'value');
    }
}