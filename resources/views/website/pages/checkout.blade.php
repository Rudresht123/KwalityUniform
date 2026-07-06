@extends('website.components.common')

@section('content')
<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">Checkout</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li><a href="{{ route('website.cart.index') }}">Basket</a></li>
            <li>&bull;</li>
            <li class="active-item">Checkout</li>
        </ul>
    </div>
</div>

<main class="container py-5">
    <form action="#" method="POST" id="checkout-form">
        @csrf
        <div class="row g-4">
            <!-- Shipping and Payment Details -->
            <div class="col-lg-8">
                <div class="card-geo p-4 mb-4">
                    <h5 class="fw-bold mb-4"><i class="ti ti-map-pin me-2"></i>Shipping Address</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+91 00000-00000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Mumbai" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Detailed Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Street, Apartment, Area..." required></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-geo p-4">
                    <h5 class="fw-bold mb-4"><i class="ti ti-credit-card me-2"></i>Payment Method</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="payment-option card-geo p-3 text-center border-primary is-selected" id="pay-cod">
                                <i class="ti ti-truck" style="font-size: 24px;"></i>
                                <div class="fw-bold mt-2">Cash on Delivery</div>
                                <input type="radio" name="payment_method" value="cod" class="payment-radio" checked>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="payment-option card-geo p-3 text-center" id="pay-upi">
                                <i class="ti ti-device-mobile" style="font-size: 24px;"></i>
                                <div class="fw-bold mt-2">UPI / QR Code</div>
                                <input type="radio" name="payment_method" value="upi" class="payment-radio">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="payment-option card-geo p-3 text-center" id="pay-card">
                                <i class="ti ti-credit-card" style="font-size: 24px;"></i>
                                <div class="fw-bold mt-2">Credit / Debit Card</div>
                                <input type="radio" name="payment_method" value="card" class="payment-radio">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card-geo p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-4">Order Summary</h5>
                    <div class="order-summary-items mb-4">
                        {{-- This part usually needs to be passed from controller, providing a placeholder layout --}}
                        <p class="text-muted small">Items from your basket will be listed here.</p>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">₹0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success fw-semibold">Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 pb-3 border-bottom">
                        <span class="fw-bold h5 mb-0">Total</span>
                        <span class="fw-extrabold h5 mb-0 text-primary">₹0.00</span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                        Place Order <i class="ti ti-check me-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>

<style>
    .payment-option {
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        border: 2px solid transparent;
    }
    .payment-option:hover {
        border-color: var(--qu-primary);
    }
    .payment-option.is-selected {
        border-color: var(--qu-primary);
        background-color: #f0f7ff;
    }
    .payment-radio {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const options = document.querySelectorAll('.payment-option');
        options.forEach(opt => {
            opt.addEventListener('click', function() {
                options.forEach(o => o.classList.remove('is-selected'));
                this.classList.add('is-selected');
                this.querySelector('input').checked = true;
            });
        });
    });
</script>
@endsection
