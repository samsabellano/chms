<?php

namespace App\Dto;
use App\Models\Church;
use Illuminate\Support\Carbon;

class BaptismDto
{
    public function __construct(
        public Church $church,
        public Carbon $date
    ) {
    }
}
