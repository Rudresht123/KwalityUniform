<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\ParentCategory;
use App\Services\ParentCategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class ParentCategoryController extends BaseController
{
    protected ParentCategoryService $parentCategoryService;

    public function __construct(ParentCategoryService $parentCategoryService)
    {
        $this->parentCategoryService = $parentCategoryService;
    }

    public function index(Request $request)
    {
        $vendor = auth()->user()->vendor;
        if (!$vendor) {
            return redirect()->route('home')->with('error', 'Vendor profile not found.');
        }

        if ($request->ajax()) {
            $parents = $this->parentCategoryService->getAllParentCategories($vendor->vendor_id);

            return DataTables::of($parents)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('vendor.parent-category.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('vendor.parent-category.index', $this->pageData('Parent Category Management', 'Home|Parent Categories'));
    }

    public function create()
    {
        return view('vendor.parent-category.create', $this->pageData('Create Parent Category', 'Home|Parent Categories|Create'));
    }

    public function store(Request $request)
    {
        try {
            $vendor = auth()->user()->vendor;
            $data = $request->all();
            $data['vendor_id'] = $vendor->vendor_id;

            $this->parentCategoryService->createParentCategory($data);
            return redirect()->route('parent-category.index')->with('success', 'Parent Category created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create parent category: ' . $e->getMessage());
        }
    }

    public function edit(ParentCategory $parentCategory)
    {
        $vendor = auth()->user()->vendor;
        if ($parentCategory->vendor_id !== $vendor->vendor_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('vendor.parent-category.edit', compact('parentCategory'), $this->pageData('Edit Parent Category', 'Home|Parent Categories|Edit'));
    }

    public function update(Request $request, ParentCategory $parentCategory)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($parentCategory->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->parentCategoryService->updateParentCategory($parentCategory, $request->all());
            return redirect()->route('parent-category.index')->with('success', 'Parent Category updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update parent category: ' . $e->getMessage());
        }
    }

    public function destroy(ParentCategory $parentCategory)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($parentCategory->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->parentCategoryService->deleteParentCategory($parentCategory);
            
            if (request()->ajax()) {
                return response()->json(['status' => true, 'message' => 'Parent Category deleted successfully.']);
            }
            
            return redirect()->route('parent-category.index')->with('success', 'Parent Category deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
            return back()->with('error', 'Failed to delete parent category: ' . $e->getMessage());
        }
    }
}
