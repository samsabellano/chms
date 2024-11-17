<?php

namespace App\Services;
use App\Dto\MemberDto;
use App\Interfaces\IMember;
use App\Models\Member;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MemberService implements IMember
{
    public function getMembers(): Collection|LengthAwarePaginator
    {
        return Member::get()->sortByDesc('created_at');
    }

    public function createMember(MemberDto $dto): Member
    {
        return Member::create([
            'user_id' => $dto->user,
            'occupation_id' => $dto->occupation,
            'workplace_id' => $dto->workplace,
            'company_id' => $dto->company,
            'first_name' => $dto->firstName,
            'middle_name' => $dto->middleName,
            'last_name' => $dto->lastName,
            'suffix' => $dto->suffix,
            'photo' => $dto->photo,
            'birth_date' => $dto->birthDate,
            'age' => $dto->age,
            'civil_status' => $dto->civilStatus,
            'gender' => $dto->gender,
            'contact_number' => $dto->contactNumber,
            'address' => $dto->address
        ]);
    }

    public function showMember(Member $member): Member
    {
        return $member;
    }

    public function updateMember(Member $member, MemberDto $dto): Member
    {
        return tap($member)->update([
            'user_id' => $dto->user,
            'occupation_id' => $dto->occupation,
            'workplace_id' => $dto->workplace,
            'company_id' => $dto->company,
            'first_name' => $dto->firstName,
            'middle_name' => $dto->middleName,
            'last_name' => $dto->lastName,
            'suffix' => $dto->suffix,
            'photo' => $dto->photo,
            'birth_date' => $dto->birthDate,
            'age' => $dto->age,
            'civil_status' => $dto->civilStatus,
            'gender' => $dto->gender,
            'contact_number' => $dto->contactNumber,
            'address' => $dto->address
        ]);
    }

    public function deleteMember(Member $member): bool
    {
        return $member->delete();
    }
}