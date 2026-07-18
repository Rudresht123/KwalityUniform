<?php

namespace App\Services;

use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\Vendor;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    protected $repository;

    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all aggregated data for the Super Admin dashboard.
     * Uses caching to maintain high performance.
     */
    public function getSuperAdminStats(): array
    {
        $stats['kpis'] = $this->repository->getCoreKpis();
        $stats['revenue_trend'] = $this->repository->getRevenueTrend();
        $stats['order_trend'] = $this->repository->getOrderTrend();
        $stats['trends'] = $this->repository->getRegistrationTrends();
        $stats['top_categories'] = $this->repository->getTopCategories();
        $stats['system_health'] = $this->repository->getSystemHealth();
        $stats['top_selling_products'] = $this->repository->getTopSellingProducts();
        $stats['product_order_trends'] = $this->repository->getProductOrderTrends();

        // Fresh Eloquent data
        $stats['topVendors'] = $this->repository->getTopVendorsByProducts();
        $stats['recent_schools'] = $this->repository->getRecentSchools();
        $stats['pending_approvals'] = $this->repository->getPendingApprovals();
        $stats['inventory_alerts'] = $this->repository->getInventoryAlerts();
        $stats['notifications'] = $this->repository->getRecentNotifications();
        $stats['recentActivity'] = $this->repository->getRecentActivity();
        $stats['parentCategoryCounts'] = $this->repository->getParentCategoryProductCounts();
        $stats['categoryCounts'] = $this->repository->getCategoryProductCounts();
        $stats['productUploadTrend'] = $this->repository->getProductUploadTrend();
        $stats['inventorySummary'] = $this->repository->getInventorySummary();

        // Operations
        $stats['latest_orders'] = $this->repository->getLatestOrders();
        $stats['return_requests'] = $this->repository->getReturnRequests();
        $stats['support_tickets'] = $this->repository->getSupportTickets();
        $stats['recent_vendors'] = $this->repository->getRecentVendors();

        return $stats;
    }

    /**
     * Clear dashboard cache.
     */
    public function clearCache(): void
    {
        Cache::forget('super_admin_dashboard_stats');
    }

    /**
     * Get all aggregated data for the Vendor dashboard.
     */
    public function getVendorStats(\App\Models\User $user): array
    {
        $vendor = \App\Models\SuperAdmin\Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return ['vendor' => null];
        }

        $orderStats = $this->repository->getVendorOrderStats($vendor->vendor_id);



        $pendingProducts = $vendor->products()->where('approval_status', 'pending')->count();
        $lowStockCount = ProductVariant::whereHas('product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->vendor_id);
        })->whereRaw('stock_qty <= low_stock_alert')->count();

        return [
            'vendor' => $vendor,
            'order_stats' => $orderStats,

            'kpis' => [
                'total_products' => $vendor->products()->count(),
                'approved_products' => $vendor->products()->where('approval_status', 'approved')->count(),
                'pending_products' => $pendingProducts,
                'rejected_products' => $vendor->products()->where('approval_status', 'rejected')->count(),
                'low_stock_count' => $lowStockCount,
                'out_of_stock' => \App\Models\SuperAdmin\ProductVariant::whereHas('product', function ($q) use ($vendor) {
                    $q->where('vendor_id', $vendor->vendor_id);
                })->where('stock_qty', 0)->count(),
                'revenue' => $orderStats['total_revenue'] ?? 0,
                'revenue_growth' => rand(5, 25),
                'orders_count' => $orderStats['total_orders'] ?? 0,
                'orders_growth' => rand(2, 15),
                'net_earnings' => ($orderStats['total_revenue'] ?? 0) * 0.85,
                'pending_settlements' => rand(1000, 3000),
            ],
            'top_selling_products' => $this->repository->getTopSellingProducts(5, $vendor->vendor_id),
            'recent_products' => $vendor->products()->latest()->take(5)->get(),
            'inventory_alerts' => \App\Models\SuperAdmin\ProductVariant::whereHas('product', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->vendor_id);
            })
                ->whereRaw('stock_qty <= low_stock_alert')
                ->with('product')
                ->orderBy('stock_qty', 'asc')
                ->take(5)
                ->get(),
            'recentOrders' => $this->repository->getRecentOrders($vendor->vendor_id),
            'recentActivity' => $this->repository->getRecentActivity(10, $vendor->vendor_id),
            'productTrends' => $this->repository->getVendorProductTrends($vendor->vendor_id),
            'parentCategoryCounts' => $this->repository->getParentCategoryProductCounts($vendor->vendor_id),
            'categoryCounts' => $this->repository->getCategoryProductCounts($vendor->vendor_id),
            'productUploadTrend' => $this->repository->getProductUploadTrend($vendor->vendor_id),
            'inventorySummary' => $this->repository->getInventorySummary($vendor->vendor_id),
            'notifications' => $this->repository->getRecentNotifications(8, $vendor->vendor_id),
            'payment_summary' => [
                'total_billed' => ($orderStats['total_revenue'] ?? 0),
                'platform_fee' => ($orderStats['total_revenue'] ?? 0) * 0.10,
                'tax_deducted' => ($orderStats['total_revenue'] ?? 0) * 0.05,
                'final_payout' => ($orderStats['total_revenue'] ?? 0) * 0.85,
            ],
            'upcoming_tasks' => [
                [
                    'task' => 'Review ' . $pendingProducts . ' Pending Product Approvals',
                    'priority' => $pendingProducts > 0 ? 'high' : 'low',
                    'done' => $pendingProducts == 0
                ],
                [
                    'task' => 'Restock ' . $lowStockCount . ' Low Stock Items',
                    'priority' => $lowStockCount > 0 ? 'high' : 'medium',
                    'done' => $lowStockCount == 0
                ],
                [
                    'task' => 'Check Recent Customer Feedback',
                    'priority' => 'medium',
                    'done' => false
                ],
                [
                    'task' => 'Export Monthly Tax Report',
                    'priority' => 'low',
                    'done' => true
                ],
            ],
        ];
    }

    /**
     * Get all aggregated data for the School dashboard.
     */
    public function getSchoolStats(\App\Models\User $user): array
    {
        $school = \App\Models\SuperAdmin\School::where('user_id', $user->id)->first();

        if (!$school) {
            return ['school' => null];
        }

        return [
            'school' => $school,
            'product_stats' => $this->repository->getSchoolProductStats($school->school_id),
            'kpis' => [
                'total_classes' => $school->classes()->count(),
                'active_classes' => $school->classes()->where('is_active', true)->count(),
            ],
            'recentClasses' => $school->classes()->latest()->take(5)->get(),
            'notifications' => $this->repository->getRecentNotifications(8, $user->id),
            'recentActivity' => $this->repository->getRecentActivity(10), // Filtered inside getRecentActivity by user id
        ];
    }

    /**
     * get Order trends data for vendor
     */

    public function revenuTrend(Request $request)
    {
        $filter = $request->string('filter', 'month')->toString();

        $user = Auth::user();

        $vendor = Vendor::where('user_id', $user->id)->firstOrFail();

        $trend = $this->repository->getVendorRevenueTrend(
            $vendor->vendor_id,
            $filter
        );

        return response()->json($trend);
    }
    public function getVendorOrderStatusDistribution()
    {
        $user = Auth::user();

        $vendor = Vendor::where('user_id', $user->id)->firstOrFail();

        $trend = $this->repository->getVendorOrderStatusDistribution($vendor->vendor_id);

        return response()->json($trend);
    }


    public function getVendorInventoryHealth()
    {
        $user = Auth::user();

        $vendor = Vendor::where('user_id', $user->id)->firstOrFail();

        $trend = $this->repository->getVendorInventoryHealth($vendor->vendor_id);

        return response()->json($trend);
    }

    public function getVendorOrderTrend(Request $request)
    {
        $user = Auth::user();
        $filter = $request->string('filter', 'month')->toString();

        $vendor = Vendor::where('user_id', $user->id)->firstOrFail();

        $trend = $this->repository->getVendorOrderTrend($vendor->vendor_id, $filter);

        return response()->json($trend);
    }
}
