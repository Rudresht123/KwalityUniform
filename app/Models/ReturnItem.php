<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnItem extends Model
{
    protected $table = 'return_items';

    protected $fillable = [
        'return_id',
        'order_item_id',
        'quantity',
        'reason',
    ];

    public function returnRequest(): BelongsTo
    {
        return $this->belongsTo(\App\Models\OrderReturn::class, 'return_id');
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }
}
