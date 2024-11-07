<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'Admin';
    case USER = 'User';

    public static function toArray(): array
    {
        return array_column(Role::cases(), 'value');
    }
}