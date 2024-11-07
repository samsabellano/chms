<?php

namespace App\Interfaces;
use App\Dto\MemberDto;
use App\Models\Member;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IMember
{
    public function getMembers(): Collection|LengthAwarePaginator;
    public function createMember(MemberDto $dto): Member;
    public function showMember(Member $member): Member;
    public function updateMember(Member $member, MemberDto $dto): Member;
    public function deleteMember(Member $member): bool;
}
