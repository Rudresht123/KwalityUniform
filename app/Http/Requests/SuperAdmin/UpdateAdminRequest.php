<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'username' => 'required|string|max:50|unique:users,username,' . $this->admin->id,
            'email' => 'required|email|max:150|unique:users,email,' . $this->admin->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $this->admin->id,
            'password' => 'nullable|string|min:8',
            'is_active' => 'required|boolean',
        ];
    }
}
