<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Laravel\Reverb\Loggers\Log;

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
    public function updateStatus(string $orderId, \App\Enums\OrderStatus|string $status): bool
    {
        $statusValue = $status instanceof \App\Enums\OrderStatus ? $status->value : $status;
        return Order::where('id', $orderId)->update(['status' => $statusValue]);
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
public function getRevenueTrend(string $filter = 'month'): array
{
    return match ($filter) {
        'week'    => $this->getDailyRevenueTrend(7),
        'month'   => $this->getDailyRevenueTrend(30),
        'monthly' => $this->getMonthlyRevenueTrend(),
        'yearly'  => $this->getYearlyRevenueTrend(),
        default   => $this->getDailyRevenueTrend(30),
    };
}

/**
 * Daily Revenue Trend
 */
private function getDailyRevenueTrend(int $days): array
{
    $labels = [];
    $data   = [];

    for ($i = $days - 1; $i >= 0; $i--) {

        $date = now()->subDays($i);

        $labels[] = $date->format('d M');

        $data[] = (float) Order::whereDate('created_at', $date)
            ->sum('grand_total');
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

/**
 * Monthly Revenue Trend (Last 12 Months)
 */
private function getMonthlyRevenueTrend(): array
{
    $labels = [];
    $data   = [];

    for ($i = 11; $i >= 0; $i--) {

        $month = now()->subMonths($i);

        $labels[] = $month->format('M');

        $data[] = (float) Order::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->sum('grand_total');
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

/**
 * Yearly Revenue Trend (Last 5 Years)
 */
private function getYearlyRevenueTrend(): array
{
    $labels = [];
    $data   = [];

    for ($i = 4; $i >= 0; $i--) {

        $year = now()->subYears($i)->year;

        $labels[] = (string) $year;

        $data[] = (float) Order::whereYear('created_at', $year)
            ->sum('grand_total');
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}
    /**
     * Get system-wide order volume trend for the last X days.
     */
   public function getOrderTrend(string $filter = 'month'): array
{
    return match ($filter) {
        'week'    => $this->getSuperAdminDailyOrderTrend(7),
        'month'   => $this->getSuperAdminDailyOrderTrend(30),
        'monthly' => $this->getSuperAdminMonthlyOrderTrend(),
        'yearly'  => $this->getSuperAdminYearlyOrderTrend(),
        default   => $this->getSuperAdminDailyOrderTrend(30),
    };
}

/**
 * Super Admin Daily Order Trend
 */
private function getSuperAdminDailyOrderTrend(int $days): array
{
    $labels = [];
    $data = [];

    for ($i = $days - 1; $i >= 0; $i--) {

        $date = now()->subDays($i);

        $labels[] = $date->format('d M');

        $data[] = Order::whereDate('created_at', $date)->count();
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

/**
 * Super Admin Monthly Order Trend
 */
private function getSuperAdminMonthlyOrderTrend(): array
{
    $labels = [];
    $data = [];

    for ($i = 11; $i >= 0; $i--) {

        $month = now()->subMonths($i);

        $labels[] = $month->format('M');

        $data[] = Order::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count();
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

/**
 * Super Admin Yearly Order Trend
 */
private function getSuperAdminYearlyOrderTrend(): array
{
    $labels = [];
    $data = [];

    for ($i = 4; $i >= 0; $i--) {

        $year = now()->subYears($i)->year;

        $labels[] = (string) $year;

        $data[] = Order::whereYear('created_at', $year)->count();
    }

    return [
        'labels' => $labels,
        'data'   => $data,
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


public function getVendorRevenueTrend(string $vendorId, string $filter = 'week'): array
{

    return match ($filter) {

        'week' => $this->getDailyTrend($vendorId, 7),

        'month' => $this->getDailyTrend($vendorId, 30),

        'monthly' => $this->getMonthlyTrend($vendorId),

        'yearly' => $this->getYearlyTrend($vendorId),

        default => $this->getDailyTrend($vendorId, 30),
    };
}

/**
 * Daily Trend (Last X Days)
 */
private function getDailyTrend(string $vendorId, int $days): array
{
    $labels = [];
    $data = [];

    for ($i = $days - 1; $i >= 0; $i--) {

        $date = now()->subDays($i);

        $labels[] = $date->format('d M');

        $data[] = (float) OrderItem::where('vendor_id', $vendorId)
            ->whereDate('created_at', $date)
            ->sum('line_total');
    }

    return [
        'labels' => $labels,
        'data' => $data,
    ];
}

/**
 * Last 12 Months
 */
private function getMonthlyTrend(string $vendorId): array
{
    $labels = [];
    $data = [];



    for ($i = 11; $i >= 0; $i--) {

        $date = now()->subMonths($i);

        $labels[] = $date->format('M Y');

        $data[] = (float) OrderItem::where('vendor_id', $vendorId)
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->sum('line_total');
    }

    return [
        'labels' => $labels,
        'data' => $data,
    ];
}

/**
 * Last 5 Years
 */
private function getYearlyTrend(string $vendorId): array
{
    $labels = [];
    $data = [];

    for ($i = 4; $i >= 0; $i--) {

        $year = now()->subYears($i)->year;

        $labels[] = (string) $year;

        $data[] = (float) OrderItem::where('vendor_id', $vendorId)
            ->whereYear('created_at', $year)
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
  

    /**
     * Get daily order stats for a specific vendor.
     */
public function getVendorOrderStats(string $vendorId): array
{
    $today = now()->toDateString();

    $orderItems = OrderItem::where('vendor_id', $vendorId);

    return [
        'orders_today' => (clone $orderItems)
            ->whereDate('created_at', $today)
            ->distinct('order_id')
            ->count('order_id'),

        'pending_orders' => (clone $orderItems)
            ->whereHas('order', function ($query) {
                $query->where('status', 'pending');
            })
            ->distinct('order_id')
            ->count('order_id'),

        'dispatch_orders' => (clone $orderItems)
            ->whereHas('order', function ($query) {
                $query->where('status', 'packed');
            })
            ->distinct('order_id')
            ->count('order_id'),

        'revenue_today' => (clone $orderItems)
            ->whereDate('created_at', $today)
            ->sum('line_total'),

        'total_revenue' => (clone $orderItems)
            ->sum('line_total'),
        'total_products'=>Product::where('vendor_id', $vendorId)->count()
    ];
}


public function getVendorOrderStatusDistribution(string $vendorId): array
{
    $statuses = [
        'pending',
        'confirmed',
        'processing',
        'packed',
        'shipped',
        'delivered',
        'cancelled',
        'returned',
        'refunded',
    ];

    $labels = [];
    $data = [];

    foreach ($statuses as $status) {

        $count = OrderItem::where('vendor_id', auth()->user()->vendor->vendor_id)
            ->whereHas('order', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->distinct('order_id')
            ->count('order_id');

        $labels[] = ucwords(str_replace('_', ' ', $status));
        $data[] = $count;
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

public function getVendorInventoryHealth(string $vendorId): array
{
    $inventory = ProductVariant::query()
        ->join('products', 'products.product_id', '=', 'product_variants.product_id')
        ->where('products.vendor_id', $vendorId)
        ->selectRaw("
            SUM(CASE
                    WHEN product_variants.is_active = 1
                     AND product_variants.stock_qty > product_variants.low_stock_alert
                    THEN 1 ELSE 0
                END) AS in_stock,

            SUM(CASE
                    WHEN product_variants.is_active = 1
                     AND product_variants.stock_qty > 0
                     AND product_variants.stock_qty <= product_variants.low_stock_alert
                    THEN 1 ELSE 0
                END) AS low_stock,

            SUM(CASE
                    WHEN product_variants.is_active = 1
                     AND product_variants.stock_qty = 0
                    THEN 1 ELSE 0
                END) AS out_of_stock,

            SUM(CASE
                    WHEN product_variants.is_active = 0
                    THEN 1 ELSE 0
                END) AS inactive
        ")
        ->first();

    return [
        'labels' => [
            'In Stock',
            'Low Stock',
            'Out of Stock',
            'Inactive',
        ],

        'data' => [
            (int) $inventory->in_stock,
            (int) $inventory->low_stock,
            (int) $inventory->out_of_stock,
            (int) $inventory->inactive,
        ],
    ];
}


 public function getVendorOrderTrend(string $vendorId, string $filter = 'week'): array
{
    return match ($filter) {
        'week'    => $this->getDailyOrderTrend($vendorId, 7),
        'month'   => $this->getDailyOrderTrend($vendorId, 30),
        'monthly' => $this->getMonthlyOrderTrend($vendorId),
        'yearly'  => $this->getYearlyOrderTrend($vendorId),
        default   => $this->getDailyOrderTrend($vendorId, 30),
    };
}

private function getDailyOrderTrend(string $vendorId, int $days): array
{
    $labels = [];
    $data = [];

    for ($i = $days - 1; $i >= 0; $i--) {

        $date = now()->subDays($i);

        $labels[] = $date->format('d M');

        $data[] = OrderItem::query()
            ->where('vendor_id', $vendorId)
            ->whereDate('created_at', $date)
            ->distinct('order_id')
            ->count('order_id');
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

private function getMonthlyOrderTrend(string $vendorId): array
{
    $labels = [];
    $data = [];

    for ($i = 11; $i >= 0; $i--) {

        $date = now()->subMonths($i);

        $labels[] = $date->format('M Y');

        $data[] = OrderItem::query()
            ->where('vendor_id', $vendorId)
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->distinct('order_id')
            ->count('order_id');
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

private function getYearlyOrderTrend(string $vendorId): array
{
    $labels = [];
    $data = [];

    for ($i = 4; $i >= 0; $i--) {

        $year = now()->subYears($i)->year;

        $labels[] = $year;

        $data[] = OrderItem::query()
            ->where('vendor_id', $vendorId)
            ->whereYear('created_at', $year)
            ->distinct('order_id')
            ->count('order_id');
    }

    return [
        'labels' => $labels,
        'data'   => $data,
    ];
}

public function getRecentOrders(string $vendorId, int $limit = 10)
{
    return OrderItem::query()
        ->with([
            'order',
            'order.shippingAddress',
            'product:product_id,product_name',
        ])
        ->where('vendor_id', $vendorId)
        ->latest()
        ->limit($limit)
        ->get()
        ->map(function ($item) {

            return [
                'full_name'=> $item->order->shippingAddress->full_name,
                'phone' => $item->order->shippingAddress->email,
                'order_id'      => $item->order->order_id,
                'order_number'  => $item->order->order_number,
                'product_name'  => $item->product_name,
                'quantity'      => $item->quantity,
                'amount'        => $item->line_total,
                'status'        => $item->order->status,
                'date'          => $item->order->created_at->format('d M Y'),

            ];

        });
}
}

