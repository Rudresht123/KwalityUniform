<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class StockManagementController extends BaseController
{
    protected $stockRepo;

    public function __construct(StockRepository $stockRepo)
    {
        $this->stockRepo = $stockRepo;
    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $query = $this->stockRepo->getVariantsQuery()
                ->join('products', 'product_variants.product_id', '=', 'products.product_id')
                ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')
                ->select('product_variants.*');

            // Filter by vendor if the user is a vendor
            if (auth()->user()->hasRole('vendor')) {
                $vendorId = auth()->user()->vendor?->vendor_id;
                $query->where('products.vendor_id', $vendorId);
            }

            $variants = $query;

            return DataTables::of($variants)
                ->addIndexColumn()
                ->addColumn('product_name', function ($row) {
                    return $row->product->product_name ?? 'N/A';
                })
                ->addColumn('product_image', function ($row) {
                    return '<img src="' . ($row->product->firstImage() ?? asset('assets/images/no_image.jpg')) . '" class="img-fluid rounded" width="40">';
                })
                ->addColumn('sku', function ($row) {
                    return $row->sku;
                })
                ->addColumn('vendor', function ($row) {
                    return $row->product->vendor->business_name ?? 'N/A';
                })
                ->addColumn('category', function ($row) {
                    return $row->product->category->category_name ?? 'N/A';
                })
                ->addColumn('stock_info', function ($row) {
                    return "Available: {$row->stock_qty} | Low Alert: {$row->low_stock_alert}";
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
                    return '
        <button class="btn btn-icon btn-sm btn-primary-light"
            onclick="viewStockHistory(\'' .
                        $row->variant_id .
                        '\')"
            title="History">
            <i class="ti-eye"></i>
        </button>

        <button class="btn btn-icon btn-sm btn-success-light"
            onclick="adjustStock(\'' .
                        $row->variant_id .
                        '\')"
            title="Adjust">
            <i class="ti-plus"></i>
        </button>
    ';
                })
                ->orderColumn('vendor', function ($query, $order) {
                    $query->orderBy('vendors.business_name', $order);
                })
                ->orderColumn('category', function ($query, $order) {
                    $query->orderBy('categories.category_name', $order); // Note: This requires joining categories table too
                })
                ->rawColumns(['product_image', 'status', 'options'])
                ->make(true);
        }

        return view('super-admin.stock_management.index', $this->pageData('Stock Management', 'Home|Inventory|Stock Management'));
    }
}
