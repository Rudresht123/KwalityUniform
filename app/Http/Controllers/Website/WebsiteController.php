<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller{
    public function index(){
        return view('website.index', [
            'featuredSchools' => featuredSchools(),
            'featuredCategories' => featuredCategories(),
            'featuredProducts' => featuredProducts(),
        ]);
    }

    public function shop(Request $request) {
        $filters = [
            'school' => $request->query('school'),
            'category' => $request->query('category'),
            'search' => $request->query('search'),
        ];

        $products = (new \App\Repositories\ProductRepository())->searchProducts($filters);
        $schools = \App\Models\SuperAdmin\School::active()->get();
        $categories = \App\Models\SuperAdmin\ParentCategory::active()->get();

        if ($request->ajax()) {
            return view('website.partials.shop-products', compact('products', 'filters'))->render();
        }

        return view('website.pages.shop', [
            'products' => $products,
            'schools' => $schools,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    public function show($id) {
        $product = \App\Models\SuperAdmin\Product::approved()->active()->with(['variants', 'images', 'schoolApprovals.school'])->findOrFail($id);

        return view('website.pages.product-details', [
            'product' => $product
        ]);
    }

    public function about() {

        return view('website.pages.about');
    }

    public function contact() {
        return view('website.pages.contact');
    }
}