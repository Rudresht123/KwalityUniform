<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreCategoryRequest;
use App\Http\Requests\SuperAdmin\UpdateCategoryRequest;
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

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = $this->categoryService->getAllCategories();

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action_type', function ($row) {
                    return '<span class="badge bg-primary-transparent">' . strtoupper($row->parentCategory->name ?? 'N/A') . '</span>';
                })
                ->addColumn('size_status', function ($row) {
                    return $row->requires_size 
                        ? '<span class="badge bg-success-transparent">REQUIRED</span>' 
                        : '<span class="badge bg-secondary-transparent">NOT REQUIRED</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('super-admin.category.actions', compact('row'))->render();
                })
                ->rawColumns(['action_type', 'size_status', 'status', 'options'])
                ->make(true);
        }

        return view('super-admin.category.index', $this->pageData('Sub Category Management', 'Home|Product Attributes|Sub Categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = $this->categoryService->getActiveParents();
        return view('super-admin.category.create', compact('parents'), $this->pageData('Create Sub Category', 'Home|Product Attributes|Sub Categories|Create'));
    }

    public function ajaxStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_name' => 'required|string|max:255',
                'parent_id' => 'nullable|uuid|exists:parent_categories,parent_id',
            ]);
            $category = $this->categoryService->createCategory($validated);
            return response()->json(['success' => true, 'category' => $category]);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parents = $this->categoryService->getActiveParents();
        return view('super-admin.category.edit', compact('category', 'parents'), $this->pageData('Edit Sub Category', 'Home|Product Attributes|Sub Categories|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->categoryService->updateCategory($category, $request->validated());
            return redirect()->route('category.index')->with('success', 'Sub category updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update sub category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->categoryService->deleteCategory($category);
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Sub category deleted successfully.'
                ]);
            }
            
            return redirect()->route('category.index')->with('success', 'Sub category deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete sub category: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete sub category: ' . $e->getMessage());
        }
    }
}
