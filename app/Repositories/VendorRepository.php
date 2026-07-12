<?php

namespace App\Repositories;

use App\Models\SuperAdmin\Vendor;
use Illuminate\Database\Eloquent\Collection;

class VendorRepository
{
    /**
     * Get top vendors by product count.
     */
    public function getTopVendorsByProducts(int $limit = 5): Collection
    {
        return Vendor::withCount('products')->orderByDesc('products_count')->take($limit)->get();
    }

    /**
     * Get the most recently added vendors.
     */
    public function getRecentVendors(int $limit = 10): Collection
    {
        return Vendor::latest()->take($limit)->get();
    }
}
