<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Product;
use Illuminate\Http\Request;

class ProductPreviewController extends BaseController
{
    public function show(Request $request, $id)
    {
        $this->authorize('view', \App\Policies\ProductPolicy::class, Product::findOrFail($id));
        
        $product = Product::with(['variants', 'images', 'category', 'vendor'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
}
