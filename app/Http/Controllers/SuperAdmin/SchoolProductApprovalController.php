<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use App\Policies\ProductPolicy;
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

        $schoolId = $request->user()->school?->school_id; 

        if (!$schoolId && !$request->user()->hasRole('super-admin')) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        $products = Product::approved()
            ->with(['vendor', 'category', 'schoolApprovals'])
            ->when($schoolId, function($q) use ($schoolId) {
                return $q->whereHas('schoolApprovals', function($sq) use ($schoolId) {
                    $sq->where('school_id', $schoolId);
                });
            })
            ->paginate(12);

        return view('super-admin.school_product_approval.index', [
            'products' => $products,
            'pageData' => $this->pageData('School Product Approval', 'Home|Inventory|School Approval'),
            'schoolId' => $schoolId
        ]);
    }

    /**
     * Display the School Approved Products report with dynamic filters.
     */
    public function schoolApproved(Request $request)
    {
        $this->authorize('viewAny',ProductPolicy::class);

        $schoolId = $request->user()->school?->school_id;

        if (!$schoolId && !$request->user()->hasRole('super-admin')) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        if ($request->ajax()) {
            $products = Product::approved()
                ->with(['vendor', 'category', 'schoolApprovals'])
                ->when($request->filled('category_id'), function($q) use ($request) {
                    return $q->where('category_id', $request->category_id);
                })
                ->when($request->filled('vendor_id'), function($q) use ($request) {
                    return $q->where('vendor_id', $request->vendor_id);
                })
                ->when($request->filled('search'), function($q) use ($request) {
                    $search = $request->search;
                    return $q->where(function($sq) use ($search) {
                        $sq->where('product_name', 'like', "%{$search}%")
                          ->orWhere('product_code', 'like', "%{$search}%");
                    });
                })
                ->paginate(12);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'html' => view('super-admin.school_product_approval.partials.product_cards', compact('products'))->render(),
                    'pagination' => $products->links(),
                ]);
            }
        }

        return view('super-admin.school_product_approval.school_approved', [
            'pageData' => $this->pageData('School Approved Products', 'Home|Inventory|School Approval|School Approved'),
            'schoolId' => $schoolId
        ]);
    }

    public function approved(Request $request)
    {
        $this->authorize('viewAny', ProductPolicy::class);

        $schoolId = $request->user()->school?->school_id;

        if (!$schoolId && !$request->user()->hasRole('super-admin')) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        if ($request->ajax()) {
            $products = Product::approved()
                ->with(['vendor', 'category', 'schoolApprovals'])
                ->whereHas('schoolApprovals', function($q) use ($schoolId) {
                    $q->where('school_id', $schoolId)->where('status', 'approved');
                });

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('product_image', function ($row) {
                    return '<img src="'.($row->firstImage() ?? asset("assets/images/no_image.jpg")).'" class="img-fluid rounded" width="40">';
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product_name ?? 'N/A';
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
                ->addColumn('status', function ($row) {
                    return '<span class="badge bg-success">Approved</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-sm btn-primary btn-preview" data-id="'.$row->product_id.'">View Details</button>';
                })
                ->rawColumns(['product_image', 'status', 'actions'])
                ->make(true);
        }

        return view('super-admin.school_product_approval.approved', $this->pageData('Approved School Products', 'Home|Inventory|School Approval|Approved'));
    }


    public function reject(Request $request)
    {
        $this->authorize('actionApproval', ProductPolicy::class);
        
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
