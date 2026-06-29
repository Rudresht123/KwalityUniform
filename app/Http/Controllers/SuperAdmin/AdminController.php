<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreAdminRequest;
use App\Http\Requests\SuperAdmin\UpdateAdminRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class AdminController extends BaseController
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
            $admins = User::role('admin')->latest();

            return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('super-admin.admin.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('super-admin.admin.index', $this->pageData('Admin Management', 'Home|Access Control|Admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.admin.create', $this->pageData('Create Admin', 'Home|Access Control|Admins|Create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        try {
            $data = $request->validated();
            $data['role'] = 'admin';
            
            $this->userService->create($data);

            return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create admin: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        return view('super-admin.admin.show', compact('admin'), $this->pageData('Admin Details', 'Home|Access Control|Admins|View'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('super-admin.admin.edit', compact('admin'), $this->pageData('Edit Admin', 'Home|Access Control|Admins|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        try {
            $this->userService->update($admin, $request->validated());

            return redirect()->route('admin.index')->with('success', 'Admin updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update admin: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        try {
            $admin->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Admin deleted successfully.'
                ], 200);
            }
            
            return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete admin: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete admin: ' . $e->getMessage());
        }
    }
}
