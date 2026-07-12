<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Services\FulfillmentService;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDispatchController extends Controller
{
    public function __construct(protected FulfillmentService $fulfillmentService) {}

    /**
     * List all items from confirmed orders that this vendor needs to ship.
     */
    public function index(Request $request)
    {
        $vendorId = Auth::user()->vendor->vendor_id;

        $pendingItems = OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', function($q) {
                $q->where('status', 'confirmed'); // Only confirmed orders are ready for dispatch
            })
            ->whereDoesntHave('shipmentItem') // Only items not yet shipped
            ->with(['order', 'product'])
            ->get();

        return view('vendor.orders.dispatch', compact('pendingItems'), $this->pageData('Ready to Dispatch', 'Home|Orders|Dispatch'));
    }

    /**
     * Create a shipment for the selected items.
     */
    public function ship(Request $request)
    {
        $request->validate([
            'order_item_ids' => 'required|array',
            'order_item_ids.*' => 'exists:order_items,id',
            'courier_id' => 'required|exists:couriers,id',
            'tracking_number' => 'required|string|max:255',
        ]);

        try {
            $vendorId = Auth::user()->vendor->vendor_id;
            $shipment = $this->fulfillmentService->createVendorShipment(
                $vendorId,
                $request->order_item_ids,
                $request->courier_id,
                $request->tracking_number
            );

            return redirect()->route('vendor.orders.dispatch')->with('success', 'Shipment created successfully. Tracking: ' . $shipment->tracking_number);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
