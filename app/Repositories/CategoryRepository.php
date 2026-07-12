<?php

namespace App\Repositories;

use App\Models\SuperAdmin\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    /**
     * Get top categories by product count.
     */
    public function getTopCategories(int $limit = 5): Collection
    {
        return Category::withCount('products')->orderBy('products_count', 'desc')->take($limit)->get();
    }

    /**
     * Get product counts grouped by Parent Category.
     */
    public function getParentCategoryProductCounts($vendorId = null): array
    {
        $query = DB::table('parent_categories')
            ->leftJoin('categories', 'parent_categories.parent_id', '=', 'categories.parent_id')
            ->leftJoin('products', function ($join) use ($vendorId) {
                $join->on('categories.category_id', '=', 'products.category_id');

                if ($vendorId) {
                    $join->where('products.vendor_id', $vendorId);
                }
            })
            ->select('parent_categories.parent_id', 'parent_categories.name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('parent_categories.parent_id', 'parent_categories.name')
            ->orderBy('parent_categories.name');

        return $query->get()->toArray();
    }

    /**
     * Get product counts grouped by Category.
     */
    public function getCategoryProductCounts($vendorId = null): array
    {
        $query = DB::table('categories')
            ->leftJoin('products', function ($join) use ($vendorId) {
                $join->on('categories.category_id', '=', 'products.category_id');

                if ($vendorId) {
                    $join->where('products.vendor_id', $vendorId);
                }
            })
            ->select('categories.category_id', 'categories.category_name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('categories.category_id', 'categories.category_name')
            ->orderBy('categories.category_name');

        return $query->get()->toArray();
    }
}
