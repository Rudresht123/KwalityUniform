<?php

namespace App\Services;

use App\Models\Partnership;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\School;
use Illuminate\Database\Eloquent\Collection;

class CatalogService
{
    /**
     * Determine the active vendor for a school and category.
     * Returns null if no active partnership is found.
     */
    public function getActiveVendor(School $school, Category $category): ?Vendor
    {
        $partnership = Partnership::where('school_id', $school->id)
            ->where('category_id', $category->category_id)
            ->where('status', 'active')
            ->first();

        return $partnership?->vendor;
    }

    /**
     * Get products for the active vendor in a category.
     */
    public function getActiveProducts(School $school, Category $category): Collection
    {
        $vendor = $this->getActiveVendor($school, $category);

        return Product::where('vendor_id', $vendor->vendor_id)
            ->where('category_id', $category->category_id)
            ->where('is_active', true)
            ->where('approval_status', 'approved')
            ->get();
    }
}
