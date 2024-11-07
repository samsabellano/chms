<?php

namespace App\Services;
use App\Dto\ChurchEventDto;
use App\Interfaces\IChurchEvent;
use App\Models\ChurchEvent;
use Illuminate\Support\Collection;

class ChurchEventService implements IChurchEvent
{
    public function getChurchEvents(): Collection
    {
        return ChurchEvent::all();
    }

    public function createChurchEvent(ChurchEventDto $dto): ChurchEvent
    {
        return ChurchEvent::create(['name' => $dto->name]);
    }

    public function showChurchEvent(ChurchEvent $churchEvent): ChurchEvent
    {
        return $churchEvent;
    }

    public function updateChurchEvent(ChurchEvent $churchEvent, ChurchEventDto $dto): ChurchEvent
    {
        return tap($churchEvent)->update(['name' => $dto->name]);
    }

    public function deleteChurchEvent(ChurchEvent $churchEvent): bool
    {
        return $churchEvent->delete();
    }
}
