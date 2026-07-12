<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ShipmentRepository;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\SchoolDistribution;
use App\Models\StudentDistribution;
use App\Enums\ShipmentStatus;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FulfillmentService
{
    public function __construct(
        protected OrderRepository $orderRepository,
        protected ShipmentRepository $shipmentRepository
    ) {}

    /**
     * Create a vendor-specific shipment for a set of items.
     */
    public function createVendorShipment(string $vendorId, array $orderItemIds, string $courierId, string $trackingNumber): Shipment
    {
        return DB::transaction(function () use ($vendorId, $orderItemIds, $courierId, $trackingNumber) {
            // Verify all items belong to the same vendor
            $items = \App\Models\OrderItem::whereIn('id', $orderItemIds)->get();
            foreach ($items as $item) {
                if ($item->vendor_id !== $vendorId) {
                    throw new \Exception("Item {$item->id} does not belong to the specified vendor.");
                }
            }

            // Determine destination based on the first item's order
            $firstOrder = $items->first()->order;
            $destinationId = $firstOrder->shipping_address_id ?? $firstOrder->school_id;

            $shipment = $this->shipmentRepository->create([
                'vendor_id' => $vendorId,
                'tracking_number' => $trackingNumber,
                'courier_id' => $courierId,
                'shipment_type' => 'individual',
                'destination_address_id' => $destinationId,
                'status' => ShipmentStatus::PACKED,
            ]);

            foreach ($items as $item) {
                ShipmentItem::create([
                    'shipment_id' => $shipment->id,
                    'order_item_id' => $item->id,
                    'quantity_shipped' => $item->quantity,
                ]);
            }

            // Update order status if all items for this order across all vendors are now shipped
            $this->updateOrderFulfillmentStatus($firstOrder->id);

            return $shipment;
        });
    }

    /**
     * Check if all items of an order have been shipped to update order status.
     */
    protected function updateOrderFulfillmentStatus(string $orderId): void
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $totalItems = $order->items()->count();
        $shippedItems = \App\Models\ShipmentItem::whereHas('orderItem', function($q) use ($orderId) {
            $q->where('order_id', $orderId);
        })->count();

        if ($shippedItems >= $totalItems) {
            $this->orderRepository->updateStatus($order->id, OrderStatus::PACKED);
        }
    }

    /**
     * Create a bulk shipment for a specific school.
     */
    public function createBulkShipment(string $schoolId, string $courierId): Shipment
    {
        $orders = $this->orderRepository->getConfirmedOrdersBySchool($schoolId);

        if ($orders->isEmpty()) {
            throw new \Exception("No confirmed orders available for this school.");
        }

        return DB::transaction(function () use ($orders, $schoolId, $courierId) {
            $shipment = $this->shipmentRepository->create([
                'tracking_number' => 'BLK-' . strtoupper(Str::random(10)),
                'courier_id' => $courierId,
                'shipment_type' => 'bulk',
                'destination_address_id' => $schoolId, // Simplified for this example
                'status' => ShipmentStatus::PACKED,
            ]);

            foreach ($orders as $order) {
                foreach ($order->items as $item) {
                    ShipmentItem::create([
                        'shipment_id' => $shipment->id,
                        'order_item_id' => $item->id,
                        'quantity_shipped' => $item->quantity,
                    ]);
                }
                $this->orderRepository->updateStatus($order->id, OrderStatus::PACKED);
            }

            return $shipment;
        });
    }

    /**
     * Create an individual shipment for a home delivery order.
     */
    public function createHomeShipment(string $orderId, string $courierId): Shipment
    {
        $order = \App\Models\Order::with('items')->findOrFail($orderId);

        return DB::transaction(function () use ($order, $courierId) {
            $shipment = $this->shipmentRepository->create([
                'tracking_number' => 'HOM-' . strtoupper(Str::random(10)),
                'courier_id' => $courierId,
                'shipment_type' => 'individual',
                'destination_address_id' => $order->shipping_address_id,
                'status' => ShipmentStatus::PACKED,
            ]);

            foreach ($order->items as $item) {
                ShipmentItem::create([
                    'shipment_id' => $shipment->id,
                    'order_item_id' => $item->id,
                    'quantity_shipped' => $item->quantity,
                ]);
            }

            $this->orderRepository->updateStatus($order->id, OrderStatus::PACKED);

            return $shipment;
        });
    }

    /**
     * Mark a bulk shipment as received by the school.
     */
    public function markSchoolReceived(string $shipmentId, string $userId): SchoolDistribution
    {
        $shipment = Shipment::findOrFail($shipmentId);
        
        return DB::transaction(function () use ($shipment, $userId) {
            $distribution = SchoolDistribution::create([
                'shipment_id' => $shipment->id,
                'school_id' => $shipment->destination_address_id, // Using this as school_id for simplicity
                'received_at' => now(),
                'received_by' => $userId,
                'status' => 'received',
            ]);

            $this->shipmentRepository->updateStatus($shipment->id, ShipmentStatus::DISTRIBUTING);
            
            // Update all linked orders to 'delivered' (to school)
            $orderIds = ShipmentItem::where('shipment_id', $shipment->id)
                ->join('order_items', 'shipment_items.order_item_id', '=', 'order_items.id')
                ->pluck('order_items.order_id');

            \App\Models\Order::whereIn('id', $orderIds)->update(['status' => OrderStatus::DELIVERED]);

            return $distribution;
        });
    }

    /**
     * Mark an item as delivered to the student.
     */
    public function markStudentPickup(string $orderItemId, string $staffId): StudentDistribution
    {
        return DB::transaction(function () use ($orderItemId, $staffId) {
            $distribution = StudentDistribution::create([
                'order_item_id' => $orderItemId,
                'status' => 'delivered',
                'delivered_at' => now(),
                'collected_by' => $staffId,
            ]);

            // Check if all items for the order are delivered to complete the order
            $item = \App\Models\OrderItem::findOrFail($orderItemId);
            $order = $item->order;
            
            $pendingItems = \App\Models\OrderItem::where('order_id', $order->id)
                ->whereDoesntHave('studentDistribution', function($q) {
                    $q->where('status', 'delivered');
                })->count();

            if ($pendingItems === 0) {
                $this->orderRepository->updateStatus($order->id, OrderStatus::COMPLETED);
            }

            return $distribution;
        });
    }
}
