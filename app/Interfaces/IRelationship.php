<?php

namespace App\Interfaces;
use App\Dto\RelationshipDto;
use App\Models\Relationship;
use Illuminate\Support\Collection;

interface IRelationship
{
    public function getRelationships(): Collection;
    public function createRelationship(RelationshipDto $dto): Relationship;
    public function showRelationship(Relationship $relationship): Relationship;
    public function updateRelationship(Relationship $relationship, RelationshipDto $dto): Relationship;
    public function deleteRelationship(Relationship $relationship): bool;
}
