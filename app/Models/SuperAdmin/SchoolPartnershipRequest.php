<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'document_path',
        'status',
    ];
}
