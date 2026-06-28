<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\SchoolBoard;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolBoardController extends Controller
{
    /**
     * Display a listing of the school boards.
     */
    public function index(): View
    {
        $boards = SchoolBoard::latest()->paginate(10);
        return view('superadmin.schools.boards.index', compact('boards'));
    }

    /**
     * Show the form for creating a new school board.
     */
    public function create(): View
    {
        return view('superadmin.schools.boards.create');
    }

    /**
     * Store a newly created school board in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:school_boards,name',
            'description' => 'nullable|string',
        ]);

        SchoolBoard::create($validated);

        return redirect()->route('school-boards.index')
            ->with('success', 'School Board created successfully.');
    }

    /**
     * Display the specified school board.
     */
    public function show(SchoolBoard $schoolBoard): View
    {
        return view('superadmin.schools.boards.show', compact('schoolBoard'));
    }

    /**
     * Show the form for editing the specified school board.
     */
    public function edit(SchoolBoard $schoolBoard): View
    {
        return view('superadmin.schools.boards.edit', compact('schoolBoard'));
    }

    /**
     * Update the specified school board in storage.
     */
    public function update(Request $request, SchoolBoard $schoolBoard): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:school_boards,name,' . $schoolBoard->id,
            'description' => 'nullable|string',
        ]);

        $schoolBoard->update($validated);

        return redirect()->route('school-boards.index')
            ->with('success', 'School Board updated successfully.');
    }

    /**
     * Remove the specified school board from storage.
     */
    public function destroy(SchoolBoard $schoolBoard): RedirectResponse
    {
        $schoolBoard->delete();

        return redirect()->route('superadmin.school-boards.index')
            ->with('success', 'School Board deleted successfully.');
    }
}
