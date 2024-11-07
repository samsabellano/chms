<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'event_id', 'date', 'time'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function churchEvent(): BelongsTo
    {
        return $this->belongsTo(ChurchEvent::class);
    }
}
