@extends('layouts.common')

@section('content')
<div class="order-success-container py-5">
    <div class="container">
        <!-- Success Animation Section -->
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <div class="success-icon-wrapper mb-4">
                <div class="success-check-circle">
                    <i class="ti ti-check"></i>
                </div>
            </div>
            <h1 class="display-5 fw-extrabold text-dark mb-3">Thank You for Your Order!</h1>
            <p class="lead text-muted">Your order has been placed successfully. We're preparing your garments for delivery.</p>
        </div>

        <div class="row g-4">
            <!-- Order Summary Card -->
            <div class="col-lg-8">
                <div class="premium-card shadow-sm rounded-4 overflow-hidden border-0">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold text-dark">Order Summary</h5>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-sm-6 col-md-3">
                                <label class="text-muted small d-block">Order Number</label>
                                <span class="fw-bold text-dark">#{{ $order->id }}</span>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="text-muted small d-block">Invoice Number</label>
                                <span class="fw-bold text-dark">INV-{{ $order->id }}</span>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="text-muted small d-block">Order Date</label>
                                <span class="fw-bold text-dark">{{ $order->created_at->format('d M, Y') }}</span>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="text-muted small d-block">Payment Method</label>
                                <span class="fw-bold text-dark">{{ strtoupper($order->payment_method ?? 'COD') }}</span>
                            </div>
                        </div>

                        <!-- Product Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->product_name }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $item->product->product_name }}</div>
                                                    <div class="text-muted small">{{ $item->variant->display_name ?? 'Standard' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                                        <td class="text-end fw-bold">₹{{ number_format($item->quantity * $item->price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Order Total -->
                        <div class="d-flex justify-content-end mt-4">
                            <div class="text-end" style="width: 250px;">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal:</span>
                                    <span>₹{{ number_format($order->total_amount - ($order->shipping_fee ?? 0), 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Shipping:</span>
                                    <span>₹{{ number_format($order->shipping_fee ?? 0, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2">
                                    <span>Grand Total:</span>
                                    <span>₹{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping & Actions Card -->
            <div class="col-lg-4">
                <div class="premium-card shadow-sm rounded-4 overflow-hidden border-0 mb-4">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h5 class="mb-0 fw-bold text-dark">Delivery Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-box bg-primary-subtle text-primary rounded-circle p-3">
                                <i class="ti ti-map-pin"></i>
                            </div>
                            <div>
                                <label class="text-muted small d-block">Shipping Address</label>
                                <p class="mb-0 fw-medium text-dark">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-4">
                            <div class="icon-box bg-info-subtle text-info rounded-circle p-3">
                                <i class="ti ti-calendar-event"></i>
                            </div>
                            <div>
                                <label class="text-muted small d-block">Est. Delivery Date</label>
                                <p class="mb-0 fw-medium text-dark">{{ $order->created_at->addDays(7)->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="premium-card shadow-sm rounded-4 overflow-hidden border-0">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h5 class="mb-0 fw-bold text-dark">Invoice Actions</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid gap-3">
                            <a href="{{ route('website.order.download', $order->id) }}" class="btn btn-primary py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-download"></i> Download Invoice
                            </a>
                            <a href="{{ route('website.order.stream', $order->id) }}" target="_blank" class="btn btn-outline-primary py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-printer"></i> Print Invoice
                            </a>
                            <button type="button" onclick="sendInvoiceEmail('{{ $order->id }}')" id="btnEmailInvoice" class="btn btn-outline-secondary py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-mail"></i> Email Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('website.home') }}" class="btn btn-dark px-5 py-3 fw-bold rounded-pill shadow-sm">
                Continue Shopping <i class="ti ti-shopping-cart ms-2"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .success-check-circle {
        width: 100px; height: 100px; background: #059669; color: #fff; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 50px;
        margin: 0 auto; box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
    }
    .premium-card { background: #fff; transition: transform 0.2s ease; }
    .icon-box { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
</style>

<script>
    function sendInvoiceEmail(orderId) {
        const btn = document.getElementById('btnEmailInvoice');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Sending...';

        fetch(`/website/order/email-invoice/${orderId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
            } else {
                alert('An unexpected error occurred.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to send email.');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="ti ti-mail"></i> Email Invoice';
        });
    }
</script>
@endsection
