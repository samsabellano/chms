<?php

namespace App\Models;

use App\Enums\CivilStatus;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'occupation_id',
        'workplace_id',
        'company_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'photo',
        'birth_date',
        'age',
        'civil_status',
        'gender',
        'contact_number',
        'address'
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'gender' => Gender::class,
            'civil_status' => CivilStatus::class
        ];
    }

    protected static function boot(): void
    {
        // Update the age column everytime the model Member is loaded.
        parent::boot();
        static::retrieved(function ($model) {
            $age = Carbon::parse($model->birth_date)->age;
            $model->age = $age;
            $model->save();
        });
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function baptism(): HasOne
    {
        return $this->hasOne(Baptism::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function workplace(): BelongsTo
    {
        return $this->belongsTo(Workplace::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function relationships(): BelongsToMany
    {
        return $this->belongsToMany(Relationship::class);
    }

    protected function fullName(): Attribute
    {
        $middleName = $this->middle_name ? " {$this->middle_name[0]}." : '';
        $suffix = $this->suffix ? " {$this->suffix}." : '';
        $fullName = "{$this->first_name}{$middleName} {$this->last_name}{$suffix}";

        return Attribute::make(
            get: fn() => $fullName
        );
    }

    protected function nameInitial(): Attribute
    {
        $initial = "{$this->first_name[0]}{$this->last_name[0]}";

        return Attribute::make(
            get: fn() => $initial
        );
    }

    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->birth_date)->format('M d, Y')
        );
    }

    protected function isBirthDay(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->birth_date)->isBirthDay()
        );
    }

    public function dateCreated()
    {
        return $this->createdAt($this->created_at);
    }
}
