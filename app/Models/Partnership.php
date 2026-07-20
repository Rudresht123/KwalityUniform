<?php

namespace App\Models;

use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\Category;
use App\Traits\HasUuid;
use App\Traits\LogsAllActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partnership extends Model
{
    use HasFactory, HasUuid, LogsAllActivity;

    protected $fillable = [
        'school_id',
        'vendor_id',
        'category_id',
        'status',
        'remarks',
        'approved_at',
        'approved_by',
        'ended_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
