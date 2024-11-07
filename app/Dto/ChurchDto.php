<?php

namespace App\Dto;
use App\Http\Requests\Church\ChurchCreateRequest;
use App\Http\Requests\Church\ChurchUpdateRequest;

class ChurchDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public string $address
    ) {
    }

    private static function fromRequest(ChurchCreateRequest|ChurchUpdateRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            address: $request->validated('address')
        );
    }

    public static function createRequest(ChurchCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(ChurchUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }

}
