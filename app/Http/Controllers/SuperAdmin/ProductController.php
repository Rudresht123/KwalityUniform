<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreProductRequest;
use App\Http\Requests\SuperAdmin\UpdateProductRequest;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

use App\Notifications\ProductApprovalRequestNotification;
use App\Notifications\ProductStatusUpdatedNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Services\EmailService;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['vendor', 'category'])->latest();

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('vendor_name', function ($row) {
                    return $row->vendor->business_name ?? 'N/A';
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category->category_name ?? 'N/A';
                })
                ->addColumn('approval_status', function ($row) {
                    $class = match ($row->approval_status) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    };
                    return '<span class="badge bg-' . $class . '-transparent">' . strtoupper($row->approval_status) . '</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('super-admin.product.actions', compact('row'))->render();
                })
                ->rawColumns(['approval_status', 'status', 'options'])
                ->make(true);
        }

        return view('super-admin.product.index', $this->pageData('Product Management', 'Home|Products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::approved()->get();
        $categories = Category::active()->get();
        return view('super-admin.product.create', compact('vendors', 'categories'), $this->pageData('Create Product', 'Home|Products|Create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());

            // Notify Super Admin and Admins
            $admins = User::role(['super-admin', 'admin'])->get();
            Notification::send($admins, new ProductApprovalRequestNotification($product));

            return redirect()->route('product.index')->with('success', 'Product created successfully and submitted for approval.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['vendor', 'category', 'creator', 'updater']);
        return view('super-admin.product.show', compact('product'), $this->pageData('Product Details', 'Home|Products|View'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $vendors = Vendor::approved()->get();
        $categories = Category::active()->get();
        return view('super-admin.product.edit', compact('product', 'vendors', 'categories'), $this->pageData('Edit Product', 'Home|Products|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            $oldStatus = $product->approval_status;

            // Restrict status update to Admins only
            if (isset($data['approval_status']) && $data['approval_status'] !== $oldStatus) {
                if (!auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
                    unset($data['approval_status']); // Vendors cannot approve their own products
                }
            }

            $product->update($data);

            // If status changed to approved/rejected, notify Vendor
            if (isset($data['approval_status']) && $data['approval_status'] !== $oldStatus) {
                $vendorUser = $product->vendor->user; // Assuming Vendor belongsTo User
                if ($vendorUser) {
                    $vendorUser->notify(new ProductStatusUpdatedNotification($product, $request->admin_message ?? ''));
                    
                    // Also send Email using EmailService for branding
                    EmailService::send('product_status_updated', $vendorUser->email, [
                        'vendor_name' => $product->vendor->owner_name,
                        'product_name' => $product->product_name,
                        'product_code' => $product->product_code,
                        'status' => strtoupper($product->approval_status),
                        'admin_message' => $request->admin_message ?? 'Status has been updated by the administration.',
                        'view_button' => '<a href="' . route('product.show', $product->product_id) . '" style="background-color: #6B62DD; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Product</a>'
                    ]);
                }
            }

            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
