<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\ProductVariant;
use App\Services\StockAdjustmentService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class StockController extends BaseController
{
    protected $stockService;

    public function __construct(StockAdjustmentService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Display the low stock listing.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', \App\Policies\StockPolicy::class);

        if ($request->ajax()) {
            $variants = ProductVariant::with(['product', 'size', 'color'])
                ->whereColumn('stock_qty', '<=', 'low_stock_alert')
                ->latest();

            return DataTables::of($variants)
                ->addIndexColumn()
                ->addColumn('product_name', function ($row) {
                    return $row->product->product_name ?? 'N/A';
                })
                ->addColumn('variant_details', function ($row) {
                    $size = $row->size->size_name ?? 'N/A';
                    $color = $row->color->color_name ?? 'N/A';
                    return "Size: {$size}, Color: {$color}";
                })
                ->addColumn('status', function ($row) {
                    if ($row->stock_qty == 0) {
                        return '<span class="badge bg-danger">Out Of Stock</span>';
                    }
                    if ($row->stock_qty <= $row->low_stock_alert) {
                        return '<span class="badge bg-warning">Low Stock</span>';
                    }
                    return '<span class="badge bg-success">Healthy</span>';
                })
                ->addColumn('options', function ($row) {
                    return '<button type="button" class="btn btn-icon btn-sm btn-primary-light btn-add-stock" data-id="' . $row->variant_id . '" title="Add Stock"><i class="ti-plus"></i> Add Stock</button>';
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('super-admin.stock.index', $this->pageData('Low Stock Management', 'Home|Inventory|Low Stock'));
    }

    /**
     * Store a stock adjustment.
     */
    public function adjust(Request $request)
    {
        $this->authorize('adjust', \App\Policies\StockPolicy::class);

        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:500',
        ]);

        try {
            $this->stockService->adjustStock(
                $request->variant_id,
                (int)$request->quantity,
                $request->remarks
            );

            return response()->json(['success' => true, 'message' => 'Stock updated successfully.']);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update stock: ' . $e->getMessage()], 500);
        }
    }
}
