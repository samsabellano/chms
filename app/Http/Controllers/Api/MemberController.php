<?php

namespace App\Http\Controllers\Api;

use App\Dto\MemberDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Resources\Member\MemberResource;
use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
    public function __construct(private MemberService $memberService)
    {
    }

    public function getAllMembers(): mixed
    {
        $members = $this->memberService->getMembers();
        return MemberResource::collection($members);
    }

    public function createMember(MemberRequest $request): JsonResponse
    {
        $member = $this->memberService->createMember(
            MemberDto::fromCreateRequest($request)
        );

        if ($member) {
            return response()->json([
                'message' => 'Member created successfully',
                'data' => MemberResource::make($member)
            ], 201);
        }

        return response()->json(['message' => 'Failed to create member'], 400);
    }

    public function showMember(Member $member): MemberResource
    {
        return MemberResource::make(
            $this->memberService->showMember($member)
        );
    }

    public function updateMember(MemberRequest $request, Member $member): JsonResponse
    {
        $updatedMember = $this->memberService->updateMember(
            $member,
            MemberDto::fromCreateRequest($request)
        );

        if ($updatedMember) {
            return response()->json([
                'message' => 'Member updated successfully',
                'data' => MemberResource::make($updatedMember)
            ], 200);
        }

        return response()->json(['message' => 'Failed to update member'], 400);
    }

    public function deleteMember(Member $member): JsonResponse
    {
        $deletedMember = $this->memberService->deleteMember($member);

        if ($deletedMember) {
            return response()->json(['message' => 'Member deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete the member.'], 400);
    }
}
