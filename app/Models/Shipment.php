<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    use HasUuid;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'vendor_id',
        'tracking_number',
        'courier_id',
        'shipment_type', // bulk, individual
        'origin_address_id',
        'destination_address_id',
        'status',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'status' => ShipmentStatus::class,
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ShipmentItem::class);
    }

    public function schoolDistribution(): HasOne
    {
        return $this->hasOne(SchoolDistribution::class);
    }
}
