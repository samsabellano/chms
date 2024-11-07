<?php

namespace App\Interfaces;
use App\Dto\GroupDto;
use App\Models\Group;
use Illuminate\Support\Collection;

interface IGroup
{
    public function getGroups(): Collection;
    public function createGroup(GroupDto $dto): Group;
    public function showGroup(Group $group): Group;
    public function updateGroup(Group $group, GroupDto $groupDto): Group;
    public function deleteGroup(Group $group): bool;
}
