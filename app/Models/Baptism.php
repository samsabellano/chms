<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baptism extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'church_id', 'date'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
