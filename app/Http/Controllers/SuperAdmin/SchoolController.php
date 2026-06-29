<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreSchoolRequest;
use App\Http\Requests\SuperAdmin\UpdateSchoolRequest;
use App\Models\SuperAdmin\School;
use App\Services\SchoolService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class SchoolController extends BaseController
{
    /**
     * @var SchoolService
     */
    protected SchoolService $schoolService;

    /**
     * @var string
     */
    protected string $title = 'School Management';

    /**
     * SchoolController constructor.
     *
     * @param SchoolService $schoolService
     */
    public function __construct(SchoolService $schoolService)
    {
        $this->schoolService = $schoolService;
    }

    /**
     * Display a listing of schools.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $schools = $this->schoolService->getAllSchools();
        return view('super-admin.school.index', compact('schools'), $this->pageData($this->title, 'Home|Schools'));
    }

    /**
     * Show the form for creating a new school.
     *
     * @return View
     */
    public function create(): View
    {
        $boards = \App\Models\SuperAdmin\SchoolBoard::all();
        return view('super-admin.school.create', array_merge($this->pageData('Create School', 'Home|Schools|Create'), ['boards' => $boards]));
    }

    /**
     * Store a newly created school in storage.
     *
     * @param StoreSchoolRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSchoolRequest $request): RedirectResponse
    {
        try {
            $this->schoolService->createSchool($request->validated(), $request->file('logo'));

            return redirect()->route('school.index')->with('success', 'School created successfully.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create school: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified school.
     *
     * @param School $school
     * @return View
     */
    public function show(School $school): View
    {
        return view('super-admin.school.show', compact('school'), $this->pageData('School Details', 'Home|Schools|View'));
    }

    /**
     * Show the form for editing the specified school.
     *
     * @param School $school
     * @return View
     */
    public function edit(School $school): View
    {
        $boards = \App\Models\SuperAdmin\SchoolBoard::all();
        return view('super-admin.school.edit', array_merge(compact('school'), $this->pageData('Edit School', 'Home|Schools|Edit'), ['boards' => $boards]));
    }

    /**
     * Update the specified school in storage.
     *
     * @param UpdateSchoolRequest $request
     * @param School $school
     * @return RedirectResponse
     */
    public function update(UpdateSchoolRequest $request, School $school): RedirectResponse
    {
        try {
            $this->schoolService->updateSchool($school->school_id, $request->validated(), $request->file('logo'));

            return redirect()->route('school.index')->with('success', 'School updated successfully.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update school: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified school from storage.
     *
     * @param School $school
     * @return RedirectResponse
     */
    public function destroy(School $school): RedirectResponse
    {
        return redirect()->route('school.index')->with('error', 'Delete functionality is handled globally.');
    }
}
