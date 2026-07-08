<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use Illuminate\Http\Request;

class ProductPreviewController extends BaseController
{
    public function show(Request $request, $id)
    {
        try {
            $this->authorize('view', \App\Policies\ProductPolicy::class, Product::findOrFail($id));
            
            $product = Product::with(['variants.size', 'variants.color', 'images', 'category', 'vendor'])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
