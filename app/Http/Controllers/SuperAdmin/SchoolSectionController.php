<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\SchoolSection;
use App\Models\SuperAdmin\SchoolStandard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class SchoolSectionController extends BaseController
{
    protected string $title = 'School Section Management';

    /**
     * Display sections for a specific school standard.
     */
    public function index(SchoolStandard $schoolStandard): View
    {
        $sections = $schoolStandard->sections()->latest()->get();

        return view('super-admin.school-section.index', compact('schoolStandard', 'sections'), $this->pageData('Manage Sections', 'Home|School Standards|' . $schoolStandard->standard_name . '|Sections'));
    }

    /**
     * Store a newly created school section.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'standard_id' => 'required|exists:school_standards,id',
            'school_id' => 'required|exists:schools,school_id',
            'section_name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        try {
            SchoolSection::create([
                'school_id' => $request->school_id,
                'standard_id' => $request->standard_id,
                'section_name' => $request->section_name,
                'is_active' => $request->boolean('is_active'),
            ]);

            return back()->with('success', 'School section created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create school section: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified school section from storage.
     */
    public function destroy(SchoolSection $schoolSection)
    {
        try {
            $schoolSection->delete();

            if (request()->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'School section deleted successfully.'
                ]);
            }

            return back()->with('success', 'School section deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to delete school section: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to delete school section: ' . $e->getMessage());
        }
    }
}
