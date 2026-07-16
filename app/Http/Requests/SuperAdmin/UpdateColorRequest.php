<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'color_name' => 'required|string|max:40|unique:colors,color_name',
            'hex_code' => 'nullable|string|max:10',
            'is_active' => 'required|boolean',
        ];
    }
}
