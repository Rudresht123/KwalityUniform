<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'school_name'    => trim($this->school_name),
            'principal_name' => trim($this->principal_name),
            'email'          => strtolower(trim($this->email)),
            'city'           => trim($this->city),
            'state'          => trim($this->state),
            'affiliation_no' => trim($this->affiliation_no),
        ]);
    }

    public function rules(): array
    {
        return [
            'school_board_id' => [
                'required',
                'exists:school_boards,id',
            ],

            'school_name' => [
                'required',
                'string',
                'max:200',
                'unique:schools,school_name',
            ],

            'principal_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:schools,email',
            ],

            'phone' => [
                'required',
                'digits_between:10,15',
            ],

            'address' => [
                'required',
                'string',
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
                'digits_between:5,10',
            ],

            'affiliation_no' => [
                'nullable',
                'string',
                'max:30',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'school_name.required' => 'School name is required.',
            'school_name.unique'   => 'School name already exists.',

            'email.required'       => 'Email is required.',
            'email.unique'         => 'Email already exists.',

            'phone.required'       => 'Phone number is required.',
            'phone.digits_between' => 'Phone number must be between 10 and 15 digits.',

            'pincode.required'     => 'Pincode is required.',
            'pincode.digits_between' => 'Invalid pincode.',

            'logo.image'           => 'Please upload a valid image.',
        ];
    }
}