<div class="container-fluid p-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Vendor Fulfillment Center</h5>
        </div>
        <div class="card-body">
            @if($message)
                <div class="alert alert-info">{{ $message }}</div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <h6>Create Bulk Shipment</h6>
                    <div class="form-group mb-3">
                        <label>Select School</label>
                        <select wire:model="selectedSchool" class="form-select">
                            <option value="">-- Choose School --</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Select Courier</label>
                        <select wire:model="selectedCourier" class="form-select">
                            <option value="">-- Choose Courier --</option>
                            @foreach($couriers as $courier)
                                <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click="createBulkShipment" class="btn btn-success w-100">Generate Bulk Shipment</button>
                </div>
                
                <div class="col-md-8">
                    <h6>Pending Bulk Orders</h6>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>School</th>
                                <th>Pending Orders</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingBulkOrders as $item)
                                <tr>
                                    <td>{{ $item['school']->school_name }}</td>
                                    <td>{{ $item['count'] }}</td>
                                    <td><button class="btn btn-sm btn-outline-primary" wire:click="$set('selectedSchool', '{{ $item['school']->school_id }}')">Select</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
