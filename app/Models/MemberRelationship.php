<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'child_id',
        'relationship_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Member::class, 'parent_id');
    }

    public function child()
    {
        return $this->belongsTo(Member::class, 'child_id');
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
}
