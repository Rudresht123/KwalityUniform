<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin\Vendor;
use App\Services\DashboardService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display the dynamic dashboard based on user role.
     */
    public function index(): View
    {
        $user = auth()->user();
        $data = [];

        if ($user->hasRole(['super-admin', 'admin'])) {
            $data = $this->dashboardService->getSuperAdminStats();
        } elseif ($user->hasRole('school')) {
            $stats = $this->getSchoolStats($user);
            $data = ['stats' => $stats];
        } elseif ($user->hasRole('vendor')) {
            $data = $this->getVendorStats($user);
        } elseif ($user->hasRole('parent')) {
            $data = $this->getParentStats($user);
        }

        return view('dashboard', $data);
    }

    /**
     * Get statistics for a specific Parent user.
     */
    private function getParentStats(User $user): array
    {
        return [
            'ordersCount' => 0,
            'activeSubscriptions' => 0,
            'notificationsCount' => 0,
        ];
    }

    /**
     * Get statistics for a School user.
     */
    private function getSchoolStats(User $user): array
    {
        return $this->dashboardService->getSchoolStats($user);
    }

    /**
     * Get statistics for a Vendor user.
     */
    private function getVendorStats(User $user): array
    {
        return $this->dashboardService->getVendorStats($user);
    }
}
