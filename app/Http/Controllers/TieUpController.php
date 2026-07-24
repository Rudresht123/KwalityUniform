<?php

namespace App\Http\Controllers;

use App\Models\VendorSchoolTieup;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TieUpController extends BaseController
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('vendor')) {
            $tieups = VendorSchoolTieup::where('vendor_id', $user->vendor->vendor_id)->get();
            $schools = School::all();
            $categories = Category::where('is_active', true)->get();
            return view(
                'vendor.tieups.index',
                array_merge(
                    compact('tieups', 'schools', 'categories'),
                    $this->pageData(
                        'School Tie-Ups Request',
                        'Home|Vendor Tie-Ups Request'
                    )
                )
            );
        } elseif ($user->hasRole('school')) {
            $tieups = VendorSchoolTieup::where('school_id', $user->school->school_id)->get();

            return view(
                'school.tieups.index',
                array_merge(
                    compact('tieups'),
                    $this->pageData(
                        'Vendor Tie-Ups Request',
                        'Home|Vendor Tie-Ups Request'
                    )
                )
            );
        }
        return redirect()->back()->with('error', 'Unauthorized');
    }

    // Vendor submits request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,school_id',
            'categories' => 'required|array',
        ]);

        foreach ($validated['categories'] as $categoryId) {
            VendorSchoolTieup::updateOrCreate([
                'vendor_id' => Auth::user()->vendor->vendor_id,
                'school_id' => $validated['school_id'],
                'main_category_id' => $categoryId,
            ], [
                'status' => 'pending',
                'remarks' => $request->remarks,
            ]);
        }

        return back()->with('success', 'Tie-up request submitted.');
    }

    // School approves or rejects
    public function update(Request $request, $id)
    {
        $tieup = VendorSchoolTieup::findOrFail($id);

        $request->validate(['status' => 'required|in:approved,rejected']);

        $tieup->update([
            'status' => $request->status,
            'remarks' => $request->remarks,
            'approved_by' => Auth::id(),
            'approved_at' => $request->status === 'approved' ? now() : null,
            'rejected_at' => $request->status === 'rejected' ? now() : null,
        ]);

        return back()->with('success', 'Request ' . $request->status . ' successfully.');
    }
}
