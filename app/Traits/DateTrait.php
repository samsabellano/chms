<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateTrait
{
    public function createdAt($created_field): string
    {
        return Carbon::parse($created_field)->format('M d, Y');
    }

    public function updatedAt($created_field, $updated_field): string
    {
        $created_at = Carbon::parse($created_field)->isoFormat('MMM DD, YYYY HH:mm:ss');
        $updated_at = Carbon::parse($updated_field)->isoFormat('MMM DD, YYYY HH:mm:ss');

        return $updated_at === $created_at
            ? ""
            : Carbon::parse($updated_field)->format('M d, Y | h:i A');
    }
}