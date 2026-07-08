<div class="container-fluid p-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">My Order Tracking</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Delivery Type</th>
                            <th>Status</th>
                            <th>Tracking</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->delivery_type }}</td>
                                <td><span class="badge bg-secondary">{{ $order->status }}</span></td>
                                <td>
                                    @if($order->shipments->count() > 0)
                                        {{ $order->shipments->first()->tracking_number }}
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td><button class="btn btn-sm btn-outline-info">Details</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
