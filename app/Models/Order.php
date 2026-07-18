<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\DeliveryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'school_id',
        'vendor_id',
        'cart_id',
        'delivery_type',
        'status',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'shipping_charge',
        'grand_total',
        'customer_note',
        'placed_at',
        'delivered_at',
        'payment_status',
    ];

    protected $casts = [
        'delivery_type' => DeliveryType::class,
        'status' => OrderStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingAddress(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'shipping');
    }

    public function status(){
        $this->status;
    }

    public function shipments()
    {
        return $this->belongsToMany(Shipment::class, 'shipment_items', 'order_item_id', 'shipment_id')
            ->withPivot('quantity_shipped');
    }
}
