<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'parent_id',
        'category_name',
        'requires_size',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'requires_size' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->category_id) {
                $model->category_id = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'category_id';
    }

    public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class, 'parent_id', 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
