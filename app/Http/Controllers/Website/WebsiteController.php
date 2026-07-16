<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\ParentCategory;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\School;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SuperAdmin\SchoolPartnershipRequest;
use App\Repositories\ProductRepository;
use App\Services\EmailService;
use Illuminate\Support\Facades\Auth;
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
    $classId = $request->query('class');
    $parentCategoryId = $request->query('parent_category');
    $subCategoryId = $request->query('sub_category');
    $search = $request->query('search');

    $filters = [
        'school' => $schoolId,
        'class' => $classId,
        'parent_category' => $parentCategoryId,
        'sub_category' => $subCategoryId,
        'search' => $search,
    ];

    $products = new ProductRepository()->searchProducts($filters);
    $schools = School::active()->get();
    $parentCategories = ParentCategory::active()->get();

    $subCategories = collect();
    if ($parentCategoryId) {
        $subCategories = Category::where('parent_id', $parentCategoryId)
            ->where('is_active', true)
            ->get(['category_id', 'category_name']);
    }

    if ($request->ajax()) {
        return view('website.partials.shop-products', compact('products', 'filters', 'subCategories'))->render();
    }

    return view('website.pages.shop', [
        'products' => $products,
        'schools' => $schools,
        'categories' => $parentCategories,
        'subCategories' => $subCategories,
        'filters' => $filters,
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

    if (Auth::check()) {
        \DB::table('user_recently_viewed')->updateOrInsert(
            ['user_id' => Auth::id(), 'product_id' => $product->product_id],
            ['updated_at' => now()]
        );
    }

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
        $contactInfo = [
            'address' => \App\Models\GlobalSetting::get('contact_address', 'Sector 81, Noida, Uttar Pradesh'),
            'phone'   => \App\Models\GlobalSetting::get('contact_phone', '+91 98765 43210'),
            'email'   => \App\Models\GlobalSetting::get('contact_email', 'support@qualityuniform.com'),
            'hours'   => \App\Models\GlobalSetting::get('working_hours', 'Mon - Sat<br>9:00 AM - 6:00 PM'),
        ];

        return view('website.pages.contact', compact('contactInfo'));
    }

    public function terms()
    {
        return view('website.pages.terms');
    }

    public function privacy()
    {
        return view('website.pages.privacy');
    }

    public function returns()
    {
        return view('website.pages.returns');
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

public function storeContact(Request $request)
{
    try {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'subject'   => 'required|string|max:255',
            'message'   => 'required|string',
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been submitted successfully. We will get back to you soon.',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors'  => $e->errors(),
        ], 422);
    } catch (\Throwable $e) {
        Log::error('Contact Form Error', [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again later.',
        ], 500);
    }
}

    public function recentlyViewed()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please login to view your recently visited products.');
        }

        $userId = Auth::id();
        $recentProductIds = DB::table('user_recently_viewed')
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->pluck('product_id');

        $products = Product::whereIn('product_id', $recentProductIds)
            ->with(['images', 'category'])
            ->orderByRaw("FIELD(product_id, " . implode(',', $recentProductIds->toArray() ?: [0]) . ")")
            ->get();

        return view('website.pages.recently-viewed', [
            'products' => $products,
        ]);
    }
}

