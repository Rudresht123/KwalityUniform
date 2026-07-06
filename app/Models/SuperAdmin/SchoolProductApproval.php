<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SchoolProductApproval extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'school_product_approvals';
    protected $primaryKey = 'school_product_approval_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'school_product_approval_id',
        'school_id',
        'product_id',
        'status',
        'rejection_reason',
        'actioned_by',
        'actioned_at',
        'deleted_by'
    ];

    protected $casts = [
        'actioned_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->school_product_approval_id) {
                $model->school_product_approval_id = (string) Str::uuid();
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
        return 'school_product_approval_id';
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function actor()
    {
        return $this->belongsTo(\App\Models\User::class, 'actioned_by');
    }

    /**
     * Get the standards this product is approved for within the school.
     */
    public function standardApprovals()
    {
        return $this->hasMany(SchoolProductStandardApproval::class, 'school_product_approval_id', 'school_product_approval_id');
    }

    /**
     * Get the classes this product is approved for within the school.
     */
    public function classApprovals()
    {
        return $this->hasMany(SchoolProductClassApproval::class, 'school_product_approval_id', 'school_product_approval_id');
    }
}
