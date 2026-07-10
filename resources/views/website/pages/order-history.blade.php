@extends('layouts.common')

@section('content')
<div class="order-history-container py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-extrabold text-dark mb-1">My Orders</h1>
                <p class="text-muted mb-0">Manage and track your institutional wear purchases</p>
            </div>
            <div class="d-flex gap-3">
                <div class="search-box position-relative">
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="orderSearch" class="form-control ps-5 rounded-pill" placeholder="Search Order ID...">
                </div>
            </div>
        </div>

        @if($orders->isEmpty())
            <div class="text-center py-5">
                <img src="{{ asset('assets/images/empty-orders.svg') }}" alt="No orders" style="width: 250px;" class="mb-4 opacity-50">
                <h4 class="fw-bold text-dark">No orders found</h4>
                <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping for your uniforms!</p>
                <a href="{{ route('website.shop') }}" class="btn btn-primary px-4 py-2 rounded-pill">Start Shopping</a>
            </div>
        @else
            <div class="row g-4">
                @foreach($orders as $order)
                <div class="col-12">
                    <div class="premium-order-card shadow-sm rounded-4 border-0 overflow-hidden">
                        <div class="order-card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 border-end-md">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="order-id-badge">#{{ $order->id }}</div>
                                        <div>
                                            <div class="fw-bold text-dark">Order #{{ $order->id }}</div>
                                            <div class="text-muted small">{{ $order->created_at->format('d M, Y | h:i A') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="status-badge badge-{{ $order->status->value }}">
                                            {{ strtoupper($order->status->value) }}
                                        </span>
                                        <span class="text-muted small">• {{ $order->items_count ?? $order->items->count() }} Items</span>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-center">
                                    <div class="text-muted small mb-1">Total Amount</div>
                                    <div class="fw-bold text-dark fs-5">₹{{ number_format($order->total_amount, 2) }}</div>
                                </div>
                                <div class="col-md-3 text-md-end">
                                    <div class="d-flex justify-content-md-end gap-2">
                                        <a href="{{ route('website.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill">View Details</a>
                                        <a href="{{ route('website.orders.pdf', $order->id) }}" class="btn btn-sm btn-primary px-3 rounded-pill">Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .premium-order-card { background: #fff; transition: all 0.2s ease; border: 1px solid #eee; }
    .premium-order-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; border-color: var(--qu-primary); }
    .order-id-badge { width: 45px; height: 45px; background: var(--qu-primary-subtle); color: var(--qu-primary); 
                      display: flex; align-items: center; justify-content: center; border-radius: 12px; font-weight: bold; font-size: 13px; }
    .status-badge.badge-pending { background: #fef9c3; color: #854d0e; }
    .status-badge.badge-confirmed { background: #dcfce7; color: #166534; }
    .status-badge.badge-processing { background: #dbeafe; color: #1e40af; }
    .status-badge.badge-shipped { background: #f3e8ff; color: #6b21a8; }
    .status-badge.badge-delivered { background: #dcfce7; color: #166534; }
    .status-badge.badge-cancelled { background: #fee2e2; color: #991b1b; }
    .border-end-md { border-right: 1px solid #eee; }
    @media (max-width: 767.98px) { .border-end-md { border-right: none; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px; } }
</style>
@endsection
