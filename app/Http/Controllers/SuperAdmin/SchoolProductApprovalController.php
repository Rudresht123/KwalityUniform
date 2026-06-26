<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Services\SchoolApprovalService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class SchoolProductApprovalController extends BaseController
{
    protected $schoolApprovalService;

    public function __construct(SchoolApprovalService $schoolApprovalService)
    {
        $this->schoolApprovalService = $schoolApprovalService;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', \App\Policies\ProductPolicy::class);

        // For simplicity, we assume the logged-in user is associated with a school or is super-admin.
        // In a real scenario, you'd determine the school_id from the user's profile.
        $schoolId = $request->user()->school?->school_id; 

        if (!$schoolId && !$request->user()->hasRole('super-admin')) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        if ($request->ajax()) {
            $products = \App\Models\SuperAdmin\Product::approved()
                ->with(['vendor', 'category'])
                ->when($schoolId, function($q) use ($schoolId) {
                    return $q->whereHas('schoolApprovals', function($sq) use ($schoolId) {
                        $sq->where('school_id', $schoolId);
                    });
                });

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('product_image', function ($row) {
                    return '<img src="'.($row->product->firstImage() ?? asset("assets/images/no_image.jpg")).'" class="img-fluid rounded" width="40">';
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product->product_name ?? 'N/A';
                })
                ->addColumn('vendor_name', function ($row) {
                    return $row->vendor->business_name ?? 'N/A';
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category->category_name ?? 'N/A';
                })
                ->addColumn('product_code', function ($row) {
                    return $row->product_code ?? 'N/A';
                })
                ->addColumn('approved_date', function ($row) use ($schoolId) {
                    $approval = $row->schoolApprovals()->where('school_id', $schoolId)->first();
                    return $approval && $approval->actioned_at ? $approval->actioned_at->format('d M Y, h:i A') : 'N/A';
                })
                ->addColumn('school_approval_status', function ($row) use ($schoolId) {
                    $approval = $row->schoolApprovals()->where('school_id', $schoolId)->first();
                    if (!$approval) return '<span class="badge bg-secondary">Pending</span>';

                    $color = $approval->status === 'approved' ? 'success' : 'danger';
                    return '<span class="badge bg-'.$color.'">'.ucfirst($approval->status).'</span>';
                })
                ->addColumn('actions', function ($row) {

                    return '
                        <button class="btn btn-sm btn-primary btn-preview" data-id="'.$row->product_id.'">Preview</button>
                        <button class="btn btn-sm btn-success btn-approve" data-id="'.$row->product_id.'">Approve</button>
                        <button class="btn btn-sm btn-danger btn-reject" data-id="'.$row->product_id.'">Reject</button>
                    ';
                })
                ->rawColumns(['product_image', 'school_approval_status', 'actions'])

                ->make(true);
        }

        return view('super-admin.school_product_approval.index', $this->pageData('School Product Approval', 'Home|Inventory|School Approval'));
    }

    public function approve(Request $request)
    {
        $this->authorize('actionApproval', \App\Policies\ProductPolicy::class);
        
        try {
            $schoolId = $request->user()->school?->school_id;
            $this->schoolApprovalService->approveProductForSchool($schoolId, $request->product_id);
            return response()->json(['success' => true, 'message' => 'Product approved for school.']);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function reject(Request $request)
    {
        $this->authorize('actionApproval', \App\Policies\ProductPolicy::class);
        
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'reason' => 'required|string|max:500',
        ]);

        try {
            $schoolId = $request->user()->school?->school_id;
            $this->schoolApprovalService->rejectProductForSchool($schoolId, $request->product_id, $request->reason);
            return response()->json(['success' => true, 'message' => 'Product rejected for school.']);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
