<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Throwable;

class ParentUserController extends BaseController
{
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
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'is_active' => true,
            ]);

            $user->assignRole('parent');

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
        return view('super-admin.parent-user.edit', compact('user'), $this->pageData('Edit Parent User', 'Home|User Management|Parents|Edit'));
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
        ]);

        try {
            $data = $request->only(['name', 'email', 'username']);
            
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

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
