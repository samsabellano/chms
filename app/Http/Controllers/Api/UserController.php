<?php

namespace App\Http\Controllers\Api;

use App\Dto\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAuthRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\AuthResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function getAllUsers(): mixed
    {
        $users = $this->userService->getUsers();
        return UserResource::collection($users);
    }

    public function createUser(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->createUser(
            UserDto::createRequest($request)
        );

        if ($user) {
            return response()->json([
                'message' => 'User account created successfully',
                'data' => UserResource::make($user)
            ]);
        }

        return response()->json(['message' => 'Failed to craete a user account'], 400);
    }

    public function showUser(User $user): UserResource
    {
        return UserResource::make(
            $this->userService->showUser($user)
        );
    }

    public function updateUser(UserUpdateRequest $request, User $user): JsonResponse
    {
        $updatedUser = $this->userService->updateUser(
            $user,
            UserDto::updateRequest($request)
        );

        if ($updatedUser) {
            return response()->json([
                'message' => 'User updated successfully',
                'data' => UserResource::make($updatedUser)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update user'], 400);
    }

    public function deleteUser(User $user)
    {
        $deletedUser = $this->userService->deleteUser($user);

        if ($deletedUser) {
            return response()->json(['message' => 'User deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete user.'], 400);
    }

    public function loginUser(UserAuthRequest $request): AuthResource|JsonResponse
    {
        $user = $this->userService->authenticateUser(
            UserDto::fromAuthRequest($request)
        );

        if ($user) {
            return AuthResource::make($user)
                ->additional([
                    'token' => $user->createToken($user->email)->plainTextToken
                ]);
        }

        return response()->json(['message' => 'Incorrect credentials'], 401);
    }

    public function logoutUser(Request $request): JsonResponse
    {
        $this->userService->logoutUser($request);
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
