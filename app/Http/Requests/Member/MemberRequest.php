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
                'max:100'
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
                'max:11'
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

            // Address
            'address_line_1' => [
                'required',
                'string',
                'min:2',
                'max:100'
            ],
            'address_line_2' => [
                'nullable',
                'string',
                'min:2',
                'max:100'
            ],
            'barangay' => [
                'required',
                'string',
                'min:2',
                'max:50'
            ],
            'city_or_municipality' => [
                'required',
                'string',
                'min:2',
                'max:50'
            ],
            'state_or_province' => [
                'required',
                'string',
                'min:2',
                'max:50'
            ],
            'country' => [
                'required',
                'string',
                'min:2',
                'max:50'
            ],
            'postal_code' => [
                'required',
                'string',
                'min:4',
                'max:7'
            ],
        ];
    }
}
