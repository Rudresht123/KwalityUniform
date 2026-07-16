<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\StockAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StockHistoryReportController extends Controller
{
    /**
     * Display the stock history report for the authenticated vendor.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Assuming 'vendor_id' is a column in your 'stock_adjustments' table.
            $query = StockAdjustment::with('product')
                ->where('vendor_id', Auth::id())
                ->select('stock_adjustments.*')
                ->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('product_name', function ($row) {
                    return $row->product ? $row->product->name : 'N/A';
                })
                ->editColumn('quantity_change', function ($row) {
                    if ($row->quantity_change > 0) {
                        return '<span class="badge bg-success-transparent">+' . $row->quantity_change . '</span>';
                    }
                    return '<span class="badge bg-danger-transparent">' . $row->quantity_change . '</span>';
                })
                ->editColumn('reason', function ($row) {
                    return ucwords(str_replace('_', ' ', $row->reason));
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y, h:i A');
                })
                ->rawColumns(['quantity_change'])
                ->make(true);
        }

        return view('vendor.reports.stock-history');
    }
}