<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorSchoolTieup extends Model
{
    protected $fillable = [
        'vendor_id', 
        'school_id', 
        'main_category_id', 
        'status', 
        'remarks', 
        'approved_by', 
        'approved_at',
        'rejected_at'
    ];

    public function vendor(): BelongsTo {
        return $this->belongsTo(\App\Models\SuperAdmin\Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function school(): BelongsTo {
        return $this->belongsTo(\App\Models\SuperAdmin\School::class, 'school_id', 'school_id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(\App\Models\SuperAdmin\Category::class, 'main_category_id', 'category_id');
    }
}
