<?php

namespace App\Http\Controllers\Api;

use App\Dto\ChurchEventDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChurchEvent\ChurchEventCreateRequest;
use App\Http\Requests\ChurchEvent\ChurchEventUpdateRequest;
use App\Http\Resources\ChurchEvent\ChurchEventResource;
use App\Models\ChurchEvent;
use App\Services\ChurchEventService;
use Illuminate\Http\JsonResponse;

class ChurchEventController extends Controller
{
    public function __construct(private ChurchEventService $churchEventService)
    {
    }

    public function getAllChurchEvents(): mixed
    {
        $churchEvents = $this->churchEventService->getChurchEvents();
        return ChurchEventResource::collection($churchEvents);
    }

    public function createChurchEvent(ChurchEventCreateRequest $request): JsonResponse
    {
        $churchEvent = $this->churchEventService->createChurchEvent(
            ChurchEventDto::createRequest($request)
        );

        if ($churchEvent) {
            return response()->json([
                'message' => 'Church event created sucessfully',
                'data' => ChurchEventResource::make($churchEvent)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create a church event.'], 400);
    }

    public function showChurchEvent(ChurchEvent $churchEvent): ChurchEventResource
    {
        return ChurchEventResource::make(
            $this->churchEventService->showChurchEvent($churchEvent)
        );
    }

    public function updateChurchEvent(ChurchEventUpdateRequest $request, ChurchEvent $churchEvent): JsonResponse
    {
        $updatedGroup = $this->churchEventService->updateChurchEvent(
            $churchEvent,
            ChurchEventDto::updateRequest($request)
        );

        if ($updatedGroup) {
            return response()->json([
                'message' => 'Church event updated successfully',
                'data' => ChurchEventResource::make($updatedGroup)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update church event'], 400);
    }

    public function deleteChurchEvent(ChurchEvent $churchEvent): JsonResponse
    {
        $deletedChurchEvent = $this->churchEventService->deleteChurchEvent($churchEvent);

        if ($deletedChurchEvent) {
            return response()->json(['message' => 'Church event deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete church event.'], 400);
    }
}
