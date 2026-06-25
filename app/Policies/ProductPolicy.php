<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SuperAdmin\Product;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view the approval queue.
     */
    public function viewAnyApprovalQueue(User $user): bool
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }

        return $user->hasPermissionTo('product_approval_view');
    }

    /**
     * Determine whether the user can perform approval actions (approve/reject).
     */
    public function actionApproval(User $user): bool
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }

        return $user->hasPermissionTo('product_approval_action');
    }

    /**
     * Determine whether the user can view a specific product.
     */
    public function view(User $user, Product $product): bool
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }

        if ($user->hasRole('vendor')) {
            return $user->vendor?->vendor_id === $product->vendor_id;
        }

        return $user->hasPermissionTo('product.view');
    }

    /**
     * Determine whether the user can update a product.
     */
    public function update(User $user, Product $product): bool
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }

        if ($user->hasRole('vendor')) {
            return $user->vendor?->vendor_id === $product->vendor_id;
        }

        return $user->hasPermissionTo('product.edit');
    }

    /**
     * Determine whether the user can delete a product.
     */
    public function delete(User $user, Product $product): bool
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }

        if ($user->hasRole('vendor')) {
            return $user->vendor?->vendor_id === $product->vendor_id;
        }

        return $user->hasPermissionTo('product.delete');
    }
}
