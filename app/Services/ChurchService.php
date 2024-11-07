<?php

namespace App\Services;
use App\Dto\ChurchDto;
use App\Interfaces\IChurch;
use App\Models\Church;
use Illuminate\Support\Collection;

class ChurchService implements IChurch
{
    public function getChurches(): Collection
    {
        return Church::all();
    }

    public function createChurch(ChurchDto $dto): Church
    {
        return Church::create([
            'name' => $dto->name,
            'address' => $dto->address
        ]);
    }

    public function showChurch(Church $church): Church
    {
        return $church;
    }

    public function updateChurch(Church $church, ChurchDto $dto): Church
    {
        return tap($church)->update([
            'name' => $dto->name,
            'address' => $dto->address
        ]);
    }

    public function deleteChurch(Church $church): bool
    {
        return $church->delete();
    }
}