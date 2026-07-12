<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class StockAdjustment extends Record
{
    use HasFactory;

    protected $table = 'stock_adjustments';
    protected $primaryKey = 'adjustment_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'adjustment_id',
        'variant_id',
        'old_stock',
        'added_quantity',
        'new_stock',
        'remarks',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->adjustment_id) {
                $model->adjustment_id = (string) Str::uuid();
            }
        });
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
