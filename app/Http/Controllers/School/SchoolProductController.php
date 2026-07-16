<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\SchoolProductApproval;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolProductController extends BaseController
{
    public function index(Request $request)
    {
        // Ensure the user is associated with a school
        $school = $request->user()->school;
        if (!$school) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        $query = Product::query()
            ->where('approval_status', 'approved') // Must be approved by Super Admin first
            ->with(['vendor', 'category', 'images']);

        // Filters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('gender_type')) {
            $query->where('gender_type', $request->gender_type);
        }

        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        // Add a flag to check if the product is already approved for this school
        $query->addSelect(['is_school_approved' => \App\Models\SuperAdmin\SchoolProductApproval::selectRaw('count(*)')
            ->whereColumn('product_id', 'products.product_id')
            ->where('school_id', $school->school_id)
            ->where('status', 'approved')
        ]);

        $products = $query->paginate(12)->withQueryString();

        // Get filter options
        $categories = \App\Models\SuperAdmin\Category::active()->get();
        $vendors = \App\Models\SuperAdmin\Vendor::approved()->get();

        return view('school.products.index', [
            'products' => $products,
            'categories' => $categories,
            'vendors' => $vendors,
            'pageData' => $this->pageData('Product Marketplace', 'Home|My Products')
        ]);
    }

    public function getSchoolClasses(Request $request)
    {
        $school = $request->user()->school;
        if (!$school) {
            return response()->json(['success' => false, 'message' => 'No school associated with your account.'], 403);
        }

        // Get active classes for the school
        $classes = \App\Models\SuperAdmin\SchoolClass::where('school_id', $school->school_id)
            ->where('is_active', true)
            ->orderBy('class_name')
            ->get(['id', 'class_name']);

        return response()->json([
            'success' => true, 
            'classes' => $classes
        ]);
    }

    public function approveProduct(Request $request, $productId)
    {
        $school = $request->user()->school;
        if (!$school) {
            return response()->json(['success' => false, 'message' => 'No school associated with your account.'], 403);
        }

        try {
            return \Illuminate\Support\Facades\DB::transaction(function () use ($productId, $school) {
                $product = Product::findOrFail($productId);

                $approval = SchoolProductApproval::updateOrCreate(
                    [
                        'school_id' => $school->school_id,
                        'product_id' => $productId,
                    ],
                    [
                        'status' => 'approved',
                        'actioned_by' => auth()->id(),
                        'actioned_at' => now(),
                    ]
                );

                // Use the global helper to send notifications to Super Admins
                $admins = \App\Models\User::role('super-admin')->get();
                sendNotification(
                    $admins,
                    'school_product_approved',
                    [
                        'school_name' => $school->school_name,
                        'product_name' => $product->product_name,
                        'product_code' => $product->product_code,
                    ],
                    route('school-product-approval.index')
                );

                return response()->json(['success' => true, 'message' => 'Product approved for your school successfully!']);
            });
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error approving product: ' . $e->getMessage()], 500);
        }
    }

    public function unapproveProduct(Request $request, $productId)
    {
        $school = $request->user()->school;
        if (!$school) {
            return response()->json(['success' => false, 'message' => 'No school associated with your account.'], 403);
        }

        try {
            return \Illuminate\Support\Facades\DB::transaction(function () use ($productId, $school) {
                SchoolProductApproval::where('school_id', $school->school_id)
                    ->where('product_id', $productId)
                    ->delete();

                return response()->json(['success' => true, 'message' => 'Product removed from approved list successfully!']);
            });
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error unapproving product: ' . $e->getMessage()], 500);
        }
    }

    public function approved(Request $request)
    {
        $school = $request->user()->school;
        if (!$school) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        $query = Product::query()
            ->whereHas('schoolApprovals', function ($q) use ($school) {
                $q->where('school_id', $school->school_id)
                  ->where('status', 'approved');
            })
            ->with(['vendor', 'category', 'images']);

        // Filters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('school.products.partials.approved_rows', compact('products'))->render(),
                'pagination' => $products->links(),
                'count' => $products->total()
            ]);
        }

        // Get filter options for the initial page load
        $categories = \App\Models\SuperAdmin\Category::active()->get();
        $vendors = \App\Models\SuperAdmin\Vendor::approved()->get();

        return view('school.products.approved', [
            'products' => $products,
            'categories' => $categories,
            'vendors' => $vendors,
            'pageData' => $this->pageData('My Approved Products', 'Home|My Products|Approved')
        ]);
    }
public function show($productId)
{
    $school = auth()->user()->school;

    if (!$school) {
        return response()->json(['success' => false, 'message' => 'No school associated with your account.'], 403);
    }

    $product = Product::approved()
        ->with([
            'vendor',
            'category',
            'images',
            'variants.size',
            'variants.color'
        ])
        ->findOrFail($productId);

    $images = $product->images->map(fn($img) => getFileUrl($img->file_id))->toArray();
    
    if (empty($images)) {
        $images = [asset("assets/images/no_image.jpg")];
    }

    $isApproved = SchoolProductApproval::where([
        'school_id' => $school->school_id,
        'product_id' => $productId,
        'status' => 'approved'
    ])->exists();

    return view(
        'school.products.quick-view',
        compact(
            'product',
            'images',
            'isApproved'
        )
    );
}
    }


