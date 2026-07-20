<?php

namespace App\Services;

use App\Models\Partnership;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class PartnershipService
{
    /**
     * Request a new partnership.
     */
    public function requestPartnership(array $data): Partnership
    {
        return Partnership::create([
            'school_id'   => $data['school_id'],
            'vendor_id'   => $data['vendor_id'],
            'category_id' => $data['category_id'],
            'status'      => 'pending',
            'remarks'     => $data['remarks'] ?? null,
        ]);
    }

    /**
     * Accept a partnership and perform the atomic swap of active vendors.
     */
    public function acceptPartnership(Partnership $partnership, User $approver): void
    {
        DB::transaction(function () use ($partnership, $approver) {
            // Rule #3 & #4: Deactivate previous vendor for this category
            Partnership::where('school_id', $partnership->school_id)
                ->where('category_id', $partnership->category_id)
                ->where('status', 'active')
                ->update([
                    'status' => 'inactive',
                    'ended_at' => now()
                ]);

            // Activate the new partnership
            $partnership->update([
                'status' => 'active',
                'approved_at' => now(),
                'approved_by' => $approver->id
            ]);
        });
    }

    /**
     * Reject a partnership request.
     */
    public function rejectPartnership(Partnership $partnership, string $remarks): void
    {
        $partnership->update([
            'status' => 'rejected',
            'remarks' => $remarks
        ]);
    }
}
