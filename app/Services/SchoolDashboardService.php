<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\ReturnRequest;
use App\Enums\OrderStatus;
use App\Enums\ShipmentStatus;
use Illuminate\Support\Facades\Auth;

class SchoolDashboardService
{
    public function getDashboardStats(): array
    {
        $schoolId = Auth::user()->school_id;

        // Optimized Query using direct school_id
        $query = Order::where('school_id', $schoolId);

        return [
            'total_orders' => (clone $query)->count(),
            'pending_orders' => (clone $query)->where('status', OrderStatus::PENDING)->count(),
            'confirmed_orders' => (clone $query)->where('status', OrderStatus::CONFIRMED)->count(),
            'delivered_orders' => (clone $query)->where('status', OrderStatus::DELIVERED)->count(),
        ];
    }

    public function getRecentOrders(int $limit = 5)
    {
        return Order::where('school_id', Auth::user()->school_id)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getActivePartnerships()
    {
        return \App\Models\Partnership::where('school_id', Auth::user()->school_id)
            ->where('status', 'active')
            ->with(['vendor', 'category'])
            ->get();
    }

    public function getOrderStatusDistribution(): array
    {
        $schoolId = Auth::user()->school_id;

        return Order::where('school_id', $schoolId)
            ->select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }
}
