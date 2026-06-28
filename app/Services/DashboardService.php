<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
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
        $stats['trends'] = $this->repository->getRegistrationTrends();
        $stats['top_categories'] = $this->repository->getTopCategories();
        $stats['system_health'] = $this->repository->getSystemHealth();

        // Fresh Eloquent data
        $stats['topVendors'] = $this->repository->getTopVendorsByProducts();
        $stats['recent_schools'] = $this->repository->getRecentSchools();
        $stats['pending_approvals'] = $this->repository->getPendingApprovals();
        $stats['inventory_alerts'] = $this->repository->getInventoryAlerts();
        $stats['notifications'] = $this->repository->getRecentNotifications();
        $stats['recentActivity'] = $this->repository->getRecentActivity();
        $stats['schoolBoards'] = $this->repository->getSchoolBoardDistribution();
        $stats['parentCategoryCounts'] = $this->repository->getParentCategoryProductCounts();
        $stats['categoryCounts'] = $this->repository->getCategoryProductCounts();
        $stats['productUploadTrend'] = $this->repository->getProductUploadTrend();
        $stats['inventorySummary'] = $this->repository->getInventorySummary();

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

        return [
            'vendor' => $vendor,
            'kpis' => [
                'total_products' => $vendor->products()->count(),
                'approved_products' => $vendor->products()->where('approval_status', 'approved')->count(),
                'pending_products' => $vendor->products()->where('approval_status', 'pending')->count(),
                'rejected_products' => $vendor->products()->where('approval_status', 'rejected')->count(),
                'low_stock_count' => \App\Models\SuperAdmin\ProductVariant::whereHas('product', function ($q) use ($vendor) {
                    $q->where('vendor_id', $vendor->vendor_id);
                })
                    ->whereRaw('stock_qty <= low_stock_alert')
                    ->count(),
                'out_of_stock' => \App\Models\SuperAdmin\ProductVariant::whereHas('product', function ($q) use ($vendor) {
                    $q->where('vendor_id', $vendor->vendor_id);
                })
                    ->where('stock_qty', 0)
                    ->count(),
            ],
            'recent_products' => $vendor->products()->latest()->take(5)->get(),
            'inventory_alerts' => \App\Models\SuperAdmin\ProductVariant::whereHas('product', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->vendor_id);
            })
                ->whereRaw('stock_qty <= low_stock_alert')
                ->with('product')
                ->orderBy('stock_qty', 'asc')
                ->take(5)
                ->get(),
            'recentActivity' => $this->repository->getRecentActivity(10, $vendor->vendor_id), // Filtered for this vendor
            'productTrends' => $this->repository->getVendorProductTrends($vendor->vendor_id),
            'parentCategoryCounts' => $this->repository->getParentCategoryProductCounts($vendor->vendor_id),
            'categoryCounts' => $this->repository->getCategoryProductCounts($vendor->vendor_id),
            'productUploadTrend' => $this->repository->getProductUploadTrend($vendor->vendor_id),
            'inventorySummary' => $this->repository->getInventorySummary($vendor->vendor_id),
            'notifications' => $this->repository->getRecentNotifications(8, $vendor->vendor_id),
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
            'kpis' => [
                'total_classes' => $school->classes()->count(),
                'active_classes' => $school->classes()->where('is_active', true)->count(),
            ],
            'recentClasses' => $school->classes()->latest()->take(5)->get(),
            'notifications' => $this->repository->getRecentNotifications(8, $user->id),
            'recentActivity' => $this->repository->getRecentActivity(10), // Filtered inside getRecentActivity by user id
        ];
    }
}
