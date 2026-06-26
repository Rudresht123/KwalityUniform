<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use App\Models\SuperAdmin\SchoolProductApproval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SchoolApprovalService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Get products that need school approval.
     * These are products approved by Super Admin but not yet approved/rejected by the school.
     */
    public function getPendingSchoolApprovals(string $schoolId)
    {
        return $this->productRepo->getVisibleProducts()
            ->where('approval_status', 'approved')
            ->whereDoesntHave('schoolApprovals', 'school_id', $schoolId)
            ->get();
    }

    public function approveProductForSchool(string $schoolId, string $productId)
    {
        return DB::transaction(function () use ($schoolId, $productId) {
            return SchoolProductApproval::updateOrCreate(
                ['school_id' => $schoolId, 'product_id' => $productId],
                [
                    'status' => 'approved',
                    'actioned_by' => Auth::id(),
                    'actioned_at' => now(),
                ]
            );
        });
    }

    public function rejectProductForSchool(string $schoolId, string $productId, string $reason)
    {
        return DB::transaction(function () use ($schoolId, $productId, $reason) {
            return SchoolProductApproval::updateOrCreate(
                ['school_id' => $schoolId, 'product_id' => $productId],
                [
                    'status' => 'rejected',
                    'rejection_reason' => $reason,
                    'actioned_by' => Auth::id(),
                    'actioned_at' => now(),
                ]
            );
        });
    }
}
