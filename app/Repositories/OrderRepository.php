<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function getConfirmedOrdersBySchool(string $schoolId): Collection
    {
        return Order::where('school_id', $schoolId)
            ->where('status', 'confirmed')
            ->with('items')
            ->get();
    }

    public function updateStatus(string $orderId, string $status): bool
    {
        return Order::where('id', $orderId)->update(['status' => $status]);
    }

    public function getOrdersForUser(string $userId): Collection
    {
        return Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }
}
