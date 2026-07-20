<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        // 1. If WebUser, they can view their own
        if ($user->hasRole('user') || $user->hasRole('parent')) {
            return $user->id === $order->user_id;
        }

        // 2. If School Admin, check if order items are linked to their school
        if ($user->hasRole('school')) {
            return $order->items()
                ->join('product_variants', 'order_items.variant_id', '=', 'product_variants.variant_id')
                ->join('products', 'product_variants.product_id', '=', 'products.product_id')
                ->join('school_product_approvals', 'products.product_id', '=', 'school_product_approvals.product_id')
                ->where('school_product_approvals.school_id', $user->school_id)
                ->exists();
        }

        // 3. SuperAdmin/Admin can view all
        return $user->hasRole(['super-admin', 'admin']);
    }

    /**
     * Determine whether the user can download the invoice.
     */
    public function downloadInvoice(User $user, Order $order): bool
    {
        return $this->view($user, $order);
    }

    /**
     * Determine whether the user can email the invoice.
     */
    public function emailInvoice(User $user, Order $order): bool
    {
        return $user->id === $order->user_id || $user->hasRole(['super-admin', 'admin']);
    }

    public function confirmDelivery(User $user, Order $order): bool
    {
        return $user->hasRole('school') && $this->view($user, $order) && $order->status->value === 'delivered';
    }

    public function raiseReturnRequest(User $user, Order $order): bool
    {
        return $user->hasRole('school') && $this->view($user, $order) && in_array($order->status->value, ['delivered', 'completed']);
    }
}
