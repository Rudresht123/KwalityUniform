<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Color extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'colors';
    protected $primaryKey = 'color_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'color_id',
        'color_name',
        'hex_code',
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
            if (!$model->color_id) {
                $model->color_id = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'color_id';
    }
}
