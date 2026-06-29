<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\BaseController;
use App\Models\WebUser;
use Illuminate\Http\Request;

class WebUserController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = WebUser::with('user');
            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('user_name', function ($webUser) {
                    return $webUser->user->name ?? 'N/A';
                })
                ->addColumn('user_email', function ($webUser) {
                    return $webUser->user->email ?? 'N/A';
                })
                ->addColumn('user_phone', function ($webUser) {
                    return $webUser->user->phone ?? 'N/A';
                })
                ->addColumn('status_badge', function ($webUser) {
                    return $webUser->user->is_active 
                        ? '<span class="badge bg-success">Active</span>' 
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('actions', function ($webUser) {
                    return '
                        <form action="'.route('parents.toggleStatus', $webUser->id).'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field('PATCH').'
                            <button type="submit" class="btn btn-sm btn-light btn-toggle-status">
                                '.($webUser->user->is_active ? 'Deactivate' : 'Activate').'
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['status_badge', 'actions'])
                ->make(true);
        }

        return view('dashboard.parents.index', $this->pageData('Parent Management', 'Home|User Management|Parents'));
    }

    public function toggleStatus($id)
    {
        $webUser = WebUser::findOrFail($id);
        $user = $webUser->user;
        
        $user->update([
            'is_active' => !$user->is_active
        ]);

        return redirect()->route('parents.index')->with('success', 'User status updated successfully.');
    }
}
