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

        if ($request->ajax()) {

            $query = ProductVariant::with(['product', 'size', 'color'])
                ->whereColumn('stock_qty', '<=', 'low_stock_alert');

            // Filter by vendor if the user is a vendor
            if (auth()->user()->hasRole('vendor')) {
                $vendorId = auth()->user()->vendor?->vendor_id;
                $query->whereHas('product', function ($q) use ($vendorId) {
                    $q->where('vendor_id', $vendorId);
                });
            }

            $variants = $query->latest();

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
                    return '<button type="button" class="btn btn-icon btn-sm btn-primary btn-add-stock" data-id="' . $row->variant_id . '" title="Add Stock"><i class="ti-plus"></i></button>';
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
        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:500',
        ]);

        try {
            $variant = $this->stockService->adjustStock(
                $request->variant_id,
                (int)$request->quantity,
                $request->remarks
            );

            $productName = $variant->product->product_name ?? 'Product';
            $action = $request->quantity > 0 ? 'added' : 'removed';
            
            return response()->json([
                'success' => true, 
                'message' => "Successfully {$action} {$request->quantity} units to {$productName}. New stock level: {$variant->stock_qty}."
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update stock: ' . $e->getMessage()], 500);
        }
    }
}
