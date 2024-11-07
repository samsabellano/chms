<?php

namespace App\Http\Controllers\Api;

use App\Dto\OccupationDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Occupation\OccupationCreateRequest;
use App\Http\Requests\Occupation\OccupationUpdateRequest;
use App\Http\Resources\Occupation\OccupationResource;
use App\Models\Occupation;
use App\Services\OccupationService;
use Illuminate\Http\JsonResponse;

class OccupationController extends Controller
{
    public function __construct(private OccupationService $occupationService)
    {
    }

    public function getAllOccupations(): mixed
    {
        $occupations = $this->occupationService->getOccupations();
        return OccupationResource::collection($occupations);
    }

    public function createOccupation(OccupationCreateRequest $request): JsonResponse
    {
        $occupation = $this->occupationService->createOccupation(
            OccupationDto::createRequest($request)
        );

        if ($occupation) {
            return response()->json([
                'message' => 'Occupation created successfully',
                'data' => OccupationResource::make($occupation)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create occupation'], 400);
    }

    public function showOccupation(Occupation $occupation): OccupationResource
    {
        return OccupationResource::make(
            $this->occupationService->showOccupation($occupation)
        );
    }

    public function updateOccupation(OccupationUpdateRequest $request, Occupation $occupation): JsonResponse
    {
        $updatedOccupation = $this->occupationService->updateOccupation(
            $occupation,
            OccupationDto::updateRequest($request)
        );

        if ($updatedOccupation) {
            return response()->json([
                'message' => 'Occupation updated successfully',
                'data' => OccupationResource::make($updatedOccupation)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update occupation'], 400);
    }

    public function deleteOccupation(Occupation $occupation): JsonResponse
    {
        $deletedMember = $this->occupationService->deleteOccupation($occupation);

        if ($deletedMember) {
            return response()->json(['message' => 'Occupation deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete the Occupation.'], 400);
    }
}
