<?php

namespace App\Repositories;

use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\SchoolBoard;
use Illuminate\Database\Eloquent\Collection;

class SchoolRepository
{
    /**
     * Get recent schools.
     */
    public function getRecentSchools(int $limit = 5): Collection
    {
        return School::latest()->take($limit)->get();
    }

    /**
     * Get distribution of schools by board type.
     */
    public function getSchoolBoardDistribution(): array
    {
        $boards = SchoolBoard::all();
        $distribution = [];

        foreach ($boards as $board) {
            $distribution[strtolower($board->name)] = $board->schools()->count();
        }

        return $distribution;
    }

    /**
     * Get product and order analytics for a specific school.
     */
    public function getSchoolProductStats($schoolId): array
    {
        return [
            'total_approved_products' => \App\Models\SuperAdmin\Product::whereHas('schoolApprovals', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId)->where('approval_status', 'approved');
            })->count(),
            'total_orders' => \App\Models\Order::where('school_id', $schoolId)->count(),
            'pending_shipments' => \App\Models\Shipment::where('destination_address_id', $schoolId)
                ->where('status', '!=', 'delivered')
                ->count(),
        ];
    }
}
