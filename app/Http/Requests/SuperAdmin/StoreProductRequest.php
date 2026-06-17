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
        $isVendor = auth()->user()->hasRole('vendor');

        return [
            'vendor_id' => $isVendor ? 'nullable|uuid|exists:vendors,vendor_id' : 'required|uuid|exists:vendors,vendor_id',
            'category_id' => 'required|uuid|exists:categories,category_id',
            'product_code' => 'required|string|max:50|unique:products,product_code',
            'product_name' => 'required|string|max:200',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'fabric_composition' => 'nullable|string|max:255',
            'gender_type' => 'required|in:boys,girls,unisex',
            'approval_status' => $isVendor ? 'nullable|in:pending,approved,rejected' : 'required|in:pending,approved,rejected',
            'is_active' => 'required|boolean',

            // Variants Validation
            'variants' => 'required|array|min:1',
            'variants.*.sku' => 'required|string|max:60|unique:product_variants,sku',
            'variants.*.size_id' => 'nullable|uuid|exists:sizes,size_id',
            'variants.*.color_id' => 'nullable|uuid|exists:colors,color_id',
            'variants.*.mrp' => 'required|numeric|min:0',
            'variants.*.selling_price' => 'required|numeric|min:0|lte:variants.*.mrp',
            'variants.*.stock_qty' => 'required|integer|min:0',
            'variants.*.low_stock_alert' => 'required|integer|min:0',
            'variants.*.barcode' => 'nullable|string|max:60|unique:product_variants,barcode',
            'variants.*.is_active' => 'required|boolean',
        ];
    }
}
