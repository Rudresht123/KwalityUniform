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

    // Ready to Dispatch
    $pendingItems = OrderItem::query()
        ->whereHas('order', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId)
                  ->where('status', 'confirmed');
        })
        ->whereDoesntHave('shipmentItem')
        ->with([
            'order',
            'product',
        ])
        ->get();


    // Base Shipment Query
    $shipmentQuery = Shipment::query()
        ->where('vendor_id', $vendorId)
        ->with([
            'courier',
            'items.orderItem.product',
            'items.orderItem.order',
        ]);

    // In Transit Shipments
    $inTransitShipments = (clone $shipmentQuery)
        ->whereIn('status', [
            ShipmentStatus::SHIPPED,
            ShipmentStatus::IN_TRANSIT,
        ])
        ->get();

    // Delivered Shipments
    $deliveredShipments = (clone $shipmentQuery)
        ->whereIn('status', [
            ShipmentStatus::DELIVERED,
            ShipmentStatus::COMPLETED,
        ])
        ->get();

    // Dashboard Statistics
    $stats = [
        'pending_count'   => $pendingItems->count(),
        'transit_count'   => $inTransitShipments->count(),
        'delivered_count' => $deliveredShipments->count(),
        'total_items'     => $pendingItems->sum('quantity'),
    ];

    return view(
        'vendor.orders.dispatch',
        compact(
            'pendingItems',
            'inTransitShipments',
            'deliveredShipments',
            'stats'
        ),
        $this->pageData(
            'Fulfillment Hub',
            'Home|Orders|Dispatch'
        )
    );
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
