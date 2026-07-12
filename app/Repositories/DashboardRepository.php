<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WebUser;
use App\Models\Return;
use Illuminate\Support\Collection;

class DashboardRepository
{
    protected $orderRepo;
    protected $productRepo;
    protected $stockRepo;
    protected $vendorRepo;
    protected $schoolRepo;
    protected $returnRepo;
    protected $contactRepo;
    protected $categoryRepo;
    protected $activityRepo;
    protected $notificationRepo;

    public function __construct(
        OrderRepository $orderRepo,
        ProductRepository $productRepo,
        StockRepository $stockRepo,
        VendorRepository $vendorRepo,
        SchoolRepository $schoolRepo,
        ReturnRepository $returnRepo,
        ContactMessageRepository $contactRepo,
        CategoryRepository $categoryRepo,
        ActivityRepository $activityRepo,
        NotificationRepository $notificationRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->stockRepo = $stockRepo;
        $this->vendorRepo = $vendorRepo;
        $this->schoolRepo = $schoolRepo;
        $this->returnRepo = $returnRepo;
        $this->contactRepo = $contactRepo;
        $this->categoryRepo = $categoryRepo;
        $this->activityRepo = $activityRepo;
        $this->notificationRepo = $notificationRepo;
    }

    /**
     * Get core KPI counts for the Super Admin.
     */
    public function getCoreKpis(): array
    {
        return [
            'total_schools' => \App\Models\SuperAdmin\School::count(),
            'active_schools' => \App\Models\SuperAdmin\School::where('is_active', true)->count(),
            'total_vendors' => \App\Models\SuperAdmin\Vendor::count(),
            'approved_vendors' => \App\Models\SuperAdmin\Vendor::where('status', 'approved')->count(),
            'total_products' => \App\Models\SuperAdmin\Product::count(),
            'approved_products' => \App\Models\SuperAdmin\Product::where('approval_status', 'approved')->count(),
            'pending_products' => \App\Models\SuperAdmin\Product::where('approval_status', 'pending')->count(),
            'rejected_products' => \App\Models\SuperAdmin\Product::where('approval_status', 'rejected')->count(),
            'total_standards' => \App\Models\SuperAdmin\SchoolStandard::count(),
            'total_users' => User::count(),
            'total_variants' => \App\Models\SuperAdmin\ProductVariant::count(),
            'low_stock_count' => $this->stockRepo->getInventoryAlerts()->count(),
            'out_of_stock' => \App\Models\SuperAdmin\ProductVariant::where('stock_qty', 0)->count(),
            
            'orders_today' => \App\Models\Order::whereDate('created_at', now()->toDateString())->count(),
            'revenue_today' => \App\Models\Order::whereDate('created_at', now()->toDateString())->sum('grand_total'),
            'total_revenue' => \App\Models\Order::sum('grand_total'),
            'total_orders' => \App\Models\Order::count(),
            'total_customers' => User::count() + WebUser::count(),
            'total_returns' => $this->returnRepo->getTotalReturnsCount(),
        ];
    }

    /**
     * Delegate to Domain Repositories
     */
    public function getRevenueTrend(int $days = 30) { return $this->orderRepo->getRevenueTrend($days); }
    public function getOrderTrend(int $days = 30) { return $this->orderRepo->getOrderTrend($days); }
    public function getLatestOrders(int $limit = 10) { return $this->orderRepo->getLatestOrders($limit); }
    public function getVendorOrderStats($vendorId) { return $this->orderRepo->getVendorOrderStats($vendorId); }
    public function getVendorRevenueTrend($vendorId, $days = 30) { return $this->orderRepo->getVendorRevenueTrend((int)$vendorId, $days); }
    public function getVendorOrderTrend($vendorId, $days = 30) { return $this->orderRepo->getVendorOrderTrend((int)$vendorId, $days); }
    
    public function getTopSellingProducts($limit = 5, $vendorId = null) { return $this->productRepo->getTopSellingProducts($limit, $vendorId); }
    public function getProductOrderTrends($days = 30, $vendorId = null) { return $this->productRepo->getProductOrderTrends($days, $vendorId); }
    public function getPendingApprovals($limit = 5) { return $this->productRepo->getPendingApprovals($limit); }
    public function getProductUploadTrend($vendorId = null) { return $this->productRepo->getProductUploadTrend($vendorId); }

    /**
     * Get product submission and approval trends for a specific vendor.
     */
    public function getVendorProductTrends($vendorId)
    {
        $labels = [];
        $submitted = [];
        $approved = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d M');

            $submitted[] = \App\Models\SuperAdmin\Product::where('vendor_id', $vendorId)
                ->whereDate('created_at', $date->toDateString())
                ->count();

            $approved[] = \App\Models\SuperAdmin\Product::where('vendor_id', $vendorId)
                ->where('approval_status', 'approved')
                ->whereDate('updated_at', $date->toDateString())
                ->count();
        }

        return [
            'labels' => $labels,
            'submitted' => $submitted,
            'approved' => $approved,
        ];
    }

    public function getInventoryAlerts($limit = 5) { return $this->stockRepo->getInventoryAlerts($limit); }
    public function getInventorySummary($vendorId = null) { return $this->stockRepo->getInventorySummary($vendorId); }

    public function getTopVendorsByProducts($limit = 5) { return $this->vendorRepo->getTopVendorsByProducts($limit); }
    public function getRecentVendors($limit = 10) { return $this->vendorRepo->getRecentVendors($limit); }

    public function getRecentSchools($limit = 5) { return $this->schoolRepo->getRecentSchools($limit); }
    public function getSchoolBoardDistribution() { return $this->schoolRepo->getSchoolBoardDistribution(); }
    public function getSchoolProductStats($schoolId) { return $this->schoolRepo->getSchoolProductStats($schoolId); }

    public function getReturnRequests($limit = 10) { return $this->returnRepo->getReturnRequests($limit); }
    
    public function getRegistrationTrends()
    {
        $labels = [];
        $schools = [];
        $vendors = [];
        $webUsers = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');

            $schools[] = \App\Models\SuperAdmin\School::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $vendors[] = \App\Models\SuperAdmin\Vendor::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $webUsers[] = \App\Models\WebUser::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        return [
            'labels' => $labels,
            'schools' => $schools,
            'vendors' => $vendors,
            'webusers' => $webUsers,
        ];
    }

    public function getSupportTickets($limit = 10) { return $this->contactRepo->getLatestTickets($limit); }

    public function getTopCategories($limit = 5) { return $this->categoryRepo->getTopCategories($limit); }
    public function getParentCategoryProductCounts($vendorId = null) { return $this->categoryRepo->getParentCategoryProductCounts($vendorId); }
    public function getCategoryProductCounts($vendorId = null) { return $this->categoryRepo->getCategoryProductCounts($vendorId); }

    public function getRecentActivity($limit = 10, $userId = null) { return $this->activityRepo->getRecentActivity($limit, $userId); }
    public function getRecentNotifications($limit = 8, $userId = null) { return $this->notificationRepo->getRecentNotifications($limit, $userId); }

    public function getSystemHealth()
    {
        // This logic is purely operational/infrastructure and can stay here or move to a SystemRepository.
        // Keeping it here for now as it doesn't map to a single Domain Model.
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            $database = ['status' => true, 'label' => 'Connected'];
        } catch (\Throwable $e) {
            $database = ['status' => false, 'label' => 'Disconnected'];
        }

        try {
            \Illuminate\Support\Facades\Cache::put('__health_check', true, 10);
            $cache = \Illuminate\Support\Facades\Cache::get('__health_check') === true;
        } catch (\Throwable $e) {
            $cache = false;
        }

        try {
            \Illuminate\Support\Facades\Queue::size();
            $queue = true;
        } catch (\Throwable $e) {
            $queue = false;
        }

        $storagePath = storage_path();
        $totalSpace = @disk_total_space($storagePath);
        $freeSpace = @disk_free_space($storagePath);
        $usedSpace = $totalSpace > 0 ? round((($totalSpace - $freeSpace) / $totalSpace) * 100) : 0;

        $logFile = storage_path('logs/laravel.log');
        $logSize = \Illuminate\Support\Facades\File::exists($logFile) ? round(\Illuminate\Support\Facades\File::size($logFile) / 1024 / 1024, 2) : 0;

        return [
            'health_score' => round((collect([$database['status'], $cache, $queue])->filter()->count() / 3) * 100),
            'database' => $database,
            'cache' => ['status' => $cache, 'label' => $cache ? 'Connected' : 'Disconnected'],
            'queue' => ['status' => $queue, 'label' => $queue ? 'Running' : 'Stopped'],
            'storage' => [
                'used_percent' => $usedSpace,
                'free_space' => $freeSpace ? round($freeSpace / 1024 / 1024 / 1024, 2) : 0,
                'total_space' => $totalSpace ? round($totalSpace / 1024 / 1024 / 1024, 2) : 0,
            ],
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'environment' => ucfirst(app()->environment()),
            'log_size' => $logSize,
            'generated_at' => now(),
        ];
    }
}
