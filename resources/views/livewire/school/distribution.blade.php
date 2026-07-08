<div class="container-fluid p-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">School Distribution Portal</h5>
        </div>
        <div class="card-body">
            @if($message)
                <div class="alert alert-info">{{ $message }}</div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h6>Incoming Shipments</h6>
                    <div class="list-group">
                        @forelse($incomingShipments as $shipment)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $shipment->tracking_number }}</strong><br>
                                    <small>Courier: {{ $shipment->courier->name }}</small>
                                </div>
                                <button wire:click="receiveShipment('{{ $shipment->id }}')" class="btn btn-sm btn-primary">Mark Received</button>
                            </div>
                        @empty
                            <p class="text-muted">No incoming shipments.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <h6>Student Pickups Pending</h6>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Student/Parent</th>
                                <th>Item</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingPickups as $item)
                                <tr>
                                    <td>{{ $item->order->user->name }}</td>
                                    <td>Variant ID: {{ $item->product_variant_id }}</td>
                                    <td><button wire:click="markPickedUp('{{ $item->id }}')" class="btn btn-sm btn-success">Mark Picked Up</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
