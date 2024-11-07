<?php

namespace App\Dto;
use App\Http\Requests\Occupation\OccupationCreateRequest;
use App\Http\Requests\Occupation\OccupationUpdateRequest;

class OccupationDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(public string $name)
    {
    }

    private static function fromRequest(OccupationCreateRequest|OccupationUpdateRequest $request): self
    {
        return new self(name: $request->validated('name'));
    }

    public static function createRequest(OccupationCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(OccupationUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }
}
