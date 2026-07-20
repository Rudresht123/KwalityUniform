<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ParentCategory extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'parent_categories';
    protected $primaryKey = 'parent_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'parent_id',
        'vendor_id',
        'name',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        parent::booted();
        static::addGlobalScope(new VendorScope);

        static::creating(function ($model) {
            if (!$model->parent_id) {
                $model->parent_id = (string) Str::uuid();
            }
            if (!$model->vendor_id && Auth::check() && Auth::user()->hasRole('Vendor') && Auth::user()->vendor) {
                $model->vendor_id = Auth::user()->vendor->vendor_id;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'parent_id';
    }
public function subCategories()
{
    return $this->hasMany(Category::class, 'parent_id', 'parent_id');
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
