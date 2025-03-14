<?php

namespace App\Dto;
use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Enums\Suffix;
use App\Http\Requests\Member\MemberRequest;
use App\Models\Baptism;
use App\Models\Company;
use App\Models\Occupation;
use App\Models\User;
use App\Models\Workplace;
use App\Traits\FileUpload;
use Illuminate\Support\Carbon;

readonly class MemberDto
{
    use FileUpload;

    public function __construct(
        public User|int|null $user,
        public Occupation|int|null $occupation,
        public Workplace|int|null $workplace,
        public string $firstName,
        public ?string $middleName,
        public string $lastName,
        public ?string $suffix,
        public ?string $photo,
        public ?Carbon $birthDate,
        public ?int $age,
        public CivilStatus|string $civilStatus,
        public Gender|string $gender,
        public ?string $contactNumber,
        public string $lineAddress1,
        public ?string $lineAddress2,
        public string $barangay,
        public string $cityOrMunicipality,
        public string $stateOrProvince,
        public string $country,
        public string $postalCode
    ) {
    }

    public static function fromCreateRequest(MemberRequest $request): self
    {
        return new self(
            user: $request->validated('user'),
            occupation: $request->validated('occupation'),
            workplace: $request->validated('workplace'),
            firstName: $request->validated('first_name'),
            middleName: $request->validated('middle_name'),
            lastName: $request->validated('last_name'),
            suffix: $request->validated('suffix'),
            photo: static::uploadImage($request->validated('photo')),
            birthDate: Carbon::parse($request->validated('birth_date')),
            age: $request->validated('age'),
            civilStatus: $request->validated('civil_status'),
            gender: $request->validated('gender'),
            contactNumber: $request->validated('contact_number'),
            lineAddress1: $request->validated('address_line_1'),
            lineAddress2: $request->validated('address_line_2'),
            barangay: $request->validated('barangay'),
            cityOrMunicipality: $request->validated('city_or_municipality'),
            stateOrProvince: $request->validated('state_or_province'),
            country: $request->validated('country'),
            postalCode: $request->validated('postal_code')
        );
    }
}