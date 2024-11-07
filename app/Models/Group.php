<?php

namespace App\Models;

use App\Enums\GroupVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'visibility'];

    protected function casts(): array
    {
        return ['visibility' => GroupVisibility::class];
    }
}
