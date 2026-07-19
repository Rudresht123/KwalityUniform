<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSizeRequest extends FormRequest
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
            'size_name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('sizes', 'size_name'),
            ],

            'display_name' => [
                'required',
                'string',
                'max:30',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * 
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            // Size Name
            'size_name.required' => 'Size name is required.',
            'size_name.string' => 'Size name must be valid text.',
            'size_name.max' => 'Size name cannot exceed 20 characters.',
            'size_name.unique' => 'This size already exists.',

            // Display Name
            'display_name.required' => 'Display name is required.',
            'display_name.string' => 'Display name must be valid text.',
            'display_name.max' => 'Display name cannot exceed 30 characters.',

            // Sort Order
            'sort_order.required' => 'Sort order is required.',
            'sort_order.integer' => 'Sort order must be a valid number.',
            'sort_order.min' => 'Sort order cannot be negative.',

            // Status
            'is_active.required' => 'Please select the status.',
            'is_active.boolean' => 'Invalid status selected.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => filter_var(
                $this->is_active,
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE
            ) ?? $this->is_active,
        ]);
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'size_name' => 'size name',
            'display_name' => 'display name',
            'sort_order' => 'sort order',
            'is_active' => 'status',
        ];
    }
}