<?php

namespace App\Http\Controllers\Api;

use App\Dto\RelationshipDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Relationship\RelationshipCreateRequest;
use App\Http\Requests\Relationship\RelationshipUpdateRequest;
use App\Http\Resources\Relationship\RelationshipResource;
use App\Models\Relationship;
use App\Services\RelationshipService;
use Illuminate\Http\JsonResponse;

class RelationshipController extends Controller
{
    public function __construct(private RelationshipService $relationshipService)
    {
    }

    public function getAllRelationships(): mixed
    {
        $relationships = $this->relationshipService->getRelationships();
        return RelationshipResource::collection($relationships);
    }

    public function createRelationship(RelationshipCreateRequest $request): JsonResponse
    {
        $relationship = $this->relationshipService->createRelationship(
            RelationshipDto::createRequest($request)
        );

        if ($relationship) {
            return response()->json([
                'message' => 'Relationship created successfully',
                'data' => RelationshipResource::make($relationship)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create relationship'], 400);
    }

    public function showRelationship(Relationship $relationship): RelationshipResource
    {
        return RelationshipResource::make(
            $this->relationshipService->showRelationship($relationship)
        );
    }

    public function updateRelationship(RelationshipUpdateRequest $request, Relationship $relationship): JsonResponse
    {
        $updatedRelationship = $this->relationshipService->updateRelationship(
            $relationship,
            RelationshipDto::updateRequest($request)
        );

        if ($updatedRelationship) {
            return response()->json([
                'message' => 'Relationship updated successfully',
                'data' => RelationshipResource::make($updatedRelationship)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update relationship'], 400);
    }

    public function deleteRelationship(Relationship $relationship): JsonResponse
    {
        $deletedRelationship = $this->relationshipService->deleteRelationship($relationship);

        if ($deletedRelationship) {
            return response()->json(['message' => 'Relationship deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete relationship.'], 400);
    }
}
