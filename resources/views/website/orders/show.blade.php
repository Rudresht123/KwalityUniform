@extends('website.components.common')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">Order Details</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li><a href="{{ route('website.orders.index') }}">My Orders</a></li>
            <li>&bull;</li>
            <li class="active-item">Order #{{ $order->order_number }}</li>
        </ul>
    </div>
</div>

@php
    $statusMap = [
        'delivered'  => 'success',
        'shipped'    => 'info',
        'packed'     => 'info',
        'processing' => 'info',
        'out_for_delivery' => 'info',
        'confirmed'  => 'amber',
        'pending'    => 'amber',
        'cancelled'  => 'danger',
        'returned'   => 'danger',
        'refunded'   => 'danger',
    ];
    $currentStatus = strtolower($order->status->value);
    $statusTone = $statusMap[$currentStatus] ?? 'neutral';
    $isTerminalNegative = in_array($currentStatus, ['cancelled', 'returned', 'refunded']);

    $paymentToneMap = [
        'paid'    => 'success',
        'pending' => 'amber',
        'failed'  => 'danger',
        'refunded'=> 'danger',
    ];
    $paymentTone = $paymentToneMap[strtolower($order->payment_status)] ?? 'neutral';
@endphp

<main class="container py-5 order-details-page">
    <div class="row g-4">
        {{-- Order Summary & Tracking --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Order Summary</h5>
                        <span class="order-status order-status-{{ $statusTone }}">
                            <span class="order-status-dot"></span>{{ ucwords(str_replace('_', ' ', $currentStatus)) }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-sm-6 mb-3">
                            <label class="meta-label d-block">Order Number</label>
                            <span class="meta-value">{{ $order->order_number }}</span>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="meta-label d-block">Order Date</label>
                            <span class="meta-value">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>

                    <h6 class="section-heading mb-3">Items Ordered</h6>
                    <div class="table-responsive">
                        <table class="table align-middle order-items-table mb-0">
                            <thead>
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
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->variant?->product?->firstImage() ?? $item->image ?? asset('assets/images/no_image.jpg') }}" class="item-thumb me-3">
                                                <div>
                                                    <div class="item-name">{{ $item->variant?->product?->product_name ?? $item->product_name ?? 'Unknown Product' }}</div>
                                                    <div class="item-variant">{{ $item->variant->display_name ?? 'Standard' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">₹{{ number_format($item->unit_price, 2) }}</td>
                                        <td class="text-end item-total">₹{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="order-totals mt-3">
                        <div class="order-totals-row">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="order-totals-row">
                            <span>Shipping</span>
                            <span>₹{{ number_format($order->shipping_charge, 2) }}</span>
                        </div>
                        <div class="order-totals-row">
                            <span>Tax (GST)</span>
                            <span>₹{{ number_format($order->tax_amount ?? 0, 2) }}</span>
                        </div>
                        <div class="order-totals-row grand">
                            <span>Grand Total</span>
                            <span>₹{{ number_format($order->grand_total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Timeline --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="fw-bold mb-0">Order Tracking</h5>
                </div>
                <div class="card-body p-4">
                    @if($isTerminalNegative)
                        <div class="order-terminal-banner order-terminal-{{ $statusTone }}">
                            <i class="ti ti-{{ $currentStatus == 'cancelled' ? 'x' : 'rotate-2' }}"></i>
                            <div>
                                <strong>Order {{ ucfirst($currentStatus) }}</strong>
                                <p>This order was {{ $currentStatus }} and is no longer being processed for delivery.</p>
                            </div>
                        </div>
                    @else
                        @php
                            $statuses = ['pending', 'confirmed', 'processing', 'packed', 'shipped', 'out_for_delivery', 'delivered'];
                            $statusIndex = array_search($currentStatus, $statuses);
                            if ($statusIndex === false) $statusIndex = -1;
                        @endphp
                        <div class="timeline-container">
                            <div class="timeline-wrapper">
                                @foreach($statuses as $index => $status)
                                    <div class="timeline-item {{ $index <= $statusIndex ? 'completed' : '' }} {{ $index == $statusIndex ? 'active' : '' }}">
                                        <div class="timeline-dot">
                                            @if($index < $statusIndex)
                                                <i class="ti ti-check text-white"></i>
                                            @endif
                                        </div>
                                        <div class="timeline-content">
                                            <span class="status-label">{{ ucwords(str_replace('_', ' ', $status)) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="fw-bold mb-0">Payment &amp; Shipping</h5>
                </div>
                <div class="card-body p-4">
                    <div class="side-row">
                        <div class="side-icon"><i class="ti-credit-card"></i></div>
                        <div>
                            <label class="meta-label d-block">Payment Method</label>
                            <span class="meta-value">{{ $order->payment_status == 'paid' ? 'Paid via Card / UPI' : 'Cash on Delivery' }}</span>
                        </div>
                    </div>

                    <div class="side-row">
                        <div class="side-icon"><i class="ti-receipt"></i></div>
                        <div>
                            <label class="meta-label d-block">Payment Status</label>
                            <span class="order-status order-status-{{ $paymentTone }}">
                                <span class="order-status-dot"></span>{{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>

                    <hr class="side-divider">

                    <div class="side-row align-items-start">
                        <div class="side-icon"><i class="ti ti-map-pin"></i></div>
                        <div>
                            <label class="meta-label d-block">Shipping Address</label>
                            <p class="shipping-address mb-0">
                                {{ $order->user->name }}<br>
                                {{ $order->shippingAddress?->address_line1 ?? 'Address not set' }}<br>
                                @if($order->shippingAddress?->city || $order->shippingAddress?->state)
                                    {{ $order->shippingAddress?->city }}{{ $order->shippingAddress?->city && $order->shippingAddress?->state ? ', ' : '' }}{{ $order->shippingAddress?->state }}<br>
                                @endif
                                {{ $order->shippingAddress?->zip_code }}
                            </p>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="javascript:void(0);" onclick="confirmInvoiceDownload('{{ route('website.orders.pdf', $order->id) }}')" class="btn btn-primary py-2">
                            <i class="ti ti-download me-2"></i> Download Invoice
                        </a>
                        <a href="{{ route('website.orders.index') }}" class="btn btn-outline-secondary py-2">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.order-details-page {
    --eschool-blue: #1E3A8A;
    --eschool-blue-light: #EEF2FF;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #334155;
}

.order-details-page .card { border: 1px solid #F1F5F9; }
.order-details-page h5.fw-bold { font-family: 'Inter', sans-serif; font-weight: 700; color: #0F172A; letter-spacing: -0.01em; }

.meta-label { font-size: 11px; font-weight: 600; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px; }
.meta-value { font-size: 14.5px; font-weight: 700; color: #1E293B; }

.section-heading { font-size: 13px; font-weight: 700; color: #1E293B; text-transform: uppercase; letter-spacing: 0.4px; }

/* Status pills — shared visual language with the orders list page */
.order-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.order-status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
.order-status-success { background: #DCFCE7; color: #15803D; }
.order-status-success .order-status-dot { background: #15803D; }
.order-status-info { background: #DBEAFE; color: #1D4ED8; }
.order-status-info .order-status-dot { background: #1D4ED8; }
.order-status-amber { background: #FEF3C7; color: #B45309; }
.order-status-amber .order-status-dot { background: #B45309; }
.order-status-danger { background: #FEE2E2; color: #B91C1C; }
.order-status-danger .order-status-dot { background: #B91C1C; }
.order-status-neutral { background: #E2E8F0; color: #475569; }
.order-status-neutral .order-status-dot { background: #475569; }

/* Items table */
.order-items-table thead th {
    font-size: 11px;
    font-weight: 700;
    color: #94A3B8;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    border-bottom: 1px solid #F1F5F9;
    padding-bottom: 10px;
}
.order-items-table tbody td { border-bottom: 1px solid #F8FAFC; padding: 12px 8px; font-size: 13.5px; }
.order-items-table tbody tr:last-child td { border-bottom: none; }
.item-thumb { width: 52px; height: 52px; object-fit: cover; border-radius: 8px; border: 1px solid #F1F5F9; }
.item-name { font-weight: 700; color: #1E293B; font-size: 14px; }
.item-variant { font-size: 12px; color: #94A3B8; margin-top: 1px; }
.item-total { font-weight: 700; color: #1E293B; }

/* Totals block */
.order-totals { max-width: 320px; margin-left: auto; padding-top: 14px; border-top: 1px solid #F1F5F9; }
.order-totals-row { display: flex; justify-content: space-between; font-size: 13px; color: #64748B; padding: 4px 0; }
.order-totals-row.grand {
    margin-top: 6px;
    padding-top: 10px;
    border-top: 1.5px solid var(--eschool-blue);
    font-weight: 800;
    font-size: 16px;
    color: var(--eschool-blue);
}

/* Sidebar rows */
.side-row { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
.side-icon {
    flex: none;
    width: 36px;
    height: 36px;
    border-radius: 9px;
    background: var(--eschool-blue-light);
    color: var(--eschool-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}
.side-divider { border-color: #F1F5F9; margin: 18px 0; }
.shipping-address { font-size: 13.5px; color: #475569; line-height: 1.6; }

.btn-eschool-primary {
    background: var(--eschool-blue);
    border-color: var(--eschool-blue);
    color: #fff;
    font-weight: 600;
}
.btn-eschool-primary:hover { background: #16306F; border-color: #16306F; color: #fff; }

/* Timeline */
.timeline-container { position: relative; padding: 20px 0 4px; }
.timeline-wrapper { display: flex; justify-content: space-between; position: relative; }
.timeline-wrapper::before {
    content: ''; position: absolute; top: 15px; left: 0; right: 0;
    height: 3px; background: #e2e8f0; z-index: 1;
}
.timeline-item {
    position: relative; z-index: 2; display: flex; flex-direction: column;
    align-items: center; text-align: center; flex: 1;
}
.timeline-dot {
    width: 30px; height: 30px; border-radius: 50%; background: #e2e8f0;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; margin-bottom: 10px; transition: all 0.3s ease;
}
.timeline-item.completed .timeline-dot { background: #059669; color: #fff; }
.timeline-item.active .timeline-dot {
    background: var(--eschool-blue); color: #fff; box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.2);
}
.status-label { font-size: 11px; font-weight: 700; color: #94a3b8; transition: all 0.3s ease; }
.timeline-item.completed .status-label, .timeline-item.active .status-label { color: #1e293b; }
.timeline-item.active .status-label { color: var(--eschool-blue); }

/* Terminal (cancelled / returned / refunded) banner */
.order-terminal-banner {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 18px;
    border-radius: 10px;
}
.order-terminal-banner i { font-size: 20px; flex: none; margin-top: 2px; }
.order-terminal-banner strong { display: block; font-size: 14px; margin-bottom: 3px; }
.order-terminal-banner p { margin: 0; font-size: 12.5px; }
.order-terminal-danger { background: #FEF2F2; color: #B91C1C; }
.order-terminal-neutral { background: #F1F5F9; color: #475569; }

@media (max-width: 575.98px) {
    .order-totals { max-width: 100%; }
    .timeline-wrapper { flex-wrap: wrap; row-gap: 16px; }
    .timeline-wrapper::before { display: none; }
    .timeline-item { flex: 0 0 33%; }
}
</style>
@endsection