<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolProductClassApproval extends Model
{
    protected $table = 'school_product_class_approvals';

    protected $fillable = [
        'school_product_approval_id',
        'class_id',
    ];

    /**
     * Get the parent school product approval.
     */
    public function schoolProductApproval(): BelongsTo
    {
        return $this->belongsTo(SchoolProductApproval::class, 'school_product_approval_id', 'school_product_approval_id');
    }

    /**
     * Get the associated school class.
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }
}
