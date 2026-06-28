<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Services\StockAdjustmentService;
use App\Http\Requests\SuperAdmin\AdjustStockRequest;
use Illuminate\Http\Request;
use Throwable;

class StockAdjustmentController extends BaseController
{
    protected $stockService;

    public function __construct(StockAdjustmentService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function adjust(AdjustStockRequest $request)
    {
        \Illuminate\Support\Facades\Gate::authorize('adjustStock');

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

    public function history(Request $request)
    {
        $this->authorize('viewHistory', \App\Policies\StockPolicy::class);
        
        $variantId = $request->query('variant_id');
        if (!$variantId) {
            return response()->json(['success' => false, 'message' => 'Variant ID is required.'], 400);
        }

        $history = \App\Models\SuperAdmin\StockAdjustment::where('variant_id', $variantId)
            ->with('creator')
            ->latest()
            ->get();

        return response()->json(['success' => true, 'data' => $history]);
    }
}
