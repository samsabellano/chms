<?php

namespace App\Http\Controllers\Api;

use App\Dto\WorkplaceDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workplace\WorkplaceCreateRequest;
use App\Http\Requests\Workplace\WorkplaceUpdateRequest;
use App\Http\Resources\Workplace\WorkplaceResource;
use App\Models\Workplace;
use App\Services\WorkplaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkplaceController extends Controller
{
    public function __construct(private WorkplaceService $workplaceService)
    {
    }

    public function getAllWorkplace()
    {
        $workplaces = $this->workplaceService->getWorkplaces();
        return WorkplaceResource::collection($workplaces);
    }

    public function createWorkplace(WorkplaceCreateRequest $request): JsonResponse
    {
        $workplace = $this->workplaceService->createWorkplace(
            WorkplaceDto::createRequest($request)
        );

        if ($workplace) {
            return response()->json([
                'message' => 'Workplace created successfully',
                'data' => WorkplaceResource::make($workplace)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create occupation'], 400);
    }

    public function showWorkplace(Workplace $workplace): WorkplaceResource
    {
        return WorkplaceResource::make(
            $this->workplaceService->showWorkplace($workplace)
        );
    }

    public function updateWorkplace(WorkplaceUpdateRequest $request, Workplace $workplace): JsonResponse
    {
        $updatedWorkplace = $this->workplaceService->updateWorkplace(
            $workplace,
            WorkplaceDto::updateRequest($request)
        );

        if ($updatedWorkplace) {
            return response()->json([
                'message' => 'Workplace updated successfully',
                'data' => WorkplaceResource::make($updatedWorkplace)
            ], 200);
        }

        return response()->json(['message' => 'Faiuled to update workplace']);
    }

    public function deleteWorkplace(Workplace $workplace): JsonResponse
    {
        $deletedWorkplace = $this->workplaceService->deleteWorkplace($workplace);

        if ($deletedWorkplace) {
            return response()->json(['message' => 'Workplace deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete workplace'], 400);
    }
}
