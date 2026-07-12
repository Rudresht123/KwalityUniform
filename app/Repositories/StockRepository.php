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

    /**
     * Get critical inventory alerts.
     */
    public function getInventoryAlerts(int $limit = 5)
    {
        return ProductVariant::whereRaw('stock_qty <= low_stock_alert')
            ->with('product')
            ->orderBy('stock_qty', 'asc')
            ->take($limit)
            ->get();
    }

    /**
     * Get detailed inventory summary.
     */
    public function getInventorySummary($vendorId = null): array
    {
        $query = ProductVariant::query();

        if ($vendorId) {
            $query->whereHas('product', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            });
        }

        return [
            'total_stock_qty' => (int) (clone $query)->sum('stock_qty'),
            'total_variants' => (clone $query)->count(),
            'out_of_stock_count' => (clone $query)->where('stock_qty', 0)->count(),
            'low_stock_count' => (clone $query)->where('stock_qty', '>', 0)->whereColumn('stock_qty', '<=', 'low_stock_alert')->count(),
            'healthy_stock_count' => (clone $query)->whereColumn('stock_qty', '>', 'low_stock_alert')->count(),
        ];
    }
}

