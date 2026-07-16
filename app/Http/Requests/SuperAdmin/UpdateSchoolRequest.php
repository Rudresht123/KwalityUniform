<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSchoolRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $schoolId = $this->route('school') instanceof \App\Models\SuperAdmin\School 
            ? $this->route('school')->school_id 
            : $this->route('school');

        return [
            'school_name' => [
                'required',
                'string',
                'max:200',
                Rule::unique('schools', 'school_name')->ignore($schoolId, 'school_id'),
            ],
            'principal_name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:150',
                Rule::unique('schools', 'email')->ignore($schoolId, 'school_id'),
            ],
            'phone' => [
                'required',
                'regex:/^[0-9\s\-\+\(\)]{10,15}$/',
            ],
            'address' => [
                'required',
                'string',
                'max:500',
            ],
            'city' => [
                'required',
                'string',
                'max:80',
            ],
            'state' => [
                'required',
                'string',
                'max:80',
            ],
            'pincode' => [
                'required',
                'string',
                'regex:/^[0-9]{5,10}$/',
            ],
            'affiliation_no' => [
                'nullable',
                'string',
                'max:30',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ];
    }
}
