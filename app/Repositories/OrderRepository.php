<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository
{
    /**
     * Get confirmed orders for a specific school.
     */
    public function getConfirmedOrdersBySchool(string $schoolId): Collection
    {
        return Order::where('school_id', $schoolId)
            ->where('status', 'confirmed')
            ->with(['items.product', 'items.variant'])
            ->get();
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(string $orderId, string $status): bool
    {
        return Order::where('id', $orderId)->update(['status' => $status]);
    }

    /**
     * Get paginated orders for a specific user.
     */
    public function getOrdersForUser(string $userId, int $perPage = 10, ?string $search = null, ?string $status = null): LengthAwarePaginator
    {
        $query = Order::where('user_id', $userId)
            ->with(['items.product', 'items.variant']);

        if ($search) {
            $query->where('order_number', 'like', '%' . $search . '%');
        }

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get a single order with all necessary details for invoices and history.
     */
    public function getOrderWithDetails(string $orderId): ?Order
    {
        return Order::with(['items.product', 'items.variant', 'user'])
            ->where('id', $orderId)
            ->first();
    }
}
