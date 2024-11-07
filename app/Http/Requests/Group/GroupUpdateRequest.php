<?php

namespace App\Http\Requests\Group;

use App\Enums\GroupVisibility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('groups', 'name')
                    ->ignore($this->group->id)
            ],
            'visibility' => [
                'required',
                Rule::enum(GroupVisibility::class)
            ]
        ];
    }
}
