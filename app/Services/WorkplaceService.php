<?php

namespace App\Services;
use App\Dto\WorkplaceDto;
use App\Interfaces\IWorkplace;
use App\Models\Workplace;
use Illuminate\Support\Collection;

class WorkplaceService implements IWorkplace
{
    public function getWorkplaces(): Collection
    {
        return Workplace::all();
    }

    public function createWorkplace(WorkplaceDto $dto): Workplace
    {
        return Workplace::create([
            'name' => $dto->name,
            'address' => $dto->address
        ]);
    }

    public function showWorkplace(Workplace $workplace): Workplace
    {
        return $workplace;
    }

    public function updateWorkplace(Workplace $workplace, WorkplaceDto $dto): Workplace
    {
        return tap($workplace)->update([
            'name' => $dto->name,
            'address' => $dto->address
        ]);
    }

    public function deleteWorkplace(Workplace $workplace): bool
    {
        return $workplace->delete();
    }
}
