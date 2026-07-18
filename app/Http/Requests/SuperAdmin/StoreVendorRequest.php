<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVendorRequest extends FormRequest
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
        return [
            // Business Information
            'business_name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('vendors', 'business_name'),
            ],

            'owner_name' => [
                'required',
                'string',
                'max:100',
            ],

            // Contact Information
            'email' => [
                'required',
                'email:rfc,dns',
                'max:150',
                Rule::unique('vendors', 'email'),
                Rule::unique('users', 'email'),
            ],

            'phone' => [
                'required',
                'regex:/^[0-9\s\-\+\(\)]{10,15}$/',
                Rule::unique('vendors', 'phone'),
                Rule::unique('users', 'phone'),
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

            // Tax Information
            'gstin' => [
                'nullable',
                'string',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
                Rule::unique('vendors', 'gstin'),
            ],

            'pan_number' => [
                'nullable',
                'string',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                Rule::unique('vendors', 'pan_number'),
            ],

            // Bank Details
            'bank_account_no' => [
                'nullable',
                'string',
                'regex:/^[0-9]{9,18}$/',
            ],

            'ifsc_code' => [
                'nullable',
                'string',
                'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            ],

            // Business Settings
            'commission_rate' => [
                'nullable',
                'numeric',
                'between:0,100',
            ],

            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'approved',
                    'suspended',
                ]),
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

            // Logo
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            // Business Name
            'business_name.required' => 'Business name is required.',
            'business_name.string' => 'Business name must be text.',
            'business_name.max' => 'Business name cannot exceed 150 characters.',
            'business_name.unique' => 'This business name is already registered.',

            // Owner Name
            'owner_name.required' => 'Owner name is required.',
            'owner_name.string' => 'Owner name must be text.',
            'owner_name.max' => 'Owner name cannot exceed 100 characters.',

            // Email
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address cannot exceed 150 characters.',
            'email.unique' => 'This email address is already associated with another account.',

            // Phone
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please enter a valid phone number (10-15 digits).',
            'phone.unique' => 'This phone number is already associated with another account.',

            // Address
            'address.required' => 'Address is required.',
            'address.string' => 'Address must be valid text.',
            'address.max' => 'Address cannot exceed 500 characters.',

            // City
            'city.required' => 'City is required.',
            'city.string' => 'City must be valid text.',
            'city.max' => 'City cannot exceed 80 characters.',

            // State
            'state.required' => 'State is required.',
            'state.string' => 'State must be valid text.',
            'state.max' => 'State cannot exceed 80 characters.',

            // Pincode
            'pincode.required' => 'Pincode is required.',
            'pincode.regex' => 'Please enter a valid pincode.',

            // GST
            'gstin.regex' => 'Please enter a valid GSTIN.',
            'gstin.unique' => 'This GSTIN is already registered.',

            // PAN
            'pan_number.regex' => 'Please enter a valid PAN number.',
            'pan_number.unique' => 'This PAN number is already registered.',

            // Bank
            'bank_account_no.regex' => 'Please enter a valid bank account number.',
            'ifsc_code.regex' => 'Please enter a valid IFSC code.',

            // Commission
            'commission_rate.numeric' => 'Commission rate must be numeric.',
            'commission_rate.between' => 'Commission rate must be between 0 and 100.',

            // Status
            'status.required' => 'Vendor status is required.',
            'status.in' => 'Please select a valid vendor status.',

            // Active
            'is_active.required' => 'Please select vendor status.',
            'is_active.boolean' => 'Invalid active status selected.',

            // Logo
            'logo.image' => 'Logo must be an image.',
            'logo.mimes' => 'Logo must be a JPEG, JPG, PNG, GIF or WEBP image.',
            'logo.max' => 'Logo size must not exceed 2 MB.',
        ];
    }

    /**
     * Prepare data before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'commission_rate' => $this->commission_rate ?? 0,
            'status'          => $this->status ?? 'pending',
            'is_active'       => filter_var($this->is_active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $this->is_active,
        ]);
    }

    /**
     * Friendly attribute names.
     */
    public function attributes(): array
    {
        return [
            'business_name'   => 'business name',
            'owner_name'      => 'owner name',
            'email'           => 'email address',
            'phone'           => 'phone number',
            'gstin'           => 'GSTIN',
            'pan_number'      => 'PAN number',
            'bank_account_no' => 'bank account number',
            'ifsc_code'       => 'IFSC code',
            'commission_rate' => 'commission rate',
            'is_active'       => 'active status',
        ];
    }
}