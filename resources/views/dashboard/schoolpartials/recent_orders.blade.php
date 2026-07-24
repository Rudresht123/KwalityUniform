<div class="row mt-4">
    <div class="col-12">


        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">
                    <i class="ti ti-chart-line" style="color:var(--primary)"></i>
                    Recent Orders
                </h3>
            </div>

            <div>
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Order</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Placed On</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($stats['recent_orders'] ?? [] as $index => $order)
                            @php

                                $statusClass = match ($order->status) {
                                    'pending' => 'warning',
                                    'confirmed' => 'info',
                                    'processing' => 'primary',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary',
                                };

                                $paymentClass = match ($order->payment_status) {
                                    'paid' => 'success',
                                    'pending' => 'warning',
                                    'failed' => 'danger',
                                    default => 'secondary',
                                };

                            @endphp

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>

                                    <div class="fw-semibold">
                                        {{ $order->order_number }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $order->delivery_type == 'school' ? 'School Delivery' : 'Home Delivery' }}
                                    </small>

                                </td>

                                <td>

                                    <div class="fw-bold text-success">
                                        ₹{{ number_format($order->grand_total, 2) }}
                                    </div>

                                </td>

                                <td>

                                    <span class="badge bg-{{ $paymentClass }}-transparent">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>

                                </td>

                                <td>

                                    <span class="badge bg-{{ $statusClass }}-transparent">
                                        {{ ucfirst($order->status->value) }}
                                    </span>

                                </td>

                                <td>

                                    <div>{{ optional($order->placed_at)->format('d M Y') }}</div>

                                    <small class="text-muted">
                                        {{ optional($order->placed_at)->format('h:i A') }}
                                    </small>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6">

                                    <div class="text-center py-5">

                                        <i class="ti ti-shopping-cart-off fs-40 text-muted d-block mb-2"></i>

                                        <h6 class="mb-1">
                                            No Orders Found
                                        </h6>

                                        <small class="text-muted">
                                            Recent orders will appear here.
                                        </small>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>


    </div>
</div>
