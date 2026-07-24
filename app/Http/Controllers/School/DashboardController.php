<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function __construct(protected DashboardService $dashboardService) {}

    public function index()
    {
        $user = auth()->user();
        \Log::info('School Dashboard index for User ID: ' . $user->id);
        
        $stats = $this->dashboardService->getSchoolStats($user);
        \Log::info('Stats keys: ' . implode(', ', array_keys($stats)));
        
        return view('dashboard.school', compact('stats'), $this->pageData('School Dashboard', 'Dashboard'));
    }
}
