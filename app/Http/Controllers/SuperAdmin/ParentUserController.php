<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class ParentUserController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $parents = User::role('parent')->latest();

            return DataTables::of($parents)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('super-admin.parent-user.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('super-admin.parent-user.index', $this->pageData('Parent User Management', 'Home|User Management|Parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.parent-user.create', $this->pageData('Create Parent User', 'Home|User Management|Parents|Create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'username' => 'required|string|unique:users,username',
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:255',
            'alternate_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        try {
            $data = $request->all();
            $data['role'] = 'parent';

            $user = $this->userService->create($data);

            // Create associated parent profile
            \App\Models\SuperAdmin\Parent::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'alternate_phone' => $request->alternate_phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'national_id' => $request->national_id,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'emergency_contact_relationship' => $request->emergency_contact_relationship,
                'notes' => $request->notes,
            ]);

            return redirect()->route('parent-user.index')->with('success', 'Parent user created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create parent user: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $parent = \App\Models\SuperAdmin\Parent::where('user_id', $user->id)->first();
        return view('super-admin.parent-user.edit', compact('user', 'parent'), $this->pageData('Edit Parent User', 'Home|User Management|Parents|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:255',
            'alternate_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        try {
            $this->userService->update($user, $request->all());

            // Update associated parent profile
            $parent = \App\Models\SuperAdmin\Parent::where('user_id', $user->id)->first();
            if ($parent) {
                $parent->update([
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'alternate_phone' => $request->alternate_phone,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'national_id' => $request->national_id,
                    'emergency_contact_name' => $request->emergency_contact_name,
                    'emergency_contact_phone' => $request->emergency_contact_phone,
                    'emergency_contact_relationship' => $request->emergency_contact_relationship,
                    'notes' => $request->notes,
                ]);
            }

            return redirect()->route('parent-user.index')->with('success', 'Parent user updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update parent user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('parent-user.index')->with('success', 'Parent user deleted successfully.');
        } catch (Throwable $e) {
            return back()->with('error', 'Failed to delete parent user: ' . $e->getMessage());
        }
    }
}
