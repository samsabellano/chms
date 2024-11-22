<?php

namespace App\Services;
use App\Dto\MemberDto;
use App\Interfaces\IMember;
use App\Models\Address;
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
        $member = Member::create([
            'user_id' => $dto->user,
            'occupation_id' => $dto->occupation,
            'workplace_id' => $dto->workplace,
            'first_name' => $dto->firstName,
            'middle_name' => $dto->middleName,
            'last_name' => $dto->lastName,
            'suffix' => $dto->suffix,
            'photo' => $dto->photo,
            'birth_date' => $dto->birthDate,
            'age' => $dto->age,
            'civil_status' => $dto->civilStatus,
            'gender' => $dto->gender,
            'contact_number' => $dto->contactNumber
        ]);

        Address::create([
            'member_id' => $member->id,
            'address_line_1' => $dto->lineAddress1,
            'address_line_2' => $dto->lineAddress2,
            'barangay' => $dto->barangay,
            'city_or_municipality' => $dto->cityOrMunicipality,
            'state_or_province' => $dto->stateOrProvince,
            'country' => $dto->country,
            'postal_code' => $dto->postalCode
        ]);

        return $member;
    }

    public function showMember(Member $member): Member
    {
        return $member;
    }

    public function updateMember(Member $member, MemberDto $dto): Member
    {
        return tap($member, function (Member $member) use ($dto) {
            $member->update([
                'user_id' => $dto->user,
                'occupation_id' => $dto->occupation,
                'workplace_id' => $dto->workplace,
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
            ]);

            $member->address->update([
                'address_line_1' => $dto->lineAddress1,
                'address_line_2' => $dto->lineAddress2,
                'barangay' => $dto->barangay,
                'city_or_municipality' => $dto->cityOrMunicipality,
                'state_or_province' => $dto->stateOrProvince,
                'country' => $dto->country,
                'postal_code' => $dto->postalCode,
            ]);
        });
    }

    public function deleteMember(Member $member): bool
    {
        return $member->delete();
    }
}