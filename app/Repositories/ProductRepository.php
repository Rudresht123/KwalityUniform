<?php

namespace App\Repositories;

use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    /**
     * Get products based on user role and visibility rules.
     */
    public function getVisibleProducts(Builder $query = null)
    {
        $query = $query ?: Product::query();
        $user = Auth::user();

        if (!$user) {
            return $query->where('approval_status', 'approved')->get();
        }

        if ($user->hasRole('super-admin')) {
            // Super Admin sees everything
            return $query->get();
        }

        if ($user->hasRole('vendor')) {
            // Vendor sees only their own products
            return $query->where('vendor_id', $user->vendor?->vendor_id)->get();
        }

        // Admin sees all approved products (or as per permission)
        return $query->get();
    }

    public function findById(string $id)
    {
        return Product::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $product = $this->findById($id);
        $product->update($data);
        return $product;
    }

    public function delete(string $id)
    {
        return Product::destroy($id);
    }

    public function getFeaturedProducts($limit = 8)
    {
        return Product::approved()->active()->latest()->take($limit)->get();
    }

    public function searchProducts(array $filters = [])
    {
        // Force school selection: if school is not provided or is 'all'/'generic', return empty results.
        if (empty($filters['school']) || $filters['school'] === 'all' || $filters['school'] === 'generic') {
            return collect(); 
        }

        $query = Product::approved()->active();

        $query->whereHas('schoolApprovals', function ($q) use ($filters) {
            $q->where('school_id', $filters['school']);
        });

        if (!empty($filters['standard']) && $filters['standard'] !== 'all') {
            $query->whereHas('schoolApprovals.standardApprovals', function ($q) use ($filters) {
                $q->where('standard_id', $filters['standard']);
            });
        }

        if (!empty($filters['class']) && $filters['class'] !== 'all') {
            $query->whereHas('schoolApprovals.classApprovals', function ($q) use ($filters) {
                $q->where('school_class_id', $filters['class']);
            });
        }

        if (!empty($filters['sub_category']) && $filters['sub_category'] !== 'all') {
            $query->where('category_id', $filters['sub_category']);
        } elseif (!empty($filters['parent_category']) && $filters['parent_category'] !== 'all') {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('parent_id', $filters['parent_category']);
            });
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('product_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->latest()->paginate(12);
    }
}
