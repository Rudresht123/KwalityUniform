<?php

namespace App\Repositories;

use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class ShipmentRepository
{
    public function create(array $data): Shipment
    {
        return Shipment::create($data);
    }

    public function updateStatus(string $shipmentId, string $status, array $additionalData = []): bool
    {
        return Shipment::where('id', $shipmentId)->update(array_merge(['status' => $status], $additionalData));
    }

    public function getShipmentsBySchool(string $schoolId): Collection
    {
        return Shipment::where('destination_address_id', $schoolId)->get();
    }
}
