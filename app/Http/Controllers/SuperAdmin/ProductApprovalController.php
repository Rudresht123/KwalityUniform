<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use App\Services\ProductApprovalService;
use Illuminate\Http\Request;
use Throwable;

class ProductApprovalController extends BaseController
{
    public function __construct(
        protected ProductApprovalService $approvalService
    ) {
    }

    /**
     * Display the Product Approval Center.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAnyApprovalQueue', Product::class);

        // Calculate KPIs
        $pendingCount = Product::where('approval_status', 'pending')->count();
        $todayCount = Product::where('approval_status', 'pending')
            ->whereDate('created_at', now()->toDateString())
            ->count();
        $vendorsCount = Product::where('approval_status', 'pending')
            ->distinct('vendor_id')
            ->count('vendor_id');
        
        // Calculate average approval time (days)
        $avgApprovalDays = Product::where('approval_status', 'approved')
            ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
            ->value('avg_days') ?: 0;

        $products = [];


            $products = Product::query()
                ->with([
                    'vendor',
                    'category',
                    'primaryImage.file',
                ])
                ->withCount('variants')
                ->where('approval_status', 'pending')
                ->when(auth()->user()->hasRole('vendor'), function ($query) {
                    $query->where('vendor_id', auth()->user()->vendor?->vendor_id);
                })
                ->when(!auth()->user()->hasRole('vendor') && $request->filled('vendor_id'), function ($query) use ($request) {
                    $query->where('vendor_id', $request->vendor_id);
                })
                ->when($request->filled('category_id'), function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->when($request->filled('search'), function ($query) use ($request) {
                    $search = trim($request->search);

                    $query->where(function ($q) use ($search) {
                        $q->where('product_name', 'like', "%{$search}%")
                            ->orWhere('product_code', 'like', "%{$search}%")
                            ->orWhereHas('vendor', function ($vendor) use ($search) {
                                $vendor->where('business_name', 'like', "%{$search}%");
                            });
                    });
                })
                ->latest()
                ->get();
        

        return view('super-admin.product_approvals.index', array_merge([
            'products'   => $products,
            'categories' => Category::orderBy('category_name')->get(),
            'kpis' => [
                'pending' => $pendingCount,
                'today' => $todayCount,
                'vendors' => $vendorsCount,
                'avg' => round($avgApprovalDays, 1),
            ],
        ], $this->pageData(
            'Product Approval Center',
            'Home|Products|Approval Center'
        )));
    }

    /**
     * Display products that have already been approved.
     */
    public function approved(Request $request)
    {
        $this->authorize('viewAnyApprovalQueue', Product::class);

        $products = Product::query()
            ->with([
                'vendor',
                'category',
                'primaryImage.file',
            ])
            ->withCount('variants')
            ->where('approval_status', 'approved')
            ->when(auth()->user()->hasRole('vendor'), function ($query) {
                $query->where('vendor_id', auth()->user()->vendor?->vendor_id);
            })
            ->latest()
            ->paginate(15);

        return view('super-admin.product_approvals.approved', array_merge([
            'products' => $products,
        ], $this->pageData(
            'Approved Products',
            'Home|Products|Approved Products'
        )));
    }

    /**
     * Return product details for the preview drawer.
     */

    public function preview(string $productId)
    {
        $product = Product::with([
            'vendor',
            'category',
            'variants.size',
            'variants.color',
            'images.file',
            'approvalHistories.performer',
        ])->findOrFail($productId);

        return response()->json([
            'success' => true,
            'data' => array_merge(
                $product->toArray(),
                ['primary_image_url' => $product->firstImage()]
            ),
        ]);
    }

    /**
     * Approve one or more products.
     */
    public function approve(Request $request, ?string $productId = null)
    {
        $this->authorize('actionApproval', Product::class);

        try {
            $products = $request->input('products', []);

            if (empty($products) && $productId) {
                $products = [$productId];
            }

            if (empty($products)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select at least one product to approve.',
                ], 400);
            }

            $this->approvalService->approve($products);

            return response()->json([
                'success' => true,
                'message' => 'Product(s) approved successfully.',
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Unable to approve the selected product(s). Please try again.',
            ], 500);
        }
    }

    /**
     * Reject one or more products.
     */
    public function reject(Request $request, ?string $productId = null)
    {
        $this->authorize('actionApproval', Product::class);

        $request->validate([
            'reason' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        try {
            $products = $request->input('products', []);

            if (empty($products) && $productId) {
                $products = [$productId];
            }

            if (empty($products)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select at least one product to reject.',
                ], 400);
            }

            $this->approvalService->reject($products, $request->reason);

            return response()->json([
                'success' => true,
                'message' => 'Product(s) rejected successfully.',
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Unable to reject the selected product(s). Please try again.',
            ], 500);
        }
    }
}