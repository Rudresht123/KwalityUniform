<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
use Illuminate\Support\Facades\DB;

class ParentReportController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $parents = User::role('parent')
                ->select('users.*')
                ->withCount('orders') // Assuming an Order model exists
                ->latest();

            return DataTables::of($parents)
                ->addIndexColumn()
                ->addColumn('registration_date', function ($row) {
                    return $row->created_at->format('d M Y');
                })
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

        $stats = [
            'total_parents' => User::role('parent')->count(),
            'active_parents' => User::role('parent')->where('is_active', true)->count(),
            'new_this_month' => User::role('parent')->whereMonth('created_at', now()->month)->count(),
        ];

        return view('super-admin.parent-user.report', compact('stats'), $this->pageData('Parent User Report', 'Home|Reports|Parent Users'));
    }
}
