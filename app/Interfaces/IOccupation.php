<?php

namespace App\Interfaces;
use App\Dto\OccupationDto;
use App\Models\Occupation;

interface IOccupation
{
    public function getOccupations(): Collection;
    public function createOccupation(Occupation $occupation): Occupation;
    public function showOccupation(Occupation $occupation): Occupation;
    public function updateOccupation(Occupation $occupation, OccupationDto $dto): Occupation;
    public function deleteOccupation(Occupation $occupation): bool;
}
