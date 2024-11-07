<?php

namespace App\Interfaces;
use App\Dto\ChurchDto;
use App\Models\Church;
use Illuminate\Support\Collection;

interface IChurch
{
    public function getChurches(): Collection;
    public function createChurch(ChurchDto $dto): Church;
    public function showChurch(Church $church): Church;
    public function updateChurch(Church $church, ChurchDto $dto): Church;
    public function deleteChurch(Church $church): bool;
}
