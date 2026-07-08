<?php

namespace App\Models;

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
        // Assuming ProductVariant model exists
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
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
