<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ParentCategory extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'parent_categories';
    protected $primaryKey = 'parent_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'parent_id',
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->parent_id) {
                $model->parent_id = (string) Str::uuid();
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
