<?php

namespace App\Models;

use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'vendor_id',
        'product_name',
        'sku',
        'image',
        'unit_price',
        'quantity',
        'discount_amount',
        'tax_amount',
        'line_total',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function shipmentItem(): HasOne
    {
        return $this->hasOne(ShipmentItem::class);
    }

    public function studentDistribution(): HasOne
    {
        return $this->hasOne(StudentDistribution::class);
    }
}
