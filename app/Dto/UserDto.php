<?php

namespace App\Dto;
use App\Enums\Role;
use App\Http\Requests\User\UserAuthRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public string $password,
        public Role|string $role
    ) {
    }

    private static function fromRequest(
        UserCreateRequest|UserUpdateRequest|UserAuthRequest $request
    ): self {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password'),
            role: $request->validated('role')
        );
    }

    public static function createRequest(UserCreateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function updateRequest(UserUpdateRequest $request): self
    {
        return self::fromRequest($request);
    }

    public static function fromAuthRequest(UserAuthRequest $request): self
    {
        return self::fromRequest($request);
    }
}
