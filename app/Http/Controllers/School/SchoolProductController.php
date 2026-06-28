<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\SchoolProductApproval;
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

    public function approveProduct(Request $request, $productId)
    {
        $school = $request->user()->school;
        if (!$school) {
            return response()->json(['success' => false, 'message' => 'No school associated with your account.'], 403);
        }

        try {
            \App\Models\SuperAdmin\SchoolProductApproval::updateOrCreate(
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

            return response()->json(['success' => true, 'message' => 'Product approved for your school successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error approving product: ' . $e->getMessage()], 500);
        }
    }

    public function show($productId)
    {
        $school = auth()->user()->school;
        $product = Product::with(['vendor', 'category', 'images', 'variants'])->findOrFail($productId);

        $isApproved = \App\Models\SuperAdmin\SchoolProductApproval::where('school_id', $school->school_id)
            ->where('product_id', $productId)
            ->where('status', 'approved')
            ->exists();

        return response()->json([
            'success' => true,
            'product' => $product,
            'is_school_approved' => $isApproved,
            'images' => $product->images->map(function($img) {
                return getFileUrl($img->file_id);
            }),
        ]);
    }
    }


