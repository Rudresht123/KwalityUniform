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
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the user can download the invoice.
     */
    public function downloadInvoice(User $user, Order $order): bool
    {
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the user can email the invoice.
     */
    public function emailInvoice(User $user, Order $order): bool
    {
        return $user->id === $order->user_id;
    }
}
