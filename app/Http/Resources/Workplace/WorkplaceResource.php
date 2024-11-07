<?php

namespace App\Http\Resources\Workplace;

use App\Http\Resources\Member\MemberResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkplaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'members' => $this->members
        ];
    }
}
