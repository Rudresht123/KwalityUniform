<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => ['required', 'string', 'max:80'],
            'parent_id'     => ['required', 'uuid', 'exists:parent_categories,parent_id'],
            'requires_size' => ['required', 'boolean'],
            'is_active'     => ['required', 'boolean'],
        ];
    }
}
