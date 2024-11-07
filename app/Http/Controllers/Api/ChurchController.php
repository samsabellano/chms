<?php

namespace App\Http\Controllers\Api;

use App\Dto\ChurchDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Church\ChurchCreateRequest;
use App\Http\Requests\Church\ChurchUpdateRequest;
use App\Http\Resources\Church\ChurchResource;
use App\Models\Church;
use App\Services\ChurchService;
use Illuminate\Http\JsonResponse;

class ChurchController extends Controller
{
    public function __construct(private ChurchService $churchService)
    {
    }

    public function getChurches()
    {
        $churches = $this->churchService->getChurches();
        return ChurchResource::collection($churches);
    }

    public function createChurch(ChurchCreateRequest $request)
    {
        $church = $this->churchService->createChurch(
            ChurchDto::createRequest($request)
        );

        if ($church) {
            return response()->json([
                'message' => 'Church created successfully',
                'data' => ChurchResource::make($church)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create church'], 400);
    }

    public function showChurch(Church $church): ChurchResource
    {
        return ChurchResource::make(
            $this->churchService->showChurch($church)
        );
    }

    public function updateChurch(ChurchUpdateRequest $request, Church $church): JsonResponse
    {
        $updatedChurch = $this->churchService->updateChurch(
            $church,
            ChurchDto::updateRequest($request)
        );

        if ($updatedChurch) {
            return response()->json([
                'message' => 'Church udpated successfully',
                'data' => ChurchResource::make($updatedChurch)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update church'], 400);
    }

    public function deleteChurch(Church $church): JsonResponse
    {
        $deletedChurch = $this->churchService->deleteChurch($church);

        if ($deletedChurch) {
            return response()->json(['message' => 'Church deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete church'], 400);
    }
}
