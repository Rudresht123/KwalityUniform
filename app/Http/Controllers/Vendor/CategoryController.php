<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class CategoryController extends BaseController
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $vendor = auth()->user()->vendor;
        if (!$vendor) {
            return redirect()->route('home')->with('error', 'Vendor profile not found.');
        }

        if ($request->ajax()) {
            $categories = $this->categoryService->getAllCategories($vendor->vendor_id);

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('parent_category', function ($row) {
                    return $row->parentCategory ? $row->parentCategory->name : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('vendor.category.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('vendor.category.index', $this->pageData('Category Management', 'Home|Categories'));
    }

    public function create()
    {
        $vendor = auth()->user()->vendor;
        $parents = $this->categoryService->getActiveParents($vendor->vendor_id);

        return view('vendor.category.create', compact('parents'), $this->pageData('Create Category', 'Home|Categories|Create'));
    }

    public function store(Request $request)
    {
        try {
            $vendor = auth()->user()->vendor;
            $data = $request->all();
            $data['vendor_id'] = $vendor->vendor_id;

            $this->categoryService->createCategory($data);
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create category: ' . $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        $vendor = auth()->user()->vendor;
        if ($category->vendor_id !== $vendor->vendor_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('vendor.category.edit', compact('category'), $this->pageData('Edit Category', 'Home|Categories|Edit'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($category->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->categoryService->updateCategory($category, $request->all());
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update category: ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($category->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->categoryService->deleteCategory($category);
            
            if (request()->ajax()) {
                return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
            }
            
            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
            return back()->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}
