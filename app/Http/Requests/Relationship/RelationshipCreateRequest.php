<?php

namespace App\Http\Requests\Relationship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RelationshipCreateRequest extends FormRequest
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
                'min:2',
                'max:40',
                Rule::unique('relationships', 'name')
            ]
        ];
    }
}
