<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSizeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'size_name' => 'required|string|max:20|unique:sizes,size_name',
            'display_name' => 'required|string|max:30',
            'sort_order' => 'required|integer',
            'is_active' => 'required|boolean',
        ];
    }
}
