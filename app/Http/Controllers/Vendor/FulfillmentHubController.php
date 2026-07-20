<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Models\Shipment;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Auth;

class FulfillmentHubController extends BaseController
{
    public function index()
    {
        $vendorId = Auth::user()->vendor->vendor_id;

        // Optimized Eager Loading
        $orders = Order::where('vendor_id', $vendorId)
            ->with(['items.product', 'shipments.courier', 'shippingAddress'])
            ->get();

        // Grouping into pipeline stages
        $pipeline = [
            'ready' => $orders->whereIn('status', [OrderStatus::PACKED, OrderStatus::PENDING]),
            'shipment_created' => Shipment::where('vendor_id', $vendorId)->where('status', 'shipment_created')->get(),
            'transit' => Shipment::where('vendor_id', $vendorId)->where('status', 'in_transit')->get(),
            'delivered' => Shipment::where('vendor_id', $vendorId)->where('status', 'delivered')->get(),
        ];

        return view('vendor.fulfillment.hub', compact('pipeline'), $this->pageData('Fulfillment Hub', 'Fulfillment|Hub'));
    }

    public function showShipment(Shipment $shipment)
    {
        $shipment->load(['items.orderItem.product', 'courier', 'auditLogs.user']);
        return view('vendor.fulfillment.partials.shipment-details', compact('shipment'));
    }
}
