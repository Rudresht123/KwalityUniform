<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreProductRequest;
use App\Http\Requests\SuperAdmin\UpdateProductRequest;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\Size;
use App\Models\SuperAdmin\Color;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use Illuminate\Support\Facades\DB;

use App\Notifications\ProductApprovalRequestNotification;
use App\Notifications\ProductStatusUpdatedNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Services\EmailService;
use Laravel\Reverb\Loggers\Log;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['vendor', 'category', 'primaryImage.file'])->latest();

            // Filter by vendor if the user is a vendor
            if (auth()->user()->hasRole('vendor')) {
                $vendorId = auth()->user()->vendor?->vendor_id;
                $products->where('vendor_id', $vendorId);
            }

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = $row->firstImage();
                    return '<img src="' . $url . '" alt="Product Image" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">';
                })
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
                    return $row->is_active ? '<span class="badge bg-success">ACTIVE</span>' : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    $actions = view('super-admin.product.actions', compact('row'))->render();
                    return '<div class="d-flex justify-content-center">' . $actions . '</div>';
                })
                ->rawColumns(['image', 'approval_status', 'status', 'options'])
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
        $sizes = Size::active()->orderBy('sort_order')->get();
        $colors = Color::active()->get();
        return view('super-admin.product.create', compact('vendors', 'categories', 'sizes', 'colors'), $this->pageData('Create Product', 'Home|Products|Create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
     
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // If user is a vendor, force their vendor_id and set status to pending
            if (auth()->user()->hasRole('vendor')) {
                $vendor = auth()->user()->vendor;
                if (!$vendor) {
                    return back()->with('error', 'Vendor account not found.');
                }
                $data['vendor_id'] = $vendor->vendor_id;
                $data['approval_status'] = 'pending';
            }

            
          
            $product = Product::create($data);


            // Handle Multiple Image Uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $fileId = uploadFile($image, 'products');

                    $product->images()->create([
                        'file_id' => $fileId,
                        'is_primary' => $index === 0, // First image is primary
                        'sort_order' => $index,
                    ]);
                }
            }

            // Create Variants
            if ($request->has('variants')) {
                foreach ($request->variants as $variantData) {
                    $product->variants()->create($variantData);
                }
            }

            // Notify Super Admin and Admins
            $admins = User::role(['super-admin', 'admin'])->get();
            sendNotification(
                $admins,
                'product_approval_request',
                [
                    'product_name' => $product->product_name,
                    'vendor_name' => $product->vendor->business_name,
                ],
                route('product.show', $product->product_id),
            );

            // Also send branded email for New Product Request
            foreach ($admins as $admin) {
                EmailService::send('product_approval_request', $admin->email, [
                    'product_name' => $product->product_name,
                    'vendor_name' => $product->vendor->business_name,
                    'view_button' => '<a href="' . route('product.show', $product->product_id) . '" style="background-color: #6B62DD; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Review Product</a>',
                ]);
            }
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Your product has been created successfully and submitted for admin approval.');
        } catch (Throwable $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Product creation failed: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return back()->withInput()->with('error', 'Failed to create product. Please check your inputs and try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Check ownership if user is a vendor
        if (auth()->user()->hasRole('vendor')) {
            $vendorId = auth()->user()->vendor?->vendor_id;
            if ($product->vendor_id !== $vendorId) {
                abort(403, 'Unauthorized access to this product.');
            }
        }

        $product->load(['vendor', 'category', 'creator', 'updater', 'variants.size', 'variants.color', 'images.file']);
        return view('super-admin.product.show', compact('product'), $this->pageData('Product Details', 'Home|Products|View'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Check ownership if user is a vendor
        if (auth()->user()->hasRole('vendor')) {
            $vendorId = auth()->user()->vendor?->vendor_id;
            if ($product->vendor_id !== $vendorId) {
                abort(403, 'Unauthorized access to this product.');
            }
        }

        $product->load(['variants', 'primaryImage.file']);
        $vendors = Vendor::approved()->get();
        $categories = Category::active()->get();
        $sizes = Size::active()->orderBy('sort_order')->get();
        $colors = Color::active()->get();
        return view('super-admin.product.edit', compact('product', 'vendors', 'categories', 'sizes', 'colors'), $this->pageData('Edit Product', 'Home|Products|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            // Check ownership if user is a vendor
            if (auth()->user()->hasRole('vendor')) {
                $vendorId = auth()->user()->vendor?->vendor_id;
                if ($product->vendor_id !== $vendorId) {
                    abort(403, 'Unauthorized access to this product.');
                }
            }

            $data = $request->validated();
            $oldStatus = $product->approval_status;

            // Restrict status update to Admins only
            if (isset($data['approval_status']) && $data['approval_status'] !== $oldStatus) {
                if (
                    !auth()
                        ->user()
                        ->hasAnyRole(['super-admin', 'admin'])
                ) {
                    unset($data['approval_status']); // Vendors cannot approve their own products
                }
            }

            // If user is a vendor, force their vendor_id
            if (auth()->user()->hasRole('vendor')) {
                $data['vendor_id'] = auth()->user()->vendor->vendor_id;
            }

            $product->update($data);

            // Handle resubmission: if a rejected product is updated by vendor, set it back to pending
            if (auth()->user()->hasRole('vendor') && $oldStatus === 'rejected') {
                app(\App\Services\ProductApprovalService::class)->resubmit($product, 'Product updated by vendor and resubmitted for approval.');
            }

            // Handle Multiple Image Uploads
            if ($request->hasFile('images')) {
                $hasPrimary = $product->images()->where('is_primary', true)->exists();

                foreach ($request->file('images') as $index => $image) {
                   
                    $fileId = uploadFile($image, 'products');
                    $product->images()->create([
                        'file_id' => $fileId,
                        'is_primary' => !$hasPrimary && $index === 0,
                        'sort_order' => $product->images()->count(),
                    ]);
                }
            }

            // Sync Variants
            if ($request->has('variants')) {
                $variantIds = collect($request->variants)->pluck('variant_id')->filter()->toArray();
                $product->variants()->whereNotIn('variant_id', $variantIds)->delete();

                foreach ($request->variants as $variantData) {
                    if (!empty($variantData['variant_id'])) {
                        $product->variants()->where('variant_id', $variantData['variant_id'])->update($variantData);
                    } else {
                        $product->variants()->create($variantData);
                    }
                }
            }

            // If status changed to approved/rejected, notify Vendor
            if (isset($data['approval_status']) && $data['approval_status'] !== $oldStatus) {
                $vendorUser = $product->vendor->user;
                if ($vendorUser) {
                    // 1. System Notification
                    $vendorUser->notify(new ProductStatusUpdatedNotification($product, $request->admin_message ?? ''));

                    // 2. Branded Email
                    EmailService::send('product_status_updated', $vendorUser->email, [
                        'vendor_name' => $product->vendor->owner_name,
                        'product_name' => $product->product_name,
                        'product_code' => $product->product_code,
                        'status' => strtoupper($data['approval_status']),
                        'admin_message' => $request->admin_message ?? 'Status has been updated by the administration.',
                        'view_button' => '<a href="' . route('product.show', $product->product_id) . '" style="background-color: #6B62DD; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Product</a>',
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::info($e);
            return back()
                ->withInput()
                ->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Check ownership if user is a vendor
            if (auth()->user()->hasRole('vendor')) {
                $vendorId = auth()->user()->vendor?->vendor_id;
                if ($product->vendor_id !== $vendorId) {
                    abort(403, 'Unauthorized access to this product.');
                }
            }

            $product->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Product deleted successfully.'
                ]);
            }

            return redirect()
                ->route('product.index')
                ->with(['success', 'Product deleted successfully.']);
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete product: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error','Failed to delete product: ' . $e->getMessage());
        }
    }

    public function approve(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->update([
                'approval_status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);

            // Vendor User
            $vendorUser = $product->vendor?->user;

            if ($vendorUser) {
                // 1. System Notification
                sendNotification(
                    $vendorUser,
                    'product_approved',
                    [
                        'product_name' => $product->product_name,
                    ],
                    route('vendor.products.show', $product->product_id),
                );

                // 2. Branded Email
                EmailService::send('product_approved', $vendorUser->email, [
                    'vendor_name' => $product->vendor->owner_name,
                    'product_name' => $product->product_name,
                    'product_code' => $product->product_code,
                    'status' => 'APPROVED',
                    'view_button' => '<a href="' . route('product.show', $product->product_id) . '" style="background-color: #6B62DD; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Product</a>',
                ]);
            }

            DB::commit();
            return back()->with(['success', 'Product approved successfully.']);
        } catch (\Throwable $e) {
            DB::rollBack();

            report($e);

            notify()->error('Failed to approve product.');

            return back();
        }
    }
}
