<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\SchoolProductApproval;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolProductController extends BaseController
{
    public function index(Request $request)
    {
        // Ensure the user is associated with a school
        $school = $request->user()->school;
        if (!$school) {
            return redirect()->route('dashboard')->with('error', 'No school associated with your account.');
        }

        if ($request->ajax()) {
            // Only show products that have been approved for this specific school
            $query = Product::query()
                ->where('approval_status', 'approved') // Approved by Super Admin
                ->whereHas('schoolApprovals', function ($q) use ($school) {
                    $q->where('school_id', $school->school_id)
                      ->where('status', 'approved'); // Approved by this School
                })
                ->with(['vendor', 'category']);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('vendor_name', function ($row) {
                    return $row->vendor->business_name ?? 'N/A';
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category->category_name ?? 'N/A';
                })
                ->addColumn('product_image', function ($row) {
                    return '<img src="'.($row->firstImage() ?? asset("assets/images/no_image.jpg")).'" class="img-fluid rounded" width="40">';
                })->addColumn('actions', function ($row) {
    return '<button class="btn btn-sm btn-primary" onclick="previewProduct(\'' . $row->product_id . '\')">Preview</button>';
})
                ->rawColumns(['product_image', 'actions'])
                ->make(true);
        }

        return view('school.products.index', $this->pageData('My Approved Products', 'Home|My Products'));
    }
}
