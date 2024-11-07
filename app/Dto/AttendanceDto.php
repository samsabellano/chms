<?php

namespace App\Dto;
use App\Models\Member;
use Event;

class AttendanceDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public Member|int $member,
        public Event|int $event
    ) {
    }
}
