<?php

namespace App\Dto;
use App\Enums\GroupVisibility;
use App\Http\Requests\Group\GroupCreateRequest;
use App\Http\Requests\Group\GroupUpdateRequest;

class GroupDto
{
    public function __construct(
        public string $name,
        public string $visibility
    ) {
    }

    private static function fromRequest(GroupCreateRequest|GroupUpdateRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            visibility: $request->validated('visibility')
        );
    }

    public static function createRequest(GroupCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(GroupUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }
}
