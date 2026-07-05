<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'category',
        'email',
        'gstin',
        'address',
        'city',
        'state',
        'pincode',
        'pan_number',
        'bank_account_no',
        'ifsc_code',
        'document_path',
        'status',
    ];
}
