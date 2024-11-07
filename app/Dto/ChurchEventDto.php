<?php

namespace App\Dto;
use App\Http\Requests\ChurchEvent\ChurchEventCreateRequest;
use App\Http\Requests\ChurchEvent\ChurchEventUpdateRequest;

class ChurchEventDto
{
    public function __construct(public string $name)
    {
    }

    private static function fromRequest(ChurchEventCreateRequest|ChurchEventUpdateRequest $request): self
    {
        return new self(name: $request->validated('name'));
    }

    public static function createRequest(ChurchEventCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(ChurchEventUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }
}
