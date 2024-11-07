<?php

namespace App\Dto;
use App\Http\Requests\Relationship\RelationshipCreateRequest;
use App\Http\Requests\Relationship\RelationshipUpdateRequest;

class RelationshipDto
{
    public function __construct(public string $name)
    {
    }

    private static function fromRequest(RelationshipCreateRequest|RelationshipUpdateRequest $request): self
    {
        return new self(name: $request->validated('name'));
    }

    public static function createRequest(RelationshipCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(RelationshipUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }
}
