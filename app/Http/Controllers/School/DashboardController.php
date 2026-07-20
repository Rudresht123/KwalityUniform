<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Services\SchoolDashboardService;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function __construct(protected SchoolDashboardService $dashboardService) {}

    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();
        $recentOrders = $this->dashboardService->getRecentOrders();
        $partnerships = $this->dashboardService->getActivePartnerships();
        $orderDistribution = $this->dashboardService->getOrderStatusDistribution();
        
        return view('school.dashboard', compact('stats', 'recentOrders', 'partnerships', 'orderDistribution'), $this->pageData('School Dashboard', 'Dashboard'));
    }
}
