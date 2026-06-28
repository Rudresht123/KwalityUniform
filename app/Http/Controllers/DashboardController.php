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
            $data = $this->getSchoolStats($user);
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
        $school = \App\Models\SuperAdmin\School::where('user_id', $user->id)->first();

        if (!$school) {
            return ['school' => null];
        }

        return [
            'school' => $school,
            'totalStandards' => $school->standards()->count(),
            'activeStandards' => $school->standards()->where('is_active', true)->count(),
            'inactiveStandards' => $school->standards()->where('is_active', false)->count(),
            'recentStandards' => $school->standards()->latest()->take(5)->get(),
        ];
    }

    /**
     * Get statistics for a Vendor user.
     */
    private function getVendorStats(User $user): array
    {
        return $this->dashboardService->getVendorStats($user);
    }
}
