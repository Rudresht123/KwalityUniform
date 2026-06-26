<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserStatusReportController extends BaseController

{
    public function index(Request $request)
    {
        $this->authorize('viewAny', \App\Policies\UserPolicy::class);

        if ($request->ajax()) {
            $query = User::query()->with(['vendor', 'school']);

            // Filter by status
            if ($request->filled('status')) {
                $status = $request->status;
                if ($status === 'inactive') {
                    $query->where('is_active', false);
                } elseif ($status === 'active') {
                    $query->where('is_active', true);
                }
            }

            // Filter by Type (Vendor/School/Admin)
            if ($request->filled('type')) {
                $type = $request->type;
                if ($type === 'vendor') {
                    $query->whereHas('vendor');
                } elseif ($type === 'school') {
                    $query->whereHas('school');
                } elseif ($type === 'admin') {
                    $query->whereDoesntHave('vendor')->whereDoesntHave('school');
                }
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('user_type', function ($user) {
                    if ($user->vendor) return 'Vendor';
                    if ($user->school) return 'School';
                    return 'Admin';
                })
                ->addColumn('entity_name', function ($user) {
                    if ($user->vendor) return $user->vendor->business_name;
                    if ($user->school) return $user->school->school_name;
                    return 'System Admin';
                })
                ->addColumn('status_badge', function ($user) {
                    return $user->is_active 
                        ? '<span class="badge bg-success">Active</span>' 
                        : '<span class="badge bg-danger">Inactive/Suspended</span>';
                })
                ->addColumn('actions', function ($user) {
                    return '
                        <button class="btn btn-sm btn-primary btn-toggle-status" data-id="'.$user->id.'">Toggle Status</button>
                    ';
                })

                ->rawColumns(['status_badge', 'actions'])
                ->make(true);
        }

        return view('super-admin.user_status_report.index', $this->pageData('User Status Report', 'Home|Reports|User Status'));
    }

    public function toggleStatus(Request $request)
    {
        $this->authorize('update', \App\Policies\UserPolicy::class);
        
        $user = User::findOrFail($request->user_id);
        $newStatus = !$user->is_active;
        
        DB::transaction(function () use ($user, $newStatus) {
            // 1. Update User status
            $user->is_active = $newStatus;
            $user->save();

            // 2. Update Vendor status if applicable
            if ($user->vendor) {
                $vendor = $user->vendor;
                $vendor->is_active = $newStatus ? '1' : '0';
                
                // Update the descriptive 'status' column for Vendors
                // If active, set to 'approved'. If inactive, set to 'suspended'.
                $vendor->status = $newStatus ? 'approved' : 'suspended';
                
                $vendor->save();
            }

            // 3. Update School status if applicable
            if ($user->school) {
                $school = $user->school;
                $school->is_active = $newStatus;
                $school->save();
            }
        });

        return response()->json([
            'success' => true, 
            'message' => 'User and associated entity status updated to ' . ($newStatus ? 'Active' : 'Inactive'),
            'status' => $newStatus
        ]);
    }

}
