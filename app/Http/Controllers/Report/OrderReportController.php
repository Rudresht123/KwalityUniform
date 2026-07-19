<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class OrderReportController extends BaseController
{
    public function index()
    {
        if (Gate::denies('report.recent_orders.view')) {
            abort(403);
        }

        return view('reports.recent-orders', $this->pageData('Recent Orders', 'Reports|Recent Orders'));
    }
public function data(Request $request)
{
    abort_if(Gate::denies('report.recent_orders.view'), 403);

    $query = Order::with(['user', 'vendor']);

    // Vendor Scope
    if (auth()->user()->hasRole('vendor')) {
        $query->where('vendor_id', auth()->user()->vendor->vendor_id);
    }

    // Filters
    $query->when($request->filled('order_no'), function ($q) use ($request) {
        $q->where('order_number', 'like', '%' . $request->order_no . '%');
    });

    $query->when($request->filled('status'), function ($q) use ($request) {
    $q->where('status', $request->status);
});

    return DataTables::of($query)
        ->addColumn('customer', fn($order) => $order->user?->name ?? 'N/A')

        ->editColumn('grand_total', fn($order) => '₹' . number_format($order->grand_total, 2))

      ->editColumn('status', function ($order) {

    $class = match ($order->status->value ?? $order->status) {
        'pending'    => 'warning',
        'confirmed'  => 'primary',
        'processing' => 'info',
        'packed'     => 'secondary',
        'shipped'    => 'dark',
        'delivered'  => 'success',
        'cancelled'  => 'danger',
        default      => 'light',
    };

    $status = ucfirst($order->status->value ?? $order->status);

    return "<span class='badge bg-{$class}'>{$status}</span>";
})

->rawColumns(['status'])

        ->editColumn('created_at', fn($order) => $order->created_at->format('d M Y, h:i A'))

        ->rawColumns(['status'])

        ->make(true);
}
}
