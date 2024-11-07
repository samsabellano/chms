<?php

namespace App\Enums;

enum GroupVisibility: string
{
    case PRIVATE = 'Private';
    case PUBLIC = 'Public';

    public static function toArray(): array
    {
        return array_column(GroupVisibility::cases(), 'value');
    }
}