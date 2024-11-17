<?php

namespace App\Http\Resources\Member;

use App\Http\Resources\Occupation\OccupationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform t he resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'nameInitial' => $this->nameInitial,
            'photo' => $this->photo,
            'birthDate' => $this->birth_date,
            'age' => $this->age,
            'civilStatus' => $this->civil_status,
            'gender' => $this->gender,
            'contactNumber' => $this->contact_number,
            'address' => $this->address,
            'createdAt' => $this->created_at,
            'user' => $this->user,
            'occupation' => $this->occupation,
            'workplace' => $this->workplace,
            'company' => $this->company,
            'baptism' => $this->baptism,
            $this->collection
        ];
    }
}
