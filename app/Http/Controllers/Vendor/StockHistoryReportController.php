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
        // Check for modal type specifically using input() which covers both query and body params
        if ($request->input('type') === 'modal') {
            $variantId = $request->input('variant_id');
            $query = StockAdjustment::with(['creator'])
                ->where('variant_id', $variantId)
                ->latest();
            
            return response()->json([
                'success' => true,
                'data' => $query->get()->map(function($item) {
                    return [
                        'created_at' => $item->created_at->format('d M Y, h:i A'),
                        'old_stock' => $item->old_stock,
                        'added_quantity' => $item->added_quantity > 0 ? '+' . $item->added_quantity : $item->added_quantity,
                        'new_stock' => $item->new_stock,
                        'creator' => $item->creator,
                        'remarks' => $item->remarks ?? '-'
                    ];
                })
            ]);
        }

        if ($request->ajax()) {
            $query = StockAdjustment::with(['variant','variant.product'])
                ->whereHas('variant.product', function ($q) {
                    $q->where('vendor_id', auth()->user()->vendor->vendor_id);
                })
                ->select('stock_adjustments.*')
                ->latest();

            return DataTables::of($query)
                ->addIndexColumn()
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
                ->addColumn('old_stock', function ($row) {
                    return $row->old_stock;
                })
                ->addColumn('added_quantity', function ($row) {
                    return $row->added_quantity > 0 ? '+' . $row->added_quantity : $row->added_quantity;
                })
                ->addColumn('new_stock', function ($row) {
                    return $row->new_stock;
                })
                ->addColumn('remarks', function ($row) {
                    return $row->remarks ?? 'N/A';
                })
                ->editColumn('reason', function ($row) {
                    return 'Adjustment';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y, h:i A');
                })
                ->make(true);
        }

        return view('super-admin.stock_management.stock-history');
    }
}