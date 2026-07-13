<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Services\FulfillmentService;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Shipment;
use App\Enums\ShipmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDispatchController extends BaseController
{
    public function __construct(protected FulfillmentService $fulfillmentService) {}

    /**
     * List all items from confirmed orders that this vendor needs to ship.
     */
    public function index(Request $request)
    {
        $vendorId = Auth::user()->vendor->vendor_id;

        // 1. Ready to Dispatch: Confirmed orders not yet shipped
        $pendingItems = OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', function($q) {
                $q->where('status', 'confirmed');
            })
            ->whereDoesntHave('shipmentItem')
            ->with(['order', 'product'])
            ->get();

        // 2. In Transit: Shipments with status SHIPPED or IN_TRANSIT
        $inTransitShipments = Shipment::where('vendor_id', $vendorId)
            ->whereIn('status', [ShipmentStatus::SHIPPED, ShipmentStatus::IN_TRANSIT])
            ->with(['courier', 'items.orderItem.product', 'items.orderItem.order'])
            ->get();

        // 3. Delivered: Shipments with status DELIVERED or COMPLETED
        $deliveredShipments = Shipment::where('vendor_id', $vendorId)
            ->whereIn('status', [ShipmentStatus::DELIVERED, ShipmentStatus::COMPLETED])
            ->with(['courier', 'items.orderItem.product', 'items.orderItem.order'])
            ->get();

        // KPIs
        $stats = [
            'pending_count' => $pendingItems->count(),
            'transit_count' => $inTransitShipments->count(),
            'delivered_count' => $deliveredShipments->count(),
            'total_items' => $pendingItems->sum('quantity'),
        ];

        return view('vendor.orders.dispatch', compact('pendingItems', 'inTransitShipments', 'deliveredShipments', 'stats'), $this->pageData('Fulfillment Hub', 'Home|Orders|Dispatch'));
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
