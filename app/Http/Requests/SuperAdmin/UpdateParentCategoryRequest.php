<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $parentId = $this->route('parent_category')->parent_id;

        return [
            'name'      => ['required', 'string', 'max:80'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
