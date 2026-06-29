<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolProductStandardApproval extends Model
{
    protected $fillable = [
        'school_product_approval_id',
        'standard_id',
    ];

    /**
     * Get the parent school product approval.
     */
    public function schoolProductApproval(): BelongsTo
    {
        return $this->belongsTo(SchoolProductApproval::class, 'school_product_approval_id', 'school_product_approval_id');
    }

    /**
     * Get the associated school standard.
     */
    public function schoolStandard(): BelongsTo
    {
        return $this->belongsTo(SchoolStandard::class, 'standard_id', 'id');
    }
}
