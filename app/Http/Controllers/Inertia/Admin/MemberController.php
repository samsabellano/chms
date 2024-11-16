<?php

namespace App\Http\Controllers\Inertia\Admin;

use App\Dto\MemberDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Resources\Member\MemberResource;
use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\Request;
use Log;

class MemberController extends Controller
{
    public function __construct(private MemberService $memberService)
    {
    }

    public function index()
    {
        $members = $this->memberService->getMembers();
        return inertia("admin/member/Index", [
            'members' => MemberResource::collection($members)
        ]);
    }

    public function createMember()
    {
        return inertia("admin/member/CreateMember");
    }

    public function storeMember(MemberRequest $request)
    {
        $this->memberService->createMember(
            MemberDto::fromCreateRequest($request)
        );
    }

    public function deleteMember(Member $member)
    {
        try {
            $this->memberService->deleteMember($member);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
