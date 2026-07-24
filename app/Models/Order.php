<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\DeliveryType;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
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
        'student_id',
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
        'placed_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class,"school_id","school_id");
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
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,"vendor_id","vendor_id");
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id',"id");
    }
}
