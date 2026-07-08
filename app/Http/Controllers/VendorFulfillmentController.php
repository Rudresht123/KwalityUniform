<?php

namespace App\Http\Controllers;

use App\Services\FulfillmentService;
use App\Repositories\OrderRepository;
use App\Models\School;
use App\Models\Courier;
use Illuminate\Http\Request;

class VendorFulfillmentController extends Controller
{
    public function __construct(
        protected FulfillmentService $fulfillmentService,
        protected OrderRepository $orderRepository
    ) {}

    public function index()
    {
        $schools = School::where('is_active', true)->get();
        $couriers = Courier::all();
        
        $pendingBulkOrders = School::all()->map(function($school) {
            return [
                'school' => $school,
                'count' => $this->orderRepository->getConfirmedOrdersBySchool($school->school_id)->count()
            ];
        })->filter(fn($item) => $item['count'] > 0);

        return view('vendor.fulfillment', compact('schools', 'couriers', 'pendingBulkOrders'));
    }

    public function createBulkShipment(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'courier_id' => 'required',
        ]);

        try {
            $this->fulfillmentService->createBulkShipment($request->school_id, $request->courier_id);
            return back()->with('success', 'Bulk shipment created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function createHomeShipment(Request $request, $orderId)
    {
        $request->validate([
            'courier_id' => 'required',
        ]);

        try {
            $this->fulfillmentService->createHomeShipment($orderId, $request->courier_id);
            return back()->with('success', 'Home shipment created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
