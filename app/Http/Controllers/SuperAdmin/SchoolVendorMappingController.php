<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SchoolVendorMapping;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SchoolVendorMappingController extends BaseController
{
    public function index(Request $request)
    {
        if (Gate::denies('school_vendor.view')) {
            abort(403);
        }

        $mappings = SchoolVendorMapping::with(['school', 'vendor']);

        if ($request->filled('school_id')) {
            $mappings->where('school_id', $request->school_id);
        }

        if ($request->filled('vendor_id')) {
            $mappings->where('vendor_id', $request->vendor_id);
        }

        $mappings = $mappings->paginate(15);
        $schools = School::all();
        $vendors = Vendor::all();

        return view('super-admin.school-vendor-mapping.index', compact('mappings', 'schools', 'vendors'), $this->pageData('School Vendor Mappings', 'Super Admin|School Vendor Mappings'));
    }

    public function create()
    {
        if (Gate::denies('school_vendor.create')) {
            abort(403);
        }

        $schools = School::all();
        $vendors = Vendor::all();

        return view('super-admin.school-vendor-mapping.create', compact('schools', 'vendors'), $this->pageData('Add Mapping', 'Super Admin|School Vendor Mappings|Create'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('school_vendor.create')) {
            abort(403);
        }

        $request->validate([
            'school_id' => 'required|exists:schools,school_id',
            'vendor_id' => 'required|exists:vendors,vendor_id',
        ]);

        SchoolVendorMapping::create($request->all());

        return redirect()->route('school-vendor-mapping.index')->with('success', 'Mapping created successfully.');
    }

    public function destroy($id)
    {
        if (Gate::denies('school_vendor.delete')) {
            abort(403);
        }

        SchoolVendorMapping::findOrFail($id)->delete();

        return redirect()->route('school-vendor-mapping.index')->with('success', 'Mapping deleted successfully.');
    }
}
