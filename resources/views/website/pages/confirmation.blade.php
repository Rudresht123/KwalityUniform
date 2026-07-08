@extends('website.components.common')

@section('content')
<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">Review Your Order</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li><a href="{{ route('website.cart.index') }}">Basket</a></li>
            <li>&bull;</li>
            <li><a href="{{ route('website.checkout') }}">Checkout</a></li>
            <li>&bull;</li>
            <li class="active-item">Confirmation</li>
        </ul>
    </div>
</div>

<main class="container py-5">
    {{-- Progress Steps --}}
    <div class="checkout-steps mb-5">
        <div class="checkout-step is-done">
            <div class="checkout-step-circle"><i class="ti ti-check"></i></div>
            <span>Basket</span>
        </div>
        <div class="checkout-step-line is-done"></div>
        <div class="checkout-step is-done">
            <div class="checkout-step-circle"><i class="ti ti-check"></i></div>
            <span>Checkout</span>
        </div>
        <div class="checkout-step-line is-done"></div>
        <div class="checkout-step is-active">
            <div class="checkout-step-circle">3</div>
            <span>Confirmation</span>
        </div>
    </div>

    <form action="{{ route('website.order.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                {{-- Order Items --}}
                <div class="review-panel mb-4">
                    <div class="review-panel-header">
                        <div class="review-panel-icon"><i class="ti-shopping-cart"></i></div>
                        <h5 class="review-panel-title">Order Items</h5>
                    </div>
                    <div class="review-panel-body">
                        <div class="review-items-list">
                            @foreach($cartItems as $item)
                                <div class="review-item">
                                    <div class="review-item-img">
                                        <img src="{{ $item->product->firstImage() }}" alt="{{ $item->product->product_name }}">
                                    </div>
                                    <div class="review-item-info">
                                        <div class="review-item-name">{{ $item->product->product_name }}</div>
                                        <div class="review-item-variant">{{ $item->variant->display_name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="review-item-price">
                                        ₹{{ number_format($item->quantity * $item->unit_price, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Shipping & Payment Details --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="review-panel">
                            <div class="review-panel-header">
                                <div class="review-panel-icon"><i class="ti ti-map-pin"></i></div>
                                <h5 class="review-panel-title">Shipping To</h5>
                            </div>
                            <div class="review-panel-body">
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Name:</span>
                                    <span class="review-detail-value">{{ $details['full_name'] }}</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Phone:</span>
                                    <span class="review-detail-value">{{ $details['phone'] }}</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Address:</span>
                                    <span class="review-detail-value">{{ $details['address'] }}</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">City:</span>
                                    <span class="review-detail-value">{{ $details['city'] }}</span>
                                </div>
                                <div class="review-detail-badge {{ $details['delivery_type'] === 'school' ? 'badge-school' : 'badge-home' }}">
                                    {{ $details['delivery_type'] === 'school' ? 'School Delivery' : 'Home Delivery' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="review-panel">
                            <div class="review-panel-header">
                                <div class="review-panel-icon"><i class="ti-credit-card"></i></div>
                                <h5 class="review-panel-title">Payment</h5>
                            </div>
                            <div class="review-panel-body">
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Method:</span>
                                    <span class="review-detail-value fw-bold text-uppercase">{{ str_replace('_', ' ', $details['payment_method']) }}</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Status:</span>
                                    <span class="review-detail-value text-warning">Pending Payment</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('website.checkout') }}" class="btn-back-to-checkout">
                        <i class="ti ti-arrow-left me-2"></i> Edit Details
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="review-summary-panel sticky-top" style="top: 100px;">
                    <h5 class="review-summary-title">Final Total</h5>
                    <div class="review-summary-row">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="review-summary-row">
                        <span>Shipping</span>
                        <span>{{ $shipping == 0 ? 'Free' : '₹' . number_format($shipping, 2) }}</span>
                    </div>
                    <div class="review-summary-divider"></div>
                    <div class="review-summary-total-row">
                        <span>Total Amount</span>
                        <span class="review-summary-total-value">₹{{ number_format($subtotal + $shipping, 2) }}</span>
                    </div>

                    <button type="submit" class="btn-confirm-order">
                        <i class="ti ti-check me-2"></i> Confirm & Place Order
                    </button>
                    
                    <p class="review-secure-text">
                        <i class="ti ti-shield-check"></i> Secure encrypted transaction
                    </p>
                </div>
            </div>
        </div>
    </form>
</main>

<style>
.review-panel {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #EDEFF3;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
    overflow: hidden;
    margin-bottom: 24px;
}

.review-panel-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    border-bottom: 1px solid #F1F3F6;
    background: #fcfcfc;
}

.review-panel-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #EEF2FF;
    color: #1E3A8A;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.review-panel-title {
    font-size: 1rem;
    font-weight: 800;
    color: #111827;
    margin: 0;
}

.review-panel-body {
    padding: 24px;
}

.review-items-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.review-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #F1F3F6;
}

.review-item-img {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    background: #F5F5F7;
}

.review-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.review-item-info {
    flex: 1;
}

.review-item-name {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
}

.review-item-variant {
    font-size: 12px;
    color: #6B7280;
}

.review-item-price {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
}

.review-detail-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 13.5px;
}

.review-detail-label {
    color: #6B7280;
}

.review-detail-value {
    color: #111827;
    font-weight: 600;
}

.review-detail-badge {
    margin-top: 16px;
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
}

.badge-school {
    background: #DCFCE7;
    color: #059669;
}

.badge-home {
    background: #FEE2E2;
    color: #B91C1C;
}

.btn-back-to-checkout {
    display: inline-flex;
    align-items: center;
    color: #6B7280;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: color 0.2s;
}

.btn-back-to-checkout:hover {
    color: #1E3A8A;
}

.review-summary-panel {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #EDEFF3;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    padding: 28px;
}

.review-summary-title {
    font-size: 1.1rem;
    font-weight: 800;
    color: #111827;
    margin-bottom: 24px;
}

.review-summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 14px;
    color: #6B7280;
}

.review-summary-divider {
    border-top: 1px solid #F1F3F6;
    margin: 20px 0;
}

.review-summary-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.review-summary-total-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: #1E3A8A;
}

.btn-confirm-order {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #1E3A8A;
    color: #fff;
    border: none;
    font-weight: 700;
    font-size: 15px;
    padding: 16px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-confirm-order:hover {
    background: #16296b;
}

.review-secure-text {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 11px;
    color: #9CA3AF;
    margin-top: 16px;
    text-align: center;
}

.review-secure-text i {
    color: #059669;
}
</style>
@endsection
