<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Models\Partnership;
use App\Services\PartnershipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnershipController extends BaseController
{
    protected PartnershipService $partnershipService;

    public function __construct(PartnershipService $partnershipService)
    {
        $this->partnershipService = $partnershipService;
    }

    /**
     * Display a listing of partnership requests for the school.
     */
    public function index()
    {
        $schoolId = Auth::user()->school->id;
        $requests = Partnership::where('school_id', $schoolId)
            ->where('status', 'pending')
            ->with(['vendor', 'category'])
            ->get();

        return view('school.partnerships.index', compact('requests'), $this->pageData('Partnership Requests', 'Home|Partnerships|Requests'));
    }

    /**
     * Approve a partnership request.
     */
    public function approve(Partnership $partnership)
    {
        $this->authorize('update', $partnership);
        
        $this->partnershipService->acceptPartnership($partnership, Auth::user());
        
        return redirect()->route('school.partnerships.index')->with('success', 'Partnership approved successfully.');
    }

    /**
     * Reject a partnership request.
     */
    public function reject(Request $request, Partnership $partnership)
    {
        $this->authorize('update', $partnership);

        $request->validate(['remarks' => 'required|string|max:255']);
        
        $this->partnershipService->rejectPartnership($partnership, $request->remarks);
        
        return redirect()->route('school.partnerships.index')->with('success', 'Partnership rejected successfully.');
    }
}
