<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Record;

class ProductAssignment extends Record
{
    protected $table = 'product_assignments';

    protected $fillable = [
        'product_id',
        'assignment_type',
        'section_id',
    ];

    /**
     * Get the product assigned.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /**
     * Get the section this product is assigned to.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(SchoolSection::class, 'section_id', 'id');
    }
}
