<?php

namespace App\Services;
use App\Dto\RelationshipDto;
use App\Interfaces\IRelationship;
use App\Models\Relationship;
use Illuminate\Support\Collection;

class RelationshipService implements IRelationship
{
    public function getRelationships(): Collection
    {
        return Relationship::all();
    }

    public function createRelationship(RelationshipDto $dto): Relationship
    {
        return Relationship::create(['name' => $dto->name]);
    }

    public function showRelationship(Relationship $relationship): Relationship
    {
        return $relationship;
    }

    public function updateRelationship(Relationship $relationship, RelationshipDto $dto): Relationship
    {
        return tap($relationship)->update(['name' => $dto->name]);
    }

    public function deleteRelationship(Relationship $relationship): bool
    {
        return $relationship->delete();
    }
}
