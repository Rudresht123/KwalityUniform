<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreSchoolClassRequest;
use App\Http\Requests\SuperAdmin\UpdateSchoolClassRequest;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class SchoolClassController extends BaseController
{
    /**
     * @var string
     */
    protected string $title = 'School Class Management';

    /**
     * Display a listing of the school classes.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        $query = School::active()->withCount('classes');

        if (!$user->hasRole(['super-admin', 'admin'])) {
            $query->where('user_id', $user->id);
        }

        $schools = $query->latest()->get();

        return view('super-admin.school-class.index', compact('schools'), $this->pageData($this->title, 'Home|School Classes'));
    }

    /**
     * Show the form for creating a new school class.
     */
    public function create(): View
    {
        $user = auth()->user();
        $query = School::active();

        if (!$user->hasRole(['super-admin', 'admin'])) {
            $query->where('user_id', $user->id);
        }

        $schools = $query->get();
        return view('super-admin.school-class.create', compact('schools'), $this->pageData('Create School Class', 'Home|School Classes|Create'));
    }

    /**
     * Store a newly created school class in storage.
     */
    public function store(StoreSchoolClassRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $schoolId = $data['school_id'];
            $isActive = $data['is_active'] ?? true;

            foreach ($data['class_names'] as $className) {
                SchoolClass::create([
                    'school_id' => $schoolId,
                    'class_name' => $className,
                    'is_active' => $isActive,
                ]);
            }

            return redirect()->route('school-class.index')->with('success', count($data['class_names']) . ' school classes created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create school classes: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for managing all classes for a specific school.
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

        $classes = $school->classes()->get();

        return view('super-admin.school-class.edit', compact('school', 'classes'), $this->pageData('Manage School Classes', 'Home|School Classes|Manage'));
    }

    /**
     * Update the classes for a specific school.
     */
    public function update(Request $request, School $school): RedirectResponse
    {
        $request->validate([
            'class_names' => 'required|array|min:1',
            'class_names.*' => 'required|string|max:255',
        ]);

        try {
            // Trim and unique the names to avoid whitespace/duplicate issues
            $newClassNames = array_unique(array_map('trim', $request->class_names));

            // 1. Delete classes that are currently active but NOT in the new list
            $school->classes()->whereNotIn('class_name', $newClassNames)->delete();

            // 2. Sync the new list: Restore soft-deleted ones or create new ones
            foreach ($newClassNames as $name) {
                SchoolClass::withTrashed()->updateOrCreate(
                    [
                        'school_id' => $school->school_id, 
                        'class_name' => $name
                    ],
                    [
                        'deleted_at' => null, 
                        'is_active' => true
                    ]
                );
            }

            return redirect()->route('school-class.index')->with('success', 'School classes updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update school classes: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified school class from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        try {
            $schoolClass->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'School class deleted successfully.'
                ]);
            }
            
            return redirect()->route('school-class.index')->with('success', 'School class deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete school class: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete school class: ' . $e->getMessage());
        }
    }
}
