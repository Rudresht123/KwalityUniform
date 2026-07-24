<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Product extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['product_id', 'vendor_id', 'category_id', 'product_code', 'product_name', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'description', 'fabric_composition', 'gender_type', 'approval_status', 'approved_by', 'approved_at', 'rejected_by', 'rejected_at', 'rejection_reason', 'is_active', 'created_by', 'updated_by', 'deleted_by'];


    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->product_id) {
                $model->product_id = (string) Str::uuid();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'product_id';
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    public function approvalHistories()
    {
        return $this->hasMany(ProductApprovalHistory::class, 'product_id', 'product_id')->latest();
    }

    public function schoolApprovals()
    {
        return $this->hasMany(SchoolProductApproval::class, 'product_id', 'product_id');
    }

    /**
     * Get the assignments for this product.
     */
    public function productAssignments()
    {
        return $this->hasMany(ProductAssignment::class, 'product_id', 'product_id');
    }

    public function primaryImage()

    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id')->where('is_primary', true);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function firstImage()
    {
        return $this->primaryImage ? getFileUrl($this->primaryImage->file_id) : asset("assets/images/no_image.jpg");
    }

    public function scopeAuthorizedForSchool($query, $schoolId)
    {
        return $query->whereHas('vendor', function($q) use ($schoolId) {
            $q->whereHas('tieups', function($t) use ($schoolId) {
                $t->where('school_id', $schoolId)
                  ->where('status', 'approved');
            });
        })
        ->whereIn('category_id', function($q) use ($schoolId) {
            $q->select('main_category_id')
              ->from('vendor_school_tieups')
              ->where('school_id', $schoolId)
              ->where('status', 'approved');
        });
    }
}
