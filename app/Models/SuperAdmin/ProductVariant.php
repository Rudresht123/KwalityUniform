<?php

namespace App\Models\SuperAdmin;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductVariant extends Record
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_variants';
    protected $primaryKey = 'variant_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'variant_id',
        'product_id',
        'sku',
        'size_id',
        'color_id',
        'mrp',
        'selling_price',
        'stock_qty',
        'low_stock_alert',
        'barcode',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'mrp' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'stock_qty' => 'integer',
        'low_stock_alert' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (!$model->variant_id) {
                $model->variant_id = (string) Str::uuid();
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
        return 'variant_id';
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
