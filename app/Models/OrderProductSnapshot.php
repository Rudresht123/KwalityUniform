<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderProductSnapshot extends Model
{
    protected $table = 'order_product_snapshots';
    protected $primaryKey = 'snapshot_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'snapshot_id',
        'order_item_id',
        'product_id',
        'vendor_id',
        'category_name',
        'brand_name',
        'product_name',
        'description',
        'sku',
        'gender',
        'material',
        'specifications',
        'selling_price',
        'original_price',
        'discount_amount',
        'tax_amount',
        'size_name',
        'color_name',
        'variant_details',
        'thumbnail_url',
        'image_urls',
        'school_name',
        'delivery_info',
    ];

    protected $casts = [
        'specifications' => 'array',
        'variant_details' => 'array',
        'image_urls' => 'array',
        'delivery_info' => 'array',
        'selling_price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->snapshot_id) {
                $model->snapshot_id = (string) Str::uuid();
            }
        });
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SuperAdmin\Product::class, 'product_id', 'product_id');
    }
}
