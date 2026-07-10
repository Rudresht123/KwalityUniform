<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class WishlistItem extends Model
{
    protected $primaryKey = 'wishlist_item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'product_id',
        'variant_id',
    ];

    protected static function booted()
    {
        static::creating(function ($wishlistItem) {
            if (empty($wishlistItem->wishlist_item_id)) {
                $wishlistItem->wishlist_item_id = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        // We use the SuperAdmin Product model as that's where the core product data lives
        return $this->belongsTo(\App\Models\SuperAdmin\Product::class, 'product_id', 'product_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(\App\Models\SuperAdmin\ProductVariant::class, 'variant_id', 'variant_id');
    }
}
