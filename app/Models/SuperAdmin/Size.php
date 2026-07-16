<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Size extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'sizes';
    protected $primaryKey = 'size_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'size_id',
        'vendor_id',
        'size_name',
        'display_name',
        'sort_order',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->size_id) {
                $model->size_id = (string) Str::uuid();
            }
        });
    }
public function getRouteKeyName()
{
    return 'size_id';
}

public function vendor()
{
    return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
}

public function scopeForVendor($query, $vendorId)
{
    return $query->where('vendor_id', $vendorId);
}

public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
