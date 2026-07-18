<?php

namespace App\Models;

use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolVendorMapping extends Model
{
    use HasUuid;

    protected $fillable = [
        'school_id',
        'vendor_id',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }
}
