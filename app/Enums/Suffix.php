<?php

namespace App\Enums;

enum Suffix: string
{
    case JR = 'Jr';
    case SR = 'Sr';
    case II = 'II';
    case III = 'III';

    public static function toArray(): array
    {
        return array_column(Suffix::cases(), 'value');
    }
}