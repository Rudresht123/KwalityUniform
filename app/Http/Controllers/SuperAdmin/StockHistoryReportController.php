<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\StockAdjustment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockHistoryReportController extends BaseController
{
    public function index()
    {
        return view('super-admin.stock.history-report', $this->pageData('Stock History Report', 'Home|Inventory|Stock History'));
    }

    public function data(Request $request)
    {
        $query = StockAdjustment::with(['variant.product', 'variant.size', 'variant.color', 'creator']);

        // Vendor filter
        if (auth()->user()->hasRole('vendor')) {
            $vendorId = auth()->user()->vendor?->vendor_id;
            
            $query->whereHas('variant', function ($q) use ($vendorId) {
                $q->whereHas('product', function ($pq) use ($vendorId) {
                    $pq->where('vendor_id', $vendorId);
                });
            });
        }

        if ($request->filled('variant_id')) {
            $query->where('variant_id', $request->variant_id);
        }

        return DataTables::of($query)
            ->addColumn('product_name', function ($row) {
                return $row->variant->product->product_name ?? 'N/A';
            })
            ->addColumn('sku', function ($row) {
                return $row->variant->sku ?? 'N/A';
            })
            ->addColumn('size', function ($row) {
                return $row->variant->size->size_name ?? 'N/A';
            })
            ->addColumn('color', function ($row) {
                return $row->variant->color->color_name ?? 'N/A';
            })
            ->addColumn('user_name', function ($row) {
                return $row->creator->name ?? 'N/A';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['product_name', 'sku', 'size', 'color', 'user_name', 'created_at'])
            ->make(true);
    }
}
