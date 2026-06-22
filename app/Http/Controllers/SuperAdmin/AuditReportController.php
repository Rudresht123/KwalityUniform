<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class AuditReportController extends BaseController
{
    /**
     * Display the audit report.
     *
     * @param Request $request
     * @return View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activity::with('causer')->select('activity_log.*');

            return DataTables::of($activities)
                ->addIndexColumn()
                ->filterColumn('user', function($query, $keyword) {
                    $query->whereHasMorph('causer', [\App\Models\User::class], function($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%")
                          ->orWhere('email', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('user', function ($row) {
                    if ($row->causer) {
                        return '<div>
                                    <div class="fw-semibold">' . $row->causer->name . '</div>
                                    <div class="text-muted small">' . $row->causer->email . '</div>
                                </div>';
                    }
                    return '<span class="text-muted">System/Guest</span>';
                })
                ->addColumn('action', function ($row) {
                    $badgeClass = match ($row->description) {
                        'created' => 'success',
                        'updated' => 'info',
                        'deleted' => 'danger',
                        default => 'primary'
                    };
                    return '<span class="badge bg-' . $badgeClass . '-transparent">' . strtoupper($row->description) . '</span>';
                })
                ->addColumn('model', function ($row) {
                    return '<div class="fw-semibold">' . class_basename($row->subject_type) . '</div>
                            <div class="text-muted small">ID: ' . $row->subject_id . '</div>';
                })
                ->addColumn('details', function ($row) {
                    return '<span class="text-truncate d-inline-block" style="max-width: 200px;" title="' . $row->log_name . '">' . $row->log_name . ' - ' . $row->description . '</span>';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d M, Y h:i A');
                })
                ->addColumn('options', function ($row) {
                    return view('super-admin.audit-log.actions', compact('row'))->render();
                })
                ->rawColumns(['user', 'action', 'model', 'details', 'options'])
                ->make(true);
        }

        return view('super-admin.audit-log.index', $this->pageData('Audit Reports', 'Home|Settings|Audit Log'));
    }

    /**
     * Display the details of a specific activity.
     *
     * @param Activity $activity
     * @return View
     */
    public function show(Activity $activity): View
    {
        return view('super-admin.audit-log.show', compact('activity'), $this->pageData('Activity Details', 'Home|Settings|Audit Log|Details'));
    }
}
