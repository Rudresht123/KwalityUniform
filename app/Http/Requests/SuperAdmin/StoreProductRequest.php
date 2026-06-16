<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendor_id' => 'required|uuid|exists:vendors,vendor_id',
            'category_id' => 'required|uuid|exists:categories,category_id',
            'product_code' => 'required|string|max:50|unique:products,product_code',
            'product_name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'fabric_composition' => 'nullable|string|max:255',
            'gender_type' => 'required|in:boys,girls,unisex',
            'approval_status' => 'required|in:pending,approved,rejected',
            'is_active' => 'required|boolean',
        ];
    }
}
