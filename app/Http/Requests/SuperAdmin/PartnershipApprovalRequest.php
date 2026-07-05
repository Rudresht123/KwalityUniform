<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class PartnershipApprovalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('partnership.approve');
    }

    public function rules(): array
    {
        return [];
    }
}
