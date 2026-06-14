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
            'business_name' => [
                'required',
                'string',
                'max:150',
                'unique:vendors,business_name',
            ],
            'owner_name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:150',
                'unique:vendors,email',
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
            'gstin' => [
                'nullable',
                'string',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
            ],
            'pan_number' => [
                'nullable',
                'string',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            ],
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
            'commission_rate' => [
                'nullable',
                'numeric',
                'between:0,100',
            ],
            'status' => [
                'required',
                Rule::in(['pending', 'approved', 'suspended']),
            ],
           'is_active' => [
    'required',
    'in:0,1',
],
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            // Business Name
            'business_name.required' => 'Business name is required.',
            'business_name.string' => 'Business name must be text.',
            'business_name.max' => 'Business name cannot exceed 150 characters.',
            'business_name.unique' => 'This business name is already registered in our system.',

            // Owner Name
            'owner_name.required' => 'Owner name is required.',
            'owner_name.string' => 'Owner name must be text.',
            'owner_name.max' => 'Owner name cannot exceed 100 characters.',

            // Email
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 150 characters.',
            'email.unique' => 'This email address is already registered with another vendor.',

            // Phone
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please enter a valid phone number (10-15 digits).',

            // Address
            'address.required' => 'Complete address is required.',
            'address.string' => 'Address must be text.',
            'address.max' => 'Address cannot exceed 500 characters.',

            // City
            'city.required' => 'City name is required.',
            'city.string' => 'City must be text.',
            'city.max' => 'City name cannot exceed 80 characters.',

            // State
            'state.required' => 'State name is required.',
            'state.string' => 'State must be text.',
            'state.max' => 'State name cannot exceed 80 characters.',

            // Pincode
            'pincode.required' => 'Pincode is required.',
            'pincode.regex' => 'Pincode must be 5-10 digits.',

            // GSTIN
            'gstin.regex' => 'Please enter a valid GSTIN (15 characters: 2 digits, 5 letters, 4 digits, 1 letter, 1 alphanumeric, Z, 1 alphanumeric).',

            // PAN Number
            'pan_number.regex' => 'Please enter a valid PAN number (5 letters followed by 4 digits and 1 letter).',

            // Bank Account Number
            'bank_account_no.regex' => 'Please enter a valid bank account number (9-18 digits).',

            // IFSC Code
            'ifsc_code.regex' => 'Please enter a valid IFSC code (e.g., SBIN0000123).',

            // Commission Rate
            'commission_rate.numeric' => 'Commission rate must be a number.',
            'commission_rate.between' => 'Commission rate must be between 0 and 100.',

            // Status
            'status.required' => 'Vendor status is required.',
            'status.in' => 'Please select a valid status (Pending, Approved, or Suspended).',

            // Logo
            'logo.image' => 'Logo must be an image file.',
            'logo.mimes' => 'Logo must be in JPEG, PNG, JPG, or GIF format.',
            'logo.max' => 'Logo file cannot exceed 2MB.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'commission_rate' => $this->commission_rate ?? 0,
            'status' => $this->status ?? 'pending',
        ]);
    }
}
