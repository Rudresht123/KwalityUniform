<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        $isVendor = auth()->user()->hasRole('vendor');

        return [

            // Basic Information
            'vendor_id' => $isVendor
                ? 'nullable|uuid|exists:vendors,vendor_id'
                : 'required|uuid|exists:vendors,vendor_id',

            'category_id' => 'required|uuid|exists:categories,category_id',

            'product_code' => 'required|string|max:50|unique:products,product_code',

            'product_name' => 'required|string|max:200',

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:products,slug',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            ],

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string|max:160',

            'meta_keywords' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'fabric_composition' => 'nullable|string|max:255',

            'gender_type' => 'required|in:boys,girls,unisex',

            'approval_status' => $isVendor
                ? 'nullable|in:pending,approved,rejected'
                : 'required|in:pending,approved,rejected',

            'is_active' => 'required|boolean',

            // Images
            'images' => 'nullable|array',

            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:51200',

            // Variants
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

    /**
     * Handle PHP upload errors before validation.
     */
    protected function prepareForValidation(): void
    {
        if (!$this->hasFile('images')) {
            return;
        }

        foreach ($this->file('images') as $index => $file) {

            if ($file->getError() === UPLOAD_ERR_INI_SIZE) {
                throw ValidationException::withMessages([
                    "images.$index" => [
                        'The image "' . $file->getClientOriginalName() . '" exceeds the maximum upload size allowed by the server.'
                    ]
                ]);
            }

            if ($file->getError() !== UPLOAD_ERR_OK) {
                throw ValidationException::withMessages([
                    "images.$index" => [
                        'Failed to upload "' . $file->getClientOriginalName() . '". Please try again.'
                    ]
                ]);
            }
        }
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [

            // Product
            'vendor_id.required' => 'Please select a vendor.',
            'category_id.required' => 'Please select a category.',

            'product_code.required' => 'Product code is required.',
            'product_code.unique' => 'This product code already exists.',

            'product_name.required' => 'Product name is required.',

            'slug.required' => 'Product slug is required.',
            'slug.unique' => 'This slug already exists.',
            'slug.regex' => 'Slug may only contain lowercase letters, numbers and hyphens.',

            'meta_title.max' => 'Meta title may not exceed 255 characters.',
            'meta_description.max' => 'Meta description may not exceed 160 characters.',
            'meta_keywords.max' => 'Meta keywords may not exceed 255 characters.',

            'gender_type.required' => 'Please select a gender type.',

            // Images
            'images.array' => 'Please upload valid images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Only JPEG, JPG, PNG and WEBP images are allowed.',
            'images.*.max' => 'Each image must not exceed 50 MB.',

            // Variants
            'variants.required' => 'Please add at least one product variant.',
            'variants.min' => 'At least one product variant is required.',

            'variants.*.sku.required' => 'SKU is required.',
            'variants.*.sku.unique' => 'This SKU already exists.',

            'variants.*.mrp.required' => 'MRP is required.',
            'variants.*.selling_price.required' => 'Selling price is required.',
            'variants.*.selling_price.lte' => 'Selling price cannot be greater than MRP.',

            'variants.*.stock_qty.required' => 'Stock quantity is required.',
            'variants.*.low_stock_alert.required' => 'Low stock alert quantity is required.',
        ];
    }

    /**
     * Handle upload errors after validation.
     */
    protected function failedValidation(Validator $validator)
    {
        foreach ($this->allFiles() as $key => $file) {

            $files = is_array($file) ? $file : [$file];

            foreach ($files as $index => $uploadedFile) {

                if ($uploadedFile instanceof \Illuminate\Http\UploadedFile &&
                    $uploadedFile->getError() !== UPLOAD_ERR_OK) {

                    $message = match ($uploadedFile->getError()) {
                        UPLOAD_ERR_INI_SIZE,
                        UPLOAD_ERR_FORM_SIZE => 'The uploaded file "' . $uploadedFile->getClientOriginalName() . '" exceeds the maximum allowed file size.',

                        UPLOAD_ERR_PARTIAL => 'The file "' . $uploadedFile->getClientOriginalName() . '" was only partially uploaded.',

                        UPLOAD_ERR_NO_FILE => 'No file was uploaded.',

                        default => 'Failed to upload "' . $uploadedFile->getClientOriginalName() . '".',
                    };

                    throw ValidationException::withMessages([
                        "$key.$index" => [$message],
                    ]);
                }
            }
        }

        parent::failedValidation($validator);
    }
}