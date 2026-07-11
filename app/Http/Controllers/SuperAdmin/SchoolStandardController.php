<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreSchoolStandardRequest;
use App\Http\Requests\SuperAdmin\UpdateSchoolStandardRequest;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\SchoolStandard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class SchoolStandardController extends BaseController
{
    /**
     * @var string
     */
    protected string $title = 'School Standard Management';

    /**
     * Display a listing of the school standards.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        $query = School::active()->withCount('standards');

        if (!$user->hasRole(['super-admin', 'admin'])) {
            $query->where('user_id', $user->id);
        }

        $schools = $query->latest()->get();

        return view('super-admin.school-standard.index', compact('schools'), $this->pageData($this->title, 'Home|School Standards'));
    }

    /**
     * Show the form for creating a new school standard.
     */
    public function create(): View
    {
        $user = auth()->user();
        $query = School::active();

        if (!$user->hasRole(['super-admin', 'admin'])) {
            $query->where('user_id', $user->id);
        }

        $schools = $query->get();
    
        return view('super-admin.school-standard.create', compact('schools'), $this->pageData('Create School Standard', 'Home|School Standards|Create'));
    }

    /**
     * Store a newly created school standard in storage.
     */
    public function store(StoreSchoolStandardRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $schoolId = $data['school_id'];
            $isActive = $data['is_active'] ?? true;

            foreach ($data['standard_names'] as $standardName) {
                SchoolStandard::create([
                    'school_id' => $schoolId,
                    'standard_name' => $standardName,
                    'is_active' => $isActive,
                ]);
            }

            return redirect()->route('school-standard.index')->with('success', count($data['standard_names']) . ' school standards created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create school standards: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for managing all standards for a specific school.
     */
    public function edit(School $school): View
    {
        $user = auth()->user();
        
        // Authorization check: if school user, ensure they own this school
        if (!$user->hasRole(['super-admin', 'admin'])) {
            if ($school->user_id !== $user->id) {
                abort(403, 'Unauthorized action.');
            }
        }

        $classes = $school->standards()->get();

        return view('super-admin.school-standard.edit', compact('school', 'classes'), $this->pageData('Manage School Standards', 'Home|School Standards|Manage'));
    }

    /**
     * Update the standards for a specific school.
     */
    public function update(Request $request, School $school): RedirectResponse
    {
        $request->validate([
            'standard_names' => 'required|array|min:1',
            'standard_names.*' => 'required|string|max:255',
        ]);

        try {
            // Trim and unique the names to avoid whitespace/duplicate issues
            $newStandardNames = array_unique(array_map('trim', $request->standard_names));

            // 1. Delete standards that are currently active but NOT in the new list
            $school->standards()->whereNotIn('standard_name', $newStandardNames)->delete();

            // 2. Sync the new list: Restore soft-deleted ones or create new ones
            foreach ($newStandardNames as $name) {
                SchoolStandard::withTrashed()->updateOrCreate(
                    [
                        'school_id' => $school->school_id, 
                        'standard_name' => $name
                    ],
                    [
                        'deleted_at' => null, 
                        'is_active' => true
                    ]
                );
            }

            return redirect()->route('school-standard.index')->with('success', 'School standards updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update school standards: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified school standard from storage.
     */
    public function destroy(SchoolStandard $schoolStandard)
    {
        try {
            $schoolStandard->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'School standard deleted successfully.'
                ]);
            }
            
            return redirect()->route('school-standard.index')->with('success', 'School standard deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete school standard: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete school standard: ' . $e->getMessage());
        }
    }
}
