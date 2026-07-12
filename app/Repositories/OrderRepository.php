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

    /**
     * Get system-wide revenue trend for the last X days.
     */
    public function getRevenueTrend(int $days = 30): array
    {
        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = (float) Order::whereDate('created_at', $date->toDateString())->sum('grand_total');
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get system-wide order volume trend for the last X days.
     */
    public function getOrderTrend(int $days = 30): array
    {
        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = Order::whereDate('created_at', $date->toDateString())->count();
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get the latest orders for the operations list.
     */
    public function getLatestOrders(int $limit = 10)
    {
        return Order::with('user')->latest()->take($limit)->get();
    }

    /**
     * Get daily revenue trend for a specific vendor.
     */
    public function getVendorRevenueTrend(int $vendorId, int $days = 30): array
    {
        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = (float) \App\Models\OrderItem::where('vendor_id', $vendorId)
                ->whereDate('created_at', $date->toDateString())
                ->sum('line_total');
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get daily order volume trend for a specific vendor.
     */
    public function getVendorOrderTrend(int $vendorId, int $days = 30): array
    {
        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = \App\Models\OrderItem::where('vendor_id', $vendorId)
                ->whereDate('created_at', $date->toDateString())
                ->distinct('order_id')
                ->count();
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get daily order stats for a specific vendor.
     */
    public function getVendorOrderStats($vendorId): array
    {
        $today = now()->startOfDay();
        return [
            'orders_today' => \App\Models\OrderItem::where('vendor_id', $vendorId)
                ->whereDate('created_at', $today)
                ->distinct('order_id')
                ->count(),
            'revenue_today' => \App\Models\OrderItem::where('vendor_id', $vendorId)
                ->whereDate('created_at', $today)
                ->sum('line_total'),
            'total_revenue' => \App\Models\OrderItem::where('vendor_id', $vendorId)
                ->sum('line_total'),
        ];
    }
}

