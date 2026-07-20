<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreParentCategoryRequest;
use App\Http\Requests\SuperAdmin\UpdateParentCategoryRequest;
use App\Models\SuperAdmin\ParentCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class ParentCategoryController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $parents = ParentCategory::latest();

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

        return view('vendor.parent-category.index', $this->pageData('Parent Category Management', 'Home|Product Attributes|Parent Categories'));
    }

    public function create()
    {
        return view('vendor.parent-category.create', $this->pageData('Create Parent Category', 'Home|Product Attributes|Parent Categories|Create'));
    }

    public function store(StoreParentCategoryRequest $request)
    {
        try {
            ParentCategory::create($request->validated());
            return redirect()->route('parent-category.index')->with('success', 'Parent category created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create parent category: ' . $e->getMessage());
        }
    }

    public function ajaxStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $parent = ParentCategory::create($validated);
            return response()->json(['success' => true, 'parent' => $parent]);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(ParentCategory $parentCategory)
    {
        return view('vendor.parent-category.edit', compact('parentCategory'), $this->pageData('Edit Parent Category', 'Home|Product Attributes|Parent Categories|Edit'));
    }

    public function update(UpdateParentCategoryRequest $request, ParentCategory $parentCategory)
    {
        try {
            $parentCategory->update($request->validated());
            return redirect()->route('parent-category.index')->with('success', 'Parent category updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update parent category: ' . $e->getMessage());
        }
    }

    public function destroy(ParentCategory $parentCategory)
    {
        try {
            $parentCategory->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Parent category deleted successfully.'
                ]);
            }
            
            return redirect()->route('parent-category.index')->with('success', 'Parent category deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete parent category: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete parent category: ' . $e->getMessage());
        }
    }
}
