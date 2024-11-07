<?php

namespace App\Services;
use App\Dto\GroupDto;
use App\Interfaces\IGroup;
use App\Models\Group;
use Illuminate\Support\Collection;

class GroupService implements IGroup
{
    public function getGroups(): Collection
    {
        return Group::all();
    }

    public function createGroup(GroupDto $dto): Group
    {
        return Group::create([
            'name' => $dto->name,
            'visibility' => $dto->visibility
        ]);
    }

    public function showGroup(Group $group): Group
    {
        return $group;
    }

    public function updateGroup(Group $group, GroupDto $dto): Group
    {
        return tap($group)->update([
            'name' => $dto->name,
            'visibility' => $dto->visibility
        ]);
    }

    public function deleteGroup(Group $group): bool
    {
        return $group->delete();
    }
}
