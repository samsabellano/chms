<?php

namespace App\Interfaces;
use App\Dto\ChurchEventDto;
use App\Models\ChurchEvent;
use Illuminate\Support\Collection;

interface IChurchEvent
{
    public function getChurchEvents(): Collection;
    public function createChurchEvent(ChurchEventDto $dto): ChurchEvent;
    public function showChurchEvent(ChurchEvent $churchEvent): ChurchEvent;
    public function updateChurchEvent(ChurchEvent $churchEvent, ChurchEventDto $dto): ChurchEvent;
    public function deleteChurchEvent(ChurchEvent $churchEvent): bool;
}
