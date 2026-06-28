<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Record;

class SchoolSection extends Record
{
    protected $table = 'school_sections';

    protected $fillable = [
        'school_id',
        'standard_id',
        'section_name',
        'is_active',
    ];

    /**
     * Get the school that owns the section.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    /**
     * Get the standard that owns the section.
     */
    public function standard(): BelongsTo
    {
        return $this->belongsTo(SchoolStandard::class, 'standard_id', 'id');
    }

    /**
     * Get the product assignments for this section.
     */
    public function productAssignments(): HasMany
    {
        return $this->hasMany(ProductAssignment::class, 'section_id', 'id');
    }
}
