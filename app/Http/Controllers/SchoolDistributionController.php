<?php

namespace App\Http\Controllers;

use App\Services\FulfillmentService;
use App\Models\Shipment;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class SchoolDistributionController extends Controller
{
    public function __construct(
        protected FulfillmentService $fulfillmentService
    ) {}

    public function index()
    {
        $schoolId = auth()->user()->school_id;

        $incomingShipments = Shipment::where('destination_address_id', $schoolId)
            ->where('status', 'packed')
            ->get();

        $pendingPickups = OrderItem::whereHas('order', function($q) use ($schoolId) {
            $q->where('school_id', $schoolId)
              ->where('status', 'delivered');
        })->whereDoesntHave('studentDistribution', function($q) {
            $q->where('status', 'delivered');
        })->with('order.user')->get();

        return view('school.distribution', compact('incomingShipments', 'pendingPickups'));
    }

    public function receiveShipment(Request $request, $shipmentId)
    {
        try {
            $this->fulfillmentService->markSchoolReceived($shipmentId, auth()->id());
            return back()->with('success', 'Shipment received and marked for distribution!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function markPickedUp(Request $request, $orderItemId)
    {
        try {
            $this->fulfillmentService->markStudentPickup($orderItemId, auth()->id());
            return back()->with('success', 'Item marked as picked up by student!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
