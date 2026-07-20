<div class="shipment-details">
    <div class="row mb-4">
        <div class="col-6">
            <small class="text-muted d-block">Tracking Number</small>
            <strong class="fs-5">{{ $shipment->tracking_number }}</strong>
        </div>
        <div class="col-6">
            <small class="text-muted d-block">Status</small>
            <span class="badge bg-primary">{{ strtoupper($shipment->status->value) }}</span>
        </div>
    </div>

    <h5>Products</h5>
    <table class="table table-sm">
        <thead><tr><th>Product</th><th>Qty</th></tr></thead>
        <tbody>
            @foreach($shipment->items as $item)
                <tr>
                    <td>{{ $item->orderItem->product->product_name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity_shipped }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="mt-4">Timeline</h5>
    <div class="timeline mt-3">
        @foreach($shipment->auditLogs as $log)
            <div class="timeline-item pb-3">
                <small class="text-muted d-block">{{ $log->created_at->format('d M, H:i') }}</small>
                <strong>{{ $log->status }}</strong>
                <p class="mb-0 small">{{ $log->remarks }} - <span class="text-primary">{{ $log->user->name ?? 'System' }}</span></p>
            </div>
        @endforeach
    </div>
</div>
