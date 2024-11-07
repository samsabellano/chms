<?php

namespace App\Http\Controllers\Api;

use App\Dto\GroupDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Group\GroupCreateRequest;
use App\Http\Requests\Group\GroupUpdateRequest;
use App\Http\Resources\Group\GroupResource;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    public function __construct(private GroupService $groupService)
    {
    }

    public function getAllGroups(): mixed
    {
        $groups = $this->groupService->getGroups();
        return GroupResource::collection($groups);
    }

    public function createGroup(GroupCreateRequest $request): JsonResponse
    {
        $group = $this->groupService->createGroup(
            GroupDto::createRequest($request)
        );

        if ($group) {
            return response()->json([
                'message' => 'Group created sucessfully',
                'data' => GroupResource::make($group)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create group'], 400);
    }

    public function showGroup(Group $group): GroupResource
    {
        return GroupResource::make(
            $this->groupService->showGroup($group)
        );
    }

    public function updateGroup(GroupUpdateRequest $request, Group $group): JsonResponse
    {
        $updatedGroup = $this->groupService->updateGroup(
            $group,
            GroupDto::updateRequest($request)
        );

        if ($updatedGroup) {
            return response()->json([
                'message' => 'Group updated successfully',
                'data' => GroupResource::make($updatedGroup)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update group'], 400);
    }

    public function deleteGroup(Group $group): JsonResponse
    {
        $deletedGroup = $this->groupService->deleteGroup($group);

        if ($deletedGroup) {
            return response()->json(['message' => 'Group deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete a member.'], 400);
    }
}
