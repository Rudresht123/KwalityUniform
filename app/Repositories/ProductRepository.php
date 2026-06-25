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
            return $query;
        }

        if ($user->hasRole('vendor')) {
            // Vendor sees only their own products
            return $query->where('vendor_id', $user->vendor?->vendor_id);
        }

        // Admin sees all approved products (or as per permission)
        return $query;
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
}
