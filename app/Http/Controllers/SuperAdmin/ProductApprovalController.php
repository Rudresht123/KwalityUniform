<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Vendor;
use App\Services\ProductApprovalService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProductApprovalController extends BaseController
{
    protected $approvalService;

    public function __construct(ProductApprovalService $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    /**
     * Display the product approval queue.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAnyApprovalQueue', Product::class);

      if ($request->filled('is_search')) {
  $query = Product::query()
            ->with(['vendor', 'category', 'primaryImage.file'])
            ->withCount('variants')
            ->where('approval_status', 'pending')
            ->latest();

        // Vendor Filter
        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        // Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%")
                    ->orWhereHas('vendor', function ($vendor) use ($search) {
                        $vendor->where('business_name', 'like', "%{$search}%");
                    });
            });
        }

        $products = $query->get();
        }else{
            $products =[];
        }
      
        $categories = Category::orderBy('category_name')->get();

        return view('super-admin.product_approvals.index', [
            'products' => $products,
            'categories' => $categories,
            ...$this->pageData('Product Approval Center', 'Home|Products|Approval Center'),
        ]);
    }

    /**
     * Preview product details for the slide drawer.
     */
    public function preview($productId)
    {
        $product = Product::with(['vendor', 'category', 'variants.size', 'variants.color', 'images.file', 'approvalHistories.performer'])->findOrFail($productId);

        return response()->json([
            'success' => true,
            'data' => array_merge($product->toArray(), [
                'primary_image_url' => $product->firstImage(),
            ]),
        ]);
    }

    /**
     * Approve the specified product or multiple products.
     */
    public function approve(Request $request, $productId = null)
    {
        $this->authorize('actionApproval', Product::class);

        try {
            $products = $request->input('products', []);

            if (empty($products) && $productId) {
                $products = [$productId];
            }

            if (empty($products)) {
                return response()->json(['success' => false, 'message' => 'No products selected for approval.'], 400);
            }

            $this->approvalService->approve($products);

            return response()->json(['success' => true, 'message' => 'Product(s) approved successfully.']);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Failed to approve product(s): ' . $e->getMessage()], 500);
        }
    }

    /**
     * Reject the specified product or multiple products.
     */
    public function reject(Request $request, $productId = null)
    {
        $this->authorize('actionApproval', Product::class);

        $request->validate([
            'reason' => 'required|string|min:10|max:1000',
        ]);

        try {
            $products = $request->input('products', []);

            if (empty($products) && $productId) {
                $products = [$productId];
            }

            if (empty($products)) {
                return response()->json(['success' => false, 'message' => 'No products selected for rejection.'], 400);
            }

            $this->approvalService->reject($products, $request->reason);

            return response()->json(['success' => true, 'message' => 'Product(s) rejected successfully.']);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Failed to reject product(s): ' . $e->getMessage()], 500);
        }
    }
}
