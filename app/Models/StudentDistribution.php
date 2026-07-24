<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDistribution extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'delivered_at' => 'datetime',
    ];

    protected $fillable = [
        'order_item_id',
        'status',
        'delivered_at',
        'collected_by',
    ];

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function student(){
        return $this->belongsTo(User::class,"collected_by","id");
    }
}
