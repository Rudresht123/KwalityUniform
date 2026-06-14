<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->category_id;

        return [
            'category_name' => ['required', 'string', 'max:80', 'unique:categories,category_name,' . $categoryId . ',category_id'],
            'parent_id'     => ['required', 'uuid', 'exists:parent_categories,parent_id'],
            'requires_size' => ['required', 'boolean'],
            'is_active'     => ['required', 'boolean'],
        ];
    }
}
