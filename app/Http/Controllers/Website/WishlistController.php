<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishlistController extends Controller
{
    /**
     * Get the total count of wishlist items.
     */
    public function count()
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['count' => 0]);
        }
        
        $count = WishlistItem::where('user_id', $userId)->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Toggle a product's presence in the wishlist.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Please login to manage your wishlist.'], 401);
        }

        $item = WishlistItem::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->delete();
            return response()->json([
                'success' => true, 
                'action' => 'removed', 
                'message' => 'Removed from wishlist.'
            ]);
        }

        WishlistItem::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'success' => true, 
            'action' => 'added', 
            'message' => 'Added to wishlist successfully!'
        ]);
    }

    /**
     * Display the user's wishlist.
     */
    public function index(): View
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login');
        }
        
        $wishlistItems = WishlistItem::where('user_id', $userId)
            ->with(['product', 'variant'])
            ->paginate(12);

        return view('website.pages.wishlist', compact('wishlistItems'));
    }

    /**
     * Add a product to the wishlist.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'variant_id' => 'nullable',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Please login to add items to wishlist.'], 401);
        }

        $exists = WishlistItem::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Item already in wishlist.']);
        }

        WishlistItem::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Added to wishlist successfully!']);
    }

    /**
     * Remove a product from the wishlist.
     */
    public function destroy($id)
    {
        $item = WishlistItem::findOrFail($id);
        
        if ($item->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $item->delete();

        return response()->json(['success' => true, 'message' => 'Removed from wishlist.']);
    }
}
