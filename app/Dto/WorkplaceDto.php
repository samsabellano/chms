<?php

namespace App\Dto;
use App\Http\Requests\Workplace\WorkplaceCreateRequest;
use App\Http\Requests\Workplace\WorkplaceUpdateRequest;

class WorkplaceDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public string $address
    ) {
    }

    private static function fromRequest(WorkplaceCreateRequest|WorkplaceUpdateRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            address: $request->validated('address')
        );
    }

    public static function createRequest(WorkplaceCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(WorkplaceUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }
}
