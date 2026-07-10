@extends('layouts.common')

@section('content')
<div class="order-details-container py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('website.orders.index') }}" class="btn btn-link text-decoration-none p-0">
                <i class="ti ti-arrow-left"></i> Back to My Orders
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('website.orders.pdf', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="ti ti-download"></i> Invoice
                </a>
                <button onclick="window.print()" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="ti ti-printer"></i> Print
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Order Info & Products -->
            <div class="col-lg-8">
                <!-- Order Status Timeline -->
                <div class="premium-card shadow-sm rounded-4 border-0 mb-4 p-4">
                    <h5 class="fw-bold text-dark mb-4">Order Tracking</h5>
                    <div class="tracking-timeline">
                        @php
                            $statuses = ['Pending', 'Confirmed', 'Processing', 'Packed', 'Shipped', 'Out For Delivery', 'Delivered'];
                            $currentStatus = ucfirst($order->status);
                            $statusIndex = array_search($currentStatus, $statuses);
                        @endphp
                        <div class="timeline-wrapper">
                            @foreach($statuses as $index => $status)
                            <div class="timeline-step {{ $index <= $statusIndex ? 'completed' : '' }}">
                                <div class="step-circle">{{ $index < $statusIndex ? '✓' : ($index == $statusIndex ? '●' : '') }}</div>
                                <div class="step-label">{{ $status }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Product List -->
                <div class="premium-card shadow-sm rounded-4 border-0 overflow-hidden">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h5 class="mb-0 fw-bold text-dark">Ordered Products</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Product</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end px-4">Price</th>
                                        <th class="text-end px-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->product_name }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $item->product->product_name }}</div>
                                                    <div class="text-muted small">{{ $item->variant->display_name ?? 'Standard' }} | SKU: {{ $item->variant->sku ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end px-4">₹{{ number_format($item->price, 2) }}</td>
                                        <td class="text-end px-4 fw-bold">₹{{ number_format($item->quantity * $item->price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Addresses & Payment -->
            <div class="col-lg-4">
                <!-- Shipping Address -->
                <div class="premium-card shadow-sm rounded-4 border-0 mb-4 p-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="ti ti-map-pin me-2"></i>Shipping Address</h6>
                    <p class="text-muted small mb-0">
                        {{ $order->shipping_address }}
                    </p>
                </div>

                <!-- Payment Details -->
                <div class="premium-card shadow-sm rounded-4 border-0 mb-4 p-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="ti ti-credit-card me-2"></i>Payment Summary</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Payment Method:</span>
                        <span class="fw-medium">{{ strtoupper($order->payment_method ?? 'COD') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Payment Status:</span>
                        <span class="badge bg-success-subtle text-success">Paid</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3 pt-3 border-top fw-bold fs-5">
                        <span>Total:</span>
                        <span>₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                <!-- Order Actions -->
                <div class="d-grid gap-3">
                    <a href="{{ route('website.orders.pdf', $order->id) }}" class="btn btn-primary py-2 fw-bold rounded-pill">
                        <i class="ti ti-download me-2"></i> Download Invoice
                    </a>
                    <button class="btn btn-outline-secondary py-2 fw-bold rounded-pill" onclick="alert('Return request feature coming soon!')">
                        <i class="ti ti-refresh me-2"></i> Request Return
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .premium-card { background: #fff; transition: all 0.2s ease; }
    .tracking-timeline { padding: 20px 0; }
    .timeline-wrapper { display: flex; justify-content: space-between; position: relative; }
    .timeline-wrapper::before { 
        content: ''; position: absolute; top: 15px; left: 0; right: 0; 
        height: 4px; background: #eee; z-index: 1; 
    }
    .timeline-step { position: relative; z-index: 2; text-align: center; flex: 1; }
    .step-circle { 
        width: 30px; height: 30px; background: #fff; border: 3px solid #eee; 
        border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center;
        font-size: 14px; font-weight: bold; transition: all 0.3s ease; 
    }
    .timeline-step.completed .step-circle { border-color: #059669; background: #059669; color: #fff; }
    .timeline-step.completed .step-label { color: #059669; font-weight: bold; }
    .step-label { font-size: 11px; color: #999; text-transform: uppercase; letter-spacing: 0.5px; }
    
    @media (max-width: 767.98px) {
        .timeline-wrapper { flex-direction: column; gap: 20px; }
        .timeline-wrapper::before { display: none; }
        .timeline-step { display: flex; align-items: center; gap: 15px; text-align: left; }
        .step-circle { margin: 0; }
    }
</style>
@endsection
