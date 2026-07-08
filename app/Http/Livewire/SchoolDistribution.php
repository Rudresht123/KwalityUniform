<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\FulfillmentService;
use App\Models\Shipment;
use App\Models\OrderItem;

class SchoolDistribution extends Component
{
    public $message = '';

    public function __construct(
        protected FulfillmentService $fulfillmentService
    ) {}

    public function render()
    {
        // Assuming current user's school is resolved
        $schoolId = auth()->user()->school_id;

        return view('livewire.school.distribution', [
            'incomingShipments' => Shipment::where('destination_address_id', $schoolId)
                ->where('status', 'packed')
                ->get(),
            'pendingPickups' => OrderItem::whereHas('order', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId)
                  ->where('status', 'delivered');
            })->whereDoesntHave('studentDistribution', function($q) {
                $q->where('status', 'delivered');
            })->with('order.user')->get(),
        ]);
    }

    public function receiveShipment($shipmentId)
    {
        try {
            $this->fulfillmentService->markSchoolReceived($shipmentId, auth()->id());
            $this->message = 'Shipment received and marked for distribution!';
        } catch (\Exception $e) {
            $this->message = 'Error: ' . $e->getMessage();
        }
    }

    public function markPickedUp($orderItemId)
    {
        try {
            $this->fulfillmentService->markStudentPickup($orderItemId, auth()->id());
            $this->message = 'Item marked as picked up by student!';
        } catch (\Exception $e) {
            $this->message = 'Error: ' . $e->getMessage();
        }
    }
}
