<?php

namespace App\Interfaces;
use App\Dto\WorkplaceDto;
use App\Models\Workplace;
use Illuminate\Support\Collection;

interface IWorkplace
{
    public function getWorkplaces(): Collection;
    public function createWorkplace(WorkplaceDto $dto): Workplace;
    public function showWorkplace(Workplace $workplace): Workplace;
    public function updateWorkplace(Workplace $workplace, WorkplaceDto $dto): Workplace;
    public function deleteWorkplace(Workplace $workplace): bool;
}
