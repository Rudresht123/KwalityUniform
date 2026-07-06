<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\ParentCategory;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\School;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SuperAdmin\SchoolPartnershipRequest;
use App\Models\SuperAdmin\SchoolStandard;
use App\Repositories\ProductRepository;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.index', [
            'featuredSchools' => featuredSchools(),
            'featuredCategories' => featuredCategories(),
            'featuredProducts' => featuredProducts(),
        ]);
    }

public function shop(Request $request)
{
    $schoolId = $request->query('school');
    $parentCategoryId = $request->query('parent_category');
    $subCategoryId = $request->query('sub_category');
    $search = $request->query('search');

    $filters = [
        'school' => $schoolId,
        'parent_category' => $parentCategoryId,
        'sub_category' => $subCategoryId,
        'search' => $search,
    ];

    $products = new ProductRepository()->searchProducts($filters);
    $schools = School::active()->get();
    $parentCategories = ParentCategory::active()->get();

    $standards = collect();
    if ($schoolId) {
        $standards = SchoolStandard::where('school_id', $schoolId)
            ->where('is_active', true)
            ->select('id', 'standard_name')
            ->get();
    }

    $subCategories = collect();
    if ($parentCategoryId) {
        $subCategories = Category::where('parent_id', $parentCategoryId)
            ->where('is_active', true)
            ->get(['category_id', 'category_name']);
    }

    if ($request->ajax()) {
        return view('website.partials.shop-products', compact('products', 'filters', 'standards', 'subCategories'))->render();
    }

    return view('website.pages.shop', [
        'products' => $products,
        'schools' => $schools,
        'categories' => $parentCategories,
        'subCategories' => $subCategories,
        'filters' => $filters,
        'standards' => $standards,
    ]);
}

public function getSubCategories($parent_id)
{
    $subCategories = Category::where('parent_id', $parent_id)
        ->where('is_active', true)
        ->get(['category_id', 'category_name']);

    return response()->json([
        'success' => true,
        'subCategories' => $subCategories,
    ]);
}

public function show($id)
{
        $product = Product::approved()
            ->active()
            ->with(['variants', 'images', 'schoolApprovals.school'])
            ->findOrFail($id);

        return view('website.pages.product-details', [
            'product' => $product,
        ]);
    }
    public function showJson($id)
    {
        $product = Product::approved()
            ->active()
            ->with(['variants', 'images', 'category', 'schoolApprovals.school'])
            ->findOrFail($id);

        $productData = [
            'id' => $product->product_id,
            'name' => $product->product_name,
            'description' => $product->description,
            'price' => $product->price,
            'category' => $product->category?->category_name,
            'school' => $product->schoolApprovals->first()?->school?->school_name ?? 'General Wear',
            'fabric' => $product->fabric_composition,
            'gender' => $product->gender_type,
            'variants' => $product->variants->map(
                fn($variant) => [
                    'variant_id' => $variant->variant_id,
                    'size_id' => $variant->size?->size_id,
                    'display_name' => $variant->size?->display_name,
                    'size_name' => $variant->size?->size_name,
                    'mrp' => $variant?->mrp,
                    'selling_price' => $variant?->selling_price,
                    'stock_qty' => $variant?->stock_qty,
                    'sku' => $variant?->sku,
                    'color_id' => $variant->color?->color_id,
                    'color_name' => $variant->color?->color_name,
                    'hex_code' => $variant->color?->hex_code,
                    'price' => $variant->price,
                ],
            ),
            'images' => $product->images->map(fn($image) => getFileUrl($image->file_id))->toArray(),
        ];

        return view('website.products.product-description', [
            'product' => $productData,
        ]);
    }

    public function about()
    {
        return view('website.pages.about');
    }

    public function contact()
    {
        return view('website.pages.contact');
    }

    public function storeSchoolPartnership(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'school_name' => 'required|string|max:255',
                    'contact_person' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:school_partnership_requests,email',
                    'phone' => 'required|string|max:20',
                    'address' => 'required|string|max:500',
                    'city' => 'required|string|max:100',
                    'state' => 'required|string|max:100',
                    'pincode' => 'required|string|max:20',
                    'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                ],
                [
                    'email.unique' => 'This email has already submitted a partnership request.',
                ],
            );

            if (User::where('email', $validated['email'])->exists()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'This email is already registered.',
                        'errors' => [
                            'email' => ['This email is already registered. Please login instead.'],
                        ],
                    ],
                    422,
                );
            }

            DB::beginTransaction();

            $documentId = null;

            if ($request->hasFile('document')) {
                $documentId = uploadFile($request->file('document'), 'partnership/schools');
            }

            $partnership = SchoolPartnershipRequest::create([
                'school_name' => $validated['school_name'],
                'contact_person' => $validated['contact_person'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'document_path' => $documentId,
            ]);

            DB::commit();

            try {
                EmailService::send('partnership_request_admin', 'admin@qualityuniform.com', [
                    'school_name' => $validated['school_name'],
                    'contact_person' => $validated['contact_person'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'pincode' => $validated['pincode'],
                    'document' => $documentId ? getFileUrl($documentId) : 'No document uploaded',
                ]);

                EmailService::send('partnership_request_user', $validated['email'], [
                    'school_name' => $validated['school_name'],
                    'contact_person' => $validated['contact_person'],
                ]);
            } catch (\Throwable $mailException) {
                Log::error('School Partnership Mail Error', [
                    'message' => $mailException->getMessage(),
                    'trace' => $mailException->getTraceAsString(),
                ]);
            }

            return response()->json([
                'success' => true,
                'title' => 'Success',
                'message' => 'Your partnership request has been submitted successfully.',
                'data' => $partnership,
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('School Partnership Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => app()->environment('production') ? 'Something went wrong.' : $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function storeVendorPartnership(Request $request)
    {
        $validated = $request->validate(
            [
                'company_name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:vendor_partnership_requests,email',
                'gstin' => 'required|string|max:50',
                'address' => 'required|string|max:500',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'pincode' => 'required|string|max:20',
                'pan_number' => 'required|string|max:50',
                'bank_account_no' => 'required|string|max:50',
                'ifsc_code' => 'required|string|max:50',
                'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ],
            [
                'email.unique' => 'This email has already submitted a partnership request.',
            ],
        );

        // Proactively check if email exists in users table to show a clean warning alert
        if (\App\Models\User::where('email', $validated['email'])->exists()) {
            return response()->json(
                [
                    'message' => 'This email is already registered in our system. Please log in or contact support.',
                    'errors' => ['email' => ['This email is already registered.']],
                ],
                422,
            );
        }

        try {
            $documentId = null;
            if ($request->hasFile('document')) {
                $documentId = uploadFile($request->file('document'), 'partnership/vendors');
            }

            // Save to database
            \App\Models\SuperAdmin\VendorPartnershipRequest::create(
                array_merge($validated, [
                    'document_path' => $documentId,
                ]),
            );

            \App\Services\EmailService::send('vendor_request_admin', 'admin@qualityuniform.com', [
                'company_name' => $validated['company_name'],
                'category' => $validated['category'],
                'email' => $validated['email'],
                'gstin' => $validated['gstin'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'pan_number' => $validated['pan_number'],
                'bank_account_no' => $validated['bank_account_no'],
                'ifsc_code' => $validated['ifsc_code'],
                'document' => $documentId ? getFileUrl($documentId) : 'No document provided',
            ]);

            \App\Services\EmailService::send('vendor_request_user', $validated['email'], [
                'company_name' => $validated['company_name'],
            ]);

            return response()->json(['success' => true, 'message' => 'Supplier Application Received!']);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Vendor Partnership Submission Error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
