<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\FulfillmentService;
use App\Repositories\OrderRepository;
use App\Models\School;
use App\Models\Courier;

class VendorFulfillment extends Component
{
    public $selectedSchool = null;
    public $selectedCourier = null;
    public $message = '';

    public function __construct(
        protected FulfillmentService $fulfillmentService,
        protected OrderRepository $orderRepository
    ) {}

    public function render()
    {
        return view('livewire.vendor.fulfillment', [
            'schools' => School::where('is_active', true)->get(),
            'couriers' => Courier::all(),
            'pendingBulkOrders' => School::all()->map(function($school) {
                return [
                    'school' => $school,
                    'count' => $this->orderRepository->getConfirmedOrdersBySchool($school->school_id)->count()
                ];
            })->filter(fn($item) => $item['count'] > 0),
        ]);
    }

    public function createBulkShipment()
    {
        $this->validate([
            'selectedSchool' => 'required',
            'selectedCourier' => 'required',
        ]);

        try {
            $this->fulfillmentService->createBulkShipment($this->selectedSchool, $this->selectedCourier);
            $this->message = 'Bulk shipment created successfully!';
            $this->reset(['selectedSchool', 'selectedCourier']);
        } catch (\Exception $e) {
            $this->message = 'Error: ' . $e->getMessage();
        }
    }

    public function createHomeShipment($orderId)
    {
        try {
            $this->fulfillmentService->createHomeShipment($orderId, $this->selectedCourier);
            $this->message = 'Home shipment created successfully!';
        } catch (\Exception $e) {
            $this->message = 'Error: ' . $e->getMessage();
        }
    }
}
