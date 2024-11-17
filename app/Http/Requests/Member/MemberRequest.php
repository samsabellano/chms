<?php

namespace App\Http\Requests\Member;

use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Enums\Suffix;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class MemberRequest extends FormRequest
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
            'user' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id')
            ],
            'occupation' => [
                'nullable',
                'integer',
                Rule::exists('occupations', 'id')
            ],
            'workplace' => [
                'nullable',
                'integer',
                Rule::exists('workplaces', 'id')
            ],
            'company' => [
                'nullable',
                'integer',
                Rule::exists('companies', 'id')
            ],
            'first_name' => [
                'required',
                'min:2',
                'max:100'
            ],
            'middle_name' => [
                'nullable',
                'string',
                'min:2',
                'max:50'
            ],
            'last_name' => [
                'required',
                'min:2',
                'max:100'
            ],
            'birth_date' => [
                'required',
                'date'
            ],
            'age' => [
                'nullable',
                'integer'
            ],
            'contact_number' => [
                'nullable',
                'string',
                'max:12'
            ],
            'address' => [
                'required',
                'string'
            ],
            'suffix' => [
                'nullable',
                'string',
                Rule::enum(Suffix::class)
            ],
            'gender' => [
                'required',
                'string',
                Rule::enum(Gender::class)
            ],
            'civil_status' => [
                'required',
                'string',
                Rule::enum(CivilStatus::class)
            ],
            'photo' => [
                'nullable',
                File::image()
            ],

        ];
    }
}
