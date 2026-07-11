<?php

namespace App\Repositories;

use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\SchoolStandard;
use App\Models\SuperAdmin\Category;
use App\Models\User;
use App\Models\WebUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;


class DashboardRepository
{
    /**
     * Get core KPI counts for the Super Admin.
     */
    public function getCoreKpis(): array
    {
        return [
            'total_schools' => School::count(),
            'active_schools' => School::where('is_active', true)->count(),
            'total_vendors' => Vendor::count(),
            'approved_vendors' => Vendor::where('status', 'approved')->count(),
            'total_products' => Product::count(),
            'approved_products' => Product::where('approval_status', 'approved')->count(),
            'pending_products' => Product::where('approval_status', 'pending')->count(),
            'rejected_products' => Product::where('approval_status', 'rejected')->count(),
            'total_standards' => SchoolStandard::count(),
            'total_users' => User::count(),
            'total_variants' => ProductVariant::count(),
            'low_stock_count' => ProductVariant::whereRaw('stock_qty <= low_stock_alert')->count(),
            'out_of_stock' => ProductVariant::where('stock_qty', 0)->count(),
        ];
    }

    /**
     * Get pending product approvals for the Approval Center.
     */
    public function getPendingApprovals(int $limit = 5): \Illuminate\Support\Collection
    {
        return Product::where('approval_status', 'pending')->with('vendor')->latest()->take($limit)->get();
    }

    /**
     * Get critical inventory alerts (Low/Out of stock).
     */
    public function getInventoryAlerts(int $limit = 5): \Illuminate\Support\Collection
    {
        return ProductVariant::whereRaw('stock_qty <= low_stock_alert')->with('product')->orderBy('stock_qty', 'asc')->take($limit)->get();
    }

    /**
     * Get recent system notifications.
     */
    public function getRecentNotifications(int $limit = 8, $vendorId = null): \Illuminate\Support\Collection
    {
        $query = DB::table('notifications')->latest();

        if ($vendorId) {
            // In the 'notifications' table, notifiable_id is the User ID
            $user = \App\Models\SuperAdmin\Vendor::where('vendor_id', $vendorId)->first();
            $userId = $user ? $user->user_id : $vendorId;
            
            $query->where('notifiable_id', $userId);
        }

        return $query->take($limit)->get()->map(function($note) {
            $data = json_decode($note->data, true);
            return [
                'description' => $data['message'] ?? $data['description'] ?? 'System Notification',
                'created_at' => $note->created_at,
                'type' => $note->type,
            ];
        });
    }

    /**
     * Get formatted recent activity for the dashboard timeline.
     */

    public function getRecentActivity(int $limit = 10): \Illuminate\Support\Collection
    {
        $user = Auth::user();

        $query = Activity::with(['causer', 'subject'])->latest();

        // Super Admin & Admin => Show all activities
        if (!$user->hasAnyRole(['super-admin', 'admin'])) {
            $query->where('causer_id', $user->id);
        }

        $logs = $query->take($limit)->get();

        return $logs->map(function ($log) {
            $mapping = [
                'School' => [
                    'icon' => 'ti-school',
                    'color' => 'var(--c-blue)',
                    'bg' => 'var(--c-blue-bg)',
                    'badge' => 'School',
                    'badge_class' => 'badge-blue',
                ],

                'Vendor' => [
                    'icon' => 'ti-building-store',
                    'color' => 'var(--c-violet)',
                    'bg' => 'var(--c-violet-bg)',
                    'badge' => 'Vendor',
                    'badge_class' => 'badge-violet',
                ],

                'Product' => [
                    'icon' => 'ti-package',
                    'color' => 'var(--c-amber)',
                    'bg' => 'var(--c-amber-bg)',
                    'badge' => 'Products',
                    'badge_class' => 'badge-amber',
                ],

                'ProductVariant' => [
                    'icon' => 'ti-dropbox',
                    'color' => 'var(--c-green)',
                    'bg' => 'var(--c-green-bg)',
                    'badge' => 'Stock',
                    'badge_class' => 'badge-green',
                ],

                'auth' => [
                    'icon' => 'ti-lock',
                    'color' => 'var(--c-blue)',
                    'bg' => 'var(--c-blue-bg)',
                    'badge' => 'Account',
                    'badge_class' => 'badge-blue',
                ],
            ];

            $type = $log->log_name;

            $config = $mapping[$type] ?? [
                'icon' => 'ti-alert-triangle',
                'color' => 'var(--c-red)',
                'bg' => 'var(--c-red-bg)',
                'badge' => 'System',
                'badge_class' => 'badge-red',
            ];

            // Subject Name
            $subjectName = '';

            if ($log->subject) {
                if ($log->subject instanceof \App\Models\SuperAdmin\Product) {
                    $subjectName = $log->subject->product_name;
                } elseif ($log->subject instanceof \App\Models\SuperAdmin\Vendor) {
                    $subjectName = $log->subject->business_name;
                } elseif ($log->subject instanceof \App\Models\SuperAdmin\School) {
                    $subjectName = $log->subject->school_name;
                } elseif ($log->subject instanceof \App\Models\User) {
                    $subjectName = $log->subject->name;
                } elseif (method_exists($log->subject, 'getName')) {
                    $subjectName = $log->subject->getName();
                }
            }

            $description = $log->description ?: "Activity in {$type}";
            $displayName = $subjectName ? "{$description} {$subjectName}" : $description;

            $causerName = $log->causer?->name ?? 'System';

            $meta = "by {$causerName}";

            $url = null;

            if ($log->subject_id) {
                switch ($log->subject_type) {
                    case \App\Models\SuperAdmin\Product::class:
                        $url = route('product.edit', $log->subject_id);
                        break;

                    case \App\Models\SuperAdmin\ProductVariant::class:
                        $product = \App\Models\SuperAdmin\Product::whereHas('variants', function ($q) use ($log) {
                            $q->where('variant_id', $log->subject_id);
                        })->first();

                        if ($product) {
                            $url = route('product.edit', $product->product_id);
                        }

                        break;

                    case \App\Models\SuperAdmin\Vendor::class:
                        $url = route('vendor.show', $log->subject_id);
                        break;
                }
            }

            return [
                'icon' => $config['icon'],

                'color' => $config['color'],

                'bg' => $config['bg'],

                'name' => $displayName,

                'meta' => $meta,

                'badge' => $config['badge'],

                'badge_class' => $config['badge_class'],

                'time' => Carbon::parse($log->created_at)->diffForHumans(),

                'url' => $url,
            ];
        });
    }

    /**
     * Get registration trends for schools and vendors.
     */
    public function getRegistrationTrends(int $months = 12): array
    {
        $labels = [];
        $schoolData = [];
        $vendorData = [];
        $webUserData = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M');

            $schoolData[] = School::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->where('is_active', 1)->count();

            $vendorData[] = Vendor::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->where('is_active', 1)->count();

            $webUserData[] = WebUser::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->whereNull('deleted_at')->count();
        }

        return [
            'labels' => $labels,
            'schools' => $schoolData,
            'vendors' => $vendorData,
            'webusers' => $webUserData,
        ];
    }

    /**
     * Get top vendors by product count.
     */
    public function getTopVendorsByProducts(int $limit = 5): Collection
    {
        return Vendor::withCount('products')->orderByDesc('products_count')->take($limit)->get();
    }

    /**
     * Get distribution of schools by board type.
     */
    public function getSchoolBoardDistribution(): array
    {
        $boards = \App\Models\SuperAdmin\SchoolBoard::all();
        $distribution = [];

        foreach ($boards as $board) {
            $distribution[strtolower($board->name)] = $board->schools()->count();
        }

        return $distribution;
    }

    /**
     * Get top categories by product count.
     */
    public function getTopCategories(int $limit = 5): Collection
    {
        return Category::withCount('products')->orderBy('products_count', 'desc')->take($limit)->get();
    }

    /**
     * Get recent schools.
     */
    public function getRecentSchools(int $limit = 5): Collection
    {
        return School::latest()->take($limit)->get();
    }

    /**
     * Get product submission and approval trends for a specific vendor.
     */
    public function getVendorProductTrends($vendorId, int $months = 6): array
    {
        $labels = [];
        $submittedData = [];
        $approvedData = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M');

            $submittedData[] = Product::where('vendor_id', $vendorId)->whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->count();

            $approvedData[] = Product::where('vendor_id', $vendorId)->where('approval_status', 'approved')->whereMonth('approved_at', $date->month)->whereYear('approved_at', $date->year)->count();
        }

        return [
            'labels' => $labels,
            'submitted' => $submittedData,
            'approved' => $approvedData,
        ];
    }

    /**
     * Get product counts grouped by Parent Category.
     */
    public function getParentCategoryProductCounts($vendorId = null): array
    {
        $query = DB::table('parent_categories')
            ->leftJoin('categories', 'parent_categories.parent_id', '=', 'categories.parent_id')
            ->leftJoin('products', function ($join) use ($vendorId) {
                $join->on('categories.category_id', '=', 'products.category_id');

                if ($vendorId) {
                    $join->where('products.vendor_id', $vendorId);
                }
            })
            ->select('parent_categories.parent_id', 'parent_categories.name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('parent_categories.parent_id', 'parent_categories.name')
            ->orderBy('parent_categories.name');

        return $query->get()->toArray();
    }
    public function getCategoryProductCounts($vendorId = null): array
    {
        $query = DB::table('categories')
            ->leftJoin('products', function ($join) use ($vendorId) {
                $join->on('categories.category_id', '=', 'products.category_id');

                if ($vendorId) {
                    $join->where('products.vendor_id', $vendorId);
                }
            })
            ->select('categories.category_id', 'categories.category_name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('categories.category_id', 'categories.category_name')
            ->orderBy('categories.category_name');

        return $query->get()->toArray();
    }

    /**
     * Get product upload trend for the last 12 months.
     */
    public function getProductUploadTrend($vendorId = null): array
    {
        $labels = [];
        $counts = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M');

            $query = Product::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year);

            if ($vendorId) {
                $query->where('vendor_id', $vendorId);
            }

            $counts[] = $query->count();
        }

        return [
            'labels' => $labels,
            'counts' => $counts,
        ];
    }

    /**
     * Get detailed inventory summary.
     */
 public function getInventorySummary($vendorId = null): array
{
    $query = ProductVariant::query();

    if ($vendorId) {
        $query->whereHas('product', function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        });
    }

    return [

        // Total Units
        'total_stock_qty' => (int) (clone $query)->sum('stock_qty'),

        // Total Variants
        'total_variants' => (clone $query)->count(),

        // Out of Stock
        'out_of_stock_count' => (clone $query)
            ->where('stock_qty', 0)
            ->count(),

        // Low Stock
        'low_stock_count' => (clone $query)
            ->where('stock_qty', '>', 0)
            ->whereColumn('stock_qty', '<=', 'low_stock_alert')
            ->count(),

        // Healthy Stock
        'healthy_stock_count' => (clone $query)
            ->whereColumn('stock_qty', '>', 'low_stock_alert')
            ->count(),


    ];
}


public function getSystemHealth(): array
{
    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    */

    try {

        DB::connection()->getPdo();

        $database = [
            'status' => true,
            'label'  => 'Connected',
        ];

    } catch (\Throwable $e) {

        $database = [
            'status' => false,
            'label'  => 'Disconnected',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    */

    try {

        Cache::put('__health_check', true, 10);

        $cache = Cache::get('__health_check') === true;

    } catch (\Throwable $e) {

        $cache = false;

    }

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    */

    $storagePath = storage_path();

    $totalSpace = @disk_total_space($storagePath);
    $freeSpace  = @disk_free_space($storagePath);

    $usedSpace = $totalSpace > 0
        ? round((($totalSpace - $freeSpace) / $totalSpace) * 100)
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Logs
    |--------------------------------------------------------------------------
    */

    $logFile = storage_path('logs/laravel.log');

    $logSize = File::exists($logFile)
        ? round(File::size($logFile) / 1024 / 1024, 2)
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Queue
    |--------------------------------------------------------------------------
    */

    try {

        Queue::size();

        $queue = true;

    } catch (\Throwable $e) {

        $queue = false;

    }

    /*
    |--------------------------------------------------------------------------
    | PHP
    |--------------------------------------------------------------------------
    */

    $phpVersion = PHP_VERSION;

    /*
    |--------------------------------------------------------------------------
    | Laravel
    |--------------------------------------------------------------------------
    */

    $laravelVersion = app()->version();

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    */

    $environment = app()->environment();

    /*
    |--------------------------------------------------------------------------
    | Overall Health
    |--------------------------------------------------------------------------
    */

    $healthyServices = collect([
        $database['status'],
        $cache,
        $queue,
    ])->filter()->count();

    $healthScore = round(($healthyServices / 3) * 100);

    return [

        'health_score' => $healthScore,

        'database' => $database,

        'cache' => [
            'status' => $cache,
            'label'  => $cache ? 'Connected' : 'Disconnected',
        ],

        'queue' => [
            'status' => $queue,
            'label'  => $queue ? 'Running' : 'Stopped',
        ],

        'storage' => [

            'used_percent' => $usedSpace,

            'free_space' => $freeSpace
                ? round($freeSpace / 1024 / 1024 / 1024, 2)
                : 0,

            'total_space' => $totalSpace
                ? round($totalSpace / 1024 / 1024 / 1024, 2)
                : 0,

        ],

        'php_version' => $phpVersion,

        'laravel_version' => $laravelVersion,

        'environment' => ucfirst($environment),

        'log_size' => $logSize,

        'generated_at' => now(),

    ];
}
}

