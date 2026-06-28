<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductAssignment;
use App\Models\SuperAdmin\SchoolSection;
use App\Models\SuperAdmin\SchoolStandard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class ProductAssignmentController extends BaseController
{
    protected string $title = 'Product Assignment Management';

    /**
     * Display the product assignment page for a specific product.
     */
    public function index(Product $product): View
    {
        $standards = SchoolStandard::all();
        $sections = SchoolSection::all();
        $assignments = $product->productAssignments()->with(['standard', 'section'])->get();

        return view('super-admin.product-assignment.index', compact('product', 'standards', 'sections', 'assignments'), $this->pageData('Assign Product to Standards/Sections', 'Home|Products|' . $product->product_name . '|Assignments'));
    }

    /**
     * Store a new product assignment.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'assignment_type' => 'required|in:standard,section',
            'standard_id' => 'nullable|required_if:assignment_type,standard|exists:school_standards,id',
            'section_id' => 'nullable|required_if:assignment_type,section|exists:school_sections,id',
        ]);

        try {
            ProductAssignment::create([
                'product_id' => $request->product_id,
                'assignment_type' => $request->assignment_type,
                'standard_id' => $request->standard_id,
                'section_id' => $request->section_id,
            ]);

            return back()->with('success', 'Product assigned successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to assign product: ' . $e->getMessage());
        }
    }

    /**
     * Remove a product assignment.
     */
    public function destroy(ProductAssignment $productAssignment)
    {
        try {
            $productAssignment->delete();

            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Product assignment removed successfully.'
                ]);
            }

            return back()->with('success', 'Product assignment removed successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to remove product assignment: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to remove product assignment: ' . $e->getMessage());
        }
    }
}
