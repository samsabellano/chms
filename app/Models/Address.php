<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'member_id',
        'address_line_1',
        'address_line_2',
        'barangay',
        'city_or_municipality',
        'state_or_province',
        'country',
        'postal_code'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
