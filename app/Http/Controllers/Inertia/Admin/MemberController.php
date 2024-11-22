<?php

namespace App\Http\Controllers\Inertia\Admin;

use App\Dto\MemberDto;
use App\Enums\Gender;
use App\Enums\Suffix;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRequest;
use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Occupation\OccupationResource;
use App\Http\Resources\Workplace\WorkplaceResource;
use App\Models\Member;
use App\Services\MemberService;
use App\Services\OccupationService;
use App\Services\WorkplaceService;
use Illuminate\Http\Request;
use Log;

class MemberController extends Controller
{
    public function __construct(
        private MemberService $memberService,
        private OccupationService $occupationService,
        private WorkplaceService $workplaceService
    ) {
    }

    public function index()
    {
        $members = MemberResource::collection($this->memberService->getMembers());

        return inertia("admin/member/Index", [
            'members' => $members
        ]);
    }

    public function createMember()
    {
        $suffixes = Suffix::cases();
        $genders = Gender::cases();
        $occupations = OccupationResource::collection($this->occupationService->getOccupations());
        $workplaces = WorkplaceResource::collection($this->workplaceService->getWorkplaces());

        return inertia("admin/member/CreateMember", [
            'suffixes' => $suffixes,
            'genders' => $genders,
            'occupations' => $occupations,
            'workplaces' => $workplaces
        ]);
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
