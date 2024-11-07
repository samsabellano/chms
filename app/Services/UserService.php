<?php

namespace App\Services;
use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers(): Collection
    {
        return User::all();
    }

    public function createUser(UserDto $dto): User
    {
        return User::create([
            'email' => $dto->email,
            'password' => $dto->password,
            'role' => $dto->role
        ]);
    }

    public function showUser(User $user): User
    {
        return $user;
    }

    public function updateUser(User $user, UserDto $dto): User
    {
        return tap($user)->update([
            'email' => $dto->email,
            'password' => $dto->password,
            'role' => $dto->role
        ]);
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }

    public function authenticateUser(UserDto $dto): ?User
    {
        $user = User::where('email', $dto->email)->first();
        if ($user && Hash::check($dto->password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function logoutUser(Request $request): void
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
        }
    }
}
