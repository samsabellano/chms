<?php

namespace App\Services;
use App\Dto\OccupationDto;
use App\Models\Occupation;
use Illuminate\Support\Collection;

class OccupationService
{
    public function getOccupations(): Collection
    {
        return Occupation::all();
    }

    public function createOccupation(OccupationDto $dto): Occupation
    {
        return Occupation::create(['name' => $dto->name]);
    }

    public function showOccupation(Occupation $occupation): Occupation
    {
        return $occupation;
    }

    public function updateOccupation(Occupation $occupation, OccupationDto $dto): Occupation
    {
        return tap($occupation)->update(['name' => $dto->name]);
    }

    public function deleteOccupation(Occupation $occupation): bool
    {
        return $occupation->delete();
    }
}
