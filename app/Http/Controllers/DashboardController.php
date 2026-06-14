<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dynamic dashboard based on user role.
     */
    public function index(): View
    {
        $user = auth()->user();
        $data = [];

        if ($user->hasRole(['super-admin', 'admin'])) {
            $data = $this->getSuperAdminStats();
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
            'ordersCount' => 0, // Placeholder for future implementation
            'activeSubscriptions' => 0, // Placeholder
            'notificationsCount' => 0, // Placeholder
        ];
    }

    /**
     * Get statistics for Super Admin.
     */
    private function getSuperAdminStats(): array
    {
        $months = [];
        $schoolData = [];
        $vendorData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            
            $schoolData[] = School::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            
            $vendorData[] = Vendor::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        return [
            'totalSchools' => School::count(),
            'activeSchools' => School::active()->count(),
            'inactiveSchools' => School::where('is_active', false)->count(),
            'totalVendors' => Vendor::count(),
            'approvedVendors' => Vendor::approved()->count(),
            'pendingVendors' => Vendor::pending()->count(),
            'suspendedVendors' => Vendor::suspended()->count(),
            'totalClasses' => SchoolClass::count(),
            'totalUsers' => User::count(),
            'recentSchools' => School::latest()->take(5)->get(),
            'registrationTrends' => [
                'months' => $months,
                'schools' => $schoolData,
                'vendors' => $vendorData,
            ]
        ];
    }

    /**
     * Get statistics for a specific School user.
     */
    private function getSchoolStats(User $user): array
    {
        $school = School::where('user_id', $user->id)->first();
        
        if (!$school) {
            return ['school' => null];
        }

        return [
            'school' => $school,
            'totalClasses' => $school->classes()->count(),
            'activeClasses' => $school->classes()->where('is_active', true)->count(),
            'inactiveClasses' => $school->classes()->where('is_active', false)->count(),
            'recentClasses' => $school->classes()->latest()->take(5)->get(),
        ];
    }

    /**
     * Get statistics for a specific Vendor user.
     */
    private function getVendorStats(User $user): array
    {
        $vendor = Vendor::where('user_id', $user->id)->first();

        return [
            'vendor' => $vendor,
            // Add more vendor-specific stats here as you build out the system
        ];
    }
}
