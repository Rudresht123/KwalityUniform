<?php

namespace App\Repositories;

use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\StockAdjustment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class StockRepository
{
    public function getVariantsQuery()
    {
        $query = ProductVariant::with(['product', 'size', 'color']);
        $user = Auth::user();

        if ($user && $user->hasRole('vendor')) {
            $query->whereHas('product', function ($q) use ($user) {
                $q->where('vendor_id', $user->vendor?->vendor_id);
            });
        }

        return $query;
    }

    public function findVariantById(string $variantId)
    {
        return ProductVariant::findOrFail($variantId);
    }

    public function createAdjustment(array $data)
    {
        return StockAdjustment::create($data);
    }

    public function getAdjustmentHistory(string $variantId)
    {
        return StockAdjustment::where('variant_id', $variantId)->latest()->get();
    }
}
