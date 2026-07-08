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

    {{-- Progress Steps --}}
    <div class="checkout-steps mb-5">
        <div class="checkout-step" id="step-basket">
            <div class="checkout-step-circle"><i class="ti-check"></i></div>
            <span>Basket</span>
        </div>
        <div class="checkout-step-line" id="line-basket"></div>
        <div class="checkout-step" id="step-checkout">
            <div class="checkout-step-circle">2</div>
            <span>Checkout</span>
        </div>
        <div class="checkout-step-line" id="line-checkout"></div>
        <div class="checkout-step" id="step-confirmation">
            <div class="checkout-step-circle">3</div>
            <span>Confirmation</span>
        </div>
    </div>

    {{-- STEP 1: Checkout Form --}}
    <div id="wizard-checkout-step">
        <form id="checkout-form">
            @csrf
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="checkout-panel mb-4">
                        <div class="checkout-panel-header">
                            <div class="checkout-panel-icon"><i class="ti ti-map-pin"></i></div>
                            <div>
                                <h5 class="checkout-panel-title">Shipping Address</h5>
                                <p class="checkout-panel-subtitle">Tell us where to send your uniform order</p>
                            </div>
                        </div>

                        <div class="checkout-panel-body">
                            <div class="delivery-toggle-group mb-4">
                                <label class="delivery-toggle-option" id="deliv-school-container">
                                    <input class="d-none" type="radio" name="delivery_type" id="delivery_school" value="school" {{ (session('checkout_details.delivery_type') ?? 'school') === 'school' ? 'checked' : '' }}>
                                    <div class="delivery-toggle-icon"><i class="ti ti-building-community"></i></div>
                                    <div>
                                        <div class="delivery-toggle-title">Deliver to School</div>
                                        <div class="delivery-toggle-desc">Free &bull; Collect from campus</div>
                                    </div>
                                    <div class="delivery-toggle-check"><i class="ti ti-check"></i></div>
                                </label>

                                <label class="delivery-toggle-option" id="deliv-home-container">
                                    <input class="d-none" type="radio" name="delivery_type" id="delivery_home" value="home" {{ (session('checkout_details.delivery_type') ?? 'home') === 'home' ? 'checked' : '' }}>
                                    <div class="delivery-toggle-icon"><i class="ti-home"></i></div>
                                    <div>
                                        <div class="delivery-toggle-title">Home Delivery</div>
                                        <div class="delivery-toggle-desc">Courier straight to your door</div>
                                    </div>
                                    <div class="delivery-toggle-check"><i class="ti ti-check"></i></div>
                                </label>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Full Name</label>
                                    <input type="text" name="full_name" id="field-full_name" class="checkout-input" placeholder="John Doe" value="{{ session('checkout_details.full_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Email Address</label>
                                    <input type="email" name="email" id="field-email" class="checkout-input" placeholder="john@example.com" value="{{ session('checkout_details.email') }}" required>
                                </div>
                            </div>

                            <div id="school-address-display" class="school-address-card" style="display: none;">
                                <div class="school-address-header">
                                    <i class="ti ti-building-community"></i>
                                    <span>School Delivery Point</span>
                                    <span class="school-address-free-badge">FREE</span>
                                </div>
                                <div class="school-address-body">
                                    <div class="school-address-name">{{ $primarySchool->school_name ?? 'Authorized School Center' }}</div>
                                    <div class="school-address-details">
                                        {{ $primarySchool->address ?? 'Address will be updated based on school selection.' }}<br>
                                        {{ $primarySchool->city ?? '' }}, {{ $primarySchool->state ?? '' }} - {{ $primarySchool->pincode ?? '' }}
                                    </div>
                                    <div class="school-address-phone">
                                        <i class="ti ti-phone"></i> {{ $primarySchool->phone ?? 'Contact available at school' }}
                                    </div>
                                </div>
                                <input type="hidden" name="city" id="field-city" value="{{ $primarySchool->city ?? '' }}">
                                <input type="hidden" name="address" id="field-address" value="{{ $primarySchool->address ?? '' }}">
                                <input type="hidden" name="phone" id="field-phone" value="{{ $primarySchool->phone ?? '' }}">
                            </div>

                            <div class="row g-3" id="home-address-fields">
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Phone Number</label>
                                    <input type="text" name="phone" id="field-phone-home" class="checkout-input" placeholder="+91 00000-00000" value="{{ session('checkout_details.phone') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-field-label">City</label>
                                    <input type="text" name="city" id="field-city-home" class="checkout-input" placeholder="Mumbai" value="{{ session('checkout_details.city') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="checkout-field-label">Detailed Address</label>
                                    <textarea name="address" id="field-address-home" class="checkout-input" rows="3" placeholder="Street, Apartment, Area..." required>{{ session('checkout_details.address') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-panel">
                        <div class="checkout-panel-header">
                            <div class="checkout-panel-icon"><i class="ti-credit-card"></i></div>
                            <div>
                                <h5 class="checkout-panel-title">Payment Method</h5>
                                <p class="checkout-panel-subtitle">Choose how you'd like to pay</p>
                            </div>
                        </div>

                        <div class="checkout-panel-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="payment-option {{ (session('checkout_details.payment_method') ?? 'cod') === 'cod' ? 'is-selected' : '' }}" id="pay-cod">
                                        <input type="radio" name="payment_method" value="cod" class="payment-radio" {{ (session('checkout_details.payment_method') ?? 'cod') === 'cod' ? 'checked' : '' }}>
                                        <div class="payment-option-icon"><i class="ti-truck"></i></div>
                                        <div class="payment-option-title">Cash on Delivery</div>
                                        <div class="payment-option-check"><i class="ti ti-check"></i></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="checkout-summary-panel sticky-top" style="top: 100px;">
                        <h5 class="checkout-summary-title">Order Summary</h5>
                        <div class="checkout-summary-items">
                            @foreach($cartItems as $item)
                                <div class="checkout-summary-item">
                                    <div class="checkout-summary-item-img">
                                        <img src="{{ $item->product->firstImage() }}" alt="{{ $item->product->product_name }}">
                                        <span class="checkout-summary-item-qty">{{ $item->quantity }}</span>
                                    </div>
                                    <div class="checkout-summary-item-info">
                                        <div class="checkout-summary-item-name">{{ $item->product->product_name }}</div>
                                        <div class="checkout-summary-item-variant">{{ $item->variant->display_name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="checkout-summary-item-price">
                                        ₹{{ number_format($item->quantity * $item->unit_price, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="checkout-summary-divider"></div>
                        <div class="checkout-summary-row">
                            <span class="checkout-summary-label">Subtotal</span>
                            <span class="checkout-summary-value">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="checkout-summary-row">
                            <span class="checkout-summary-label">Shipping</span>
                            <span class="checkout-summary-value checkout-summary-free">Free</span>
                        </div>
                        <div class="checkout-summary-total-row">
                            <span class="checkout-summary-total-label">Total</span>
                            <span class="checkout-summary-total-value">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <button type="submit" class="btn-place-order">
                            <i class="ti ti-chevron-right me-2"></i> Continue to Review
                        </button>
                        <div class="checkout-secure-note">
                            <i class="ti ti-shield-check"></i> Your information is protected with secure encryption
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- STEP 2: Confirmation Step (Hidden by default) --}}
    <div id="wizard-confirmation-step" style="display: none;">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="review-panel mb-4">
                    <div class="review-panel-header">
                        <div class="review-panel-icon"><i class="ti ti-shopping-cart"></i></div>
                        <h5 class="review-panel-title">Order Items</h5>
                    </div>
                    <div class="review-panel-body">
                        <div class="review-items-list" id="confirm-items-list">
                            <!-- Populated by JS -->
                        </div>
                    </div>
                </div>

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
                                    <span class="review-detail-value" id="conf-name">-</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Phone:</span>
                                    <span class="review-detail-value" id="conf-phone">-</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Address:</span>
                                    <span class="review-detail-value" id="conf-address">-</span>
                                </div>
                                <div class="review-detail-row">
                                    <span class="review-detail-label">City:</span>
                                    <span class="review-detail-value" id="conf-city">-</span>
                                </div>
                                <div class="review-detail-badge" id="conf-delivery-badge">-</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="review-panel">
                            <div class="review-panel-header">
                                <div class="review-panel-icon"><i class="ti ti-credit-card"></i></div>
                                <h5 class="review-panel-title">Payment</h5>
                            </div>
                            <div class="review-panel-body">
                                <div class="review-detail-row">
                                    <span class="review-detail-label">Method:</span>
                                    <span class="review-detail-value fw-bold text-uppercase" id="conf-payment">-</span>
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
                    <button id="btn-back-to-checkout" class="btn-back-to-checkout" style="border:none; background:none; cursor:pointer;">
                        <i class="ti ti-arrow-left me-2"></i> Edit Details
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="review-summary-panel sticky-top" style="top: 100px;">
                    <h5 class="review-summary-title">Final Total</h5>
                    <div class="review-summary-row">
                        <span>Subtotal</span>
                        <span id="conf-subtotal">₹0.00</span>
                    </div>
                    <div class="review-summary-row">
                        <span>Shipping</span>
                        <span id="conf-shipping">Free</span>
                    </div>
                    <div class="review-summary-divider"></div>
                    <div class="review-summary-total-row">
                        <span>Total Amount</span>
                        <span class="review-summary-total-value" id="conf-total">₹0.00</span>
                    </div>
                    <button id="btn-place-order" class="btn-confirm-order">
                        <i class="ti ti-check me-2"></i> Confirm & Place Order
                    </button>
                    <p class="review-secure-text">
                        <i class="ti ti-shield-check"></i> Secure encrypted transaction
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- STEP 3: Success Step (Hidden by default) --}}
    <div id="wizard-success-step" style="display: none;" class="text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="success-card">
                    <div class="success-icon">
                        <i class="ti ti-circle-check"></i>
                    </div>
                    <h2 class="fw-extrabold text-dark mb-3">Thank You for Your Order!</h2>
                    <p class="text-muted mb-4">
                        Your uniform order has been placed successfully. We've sent a confirmation email to your registered address.
                    </p>
                    <div class="success-details-box">
                        <div class="success-detail">
                            <span class="detail-label">Order Status:</span>
                            <span class="detail-value badge bg-success-subtle text-success">Processing</span>
                        </div>
                    </div>
                    <div class="d-flex gap-3 justify-content-center mt-5">
                        <a href="{{ route('website.shop') }}" class="btn-success-primary">
                            <i class="ti ti-shopping-cart me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Progress Steps */
.checkout-steps {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 480px;
    margin: 0 auto;
}
.checkout-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}
.checkout-step span { font-size: 12.5px; font-weight: 700; color: #9CA3AF; }
.checkout-step.is-active span, .checkout-step.is-done span { color: #111827; }
.checkout-step-circle {
    width: 34px; height: 34px; border-radius: 50%; background: #F1F3F6; color: #9CA3AF;
    display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 800;
}
.checkout-step.is-active .checkout-step-circle { background: #1E3A8A; color: #fff; }
.checkout-step.is-done .checkout-step-circle { background: #059669; color: #fff; }
.checkout-step-line {
    height: 2px; flex: 1; background: #F1F3F6; margin: 0 12px; margin-bottom: 24px;
}
.checkout-step-line.is-done { background: #059669; }

/* Panels */
.checkout-panel {
    background: #fff; border-radius: 16px; border: 1px solid #EDEFF3;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03); overflow: hidden;
}
.checkout-panel-header {
    display: flex; align-items: center; gap: 14px; padding: 24px 28px; border-bottom: 1px solid #F1F3F6;
}
.checkout-panel-icon {
    width: 42px; height: 42px; border-radius: 12px; background: #EEF2FF; color: #1E3A8A;
    display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
}
.checkout-panel-title { font-size: 1.02rem; font-weight: 800; color: #111827; margin: 0; }
.checkout-panel-subtitle { font-size: 12.5px; color: #9CA3AF; margin: 2px 0 0; }
.checkout-panel-body { padding: 28px; }

/* Delivery Toggle */
.delivery-toggle-group { display: flex; gap: 14px; flex-wrap: wrap; }
.delivery-toggle-option {
    flex: 1; min-width: 220px; display: flex; align-items: center; gap: 14px; padding: 16px 18px;
    border: 1.5px solid #E5E7EB; border-radius: 12px; cursor: pointer; position: relative; transition: all .18s ease;
}
.delivery-toggle-option:hover { border-color: #C7D2FE; }
.delivery-toggle-option.is-selected { border-color: #1E3A8A; background: #F5F7FF; }
.delivery-toggle-icon {
    width: 40px; height: 40px; border-radius: 10px; background: #F1F3F6; color: #6B7280;
    display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; transition: all .18s ease;
}
.delivery-toggle-option.is-selected .delivery-toggle-icon { background: #1E3A8A; color: #fff; }
.delivery-toggle-title { font-size: 14px; font-weight: 700; color: #111827; }
.delivery-toggle-desc { font-size: 12px; color: #9CA3AF; margin-top: 1px; }
.delivery-toggle-check {
    position: absolute; top: 12px; right: 12px; width: 20px; height: 20px; border-radius: 50%;
    background: #1E3A8A; color: #fff; display: none; align-items: center; justify-content: center; font-size: 11px;
}
.delivery-toggle-option.is-selected .delivery-toggle-check { display: flex; }

/* Form Fields */
.checkout-field-label { font-size: 12.5px; font-weight: 700; color: #374151; margin-bottom: 6px; display: block; }
.checkout-input {
    width: 100%; border: 1.5px solid #E5E7EB; border-radius: 10px; padding: 11px 14px;
    font-size: 14px; color: #111827; transition: border-color .15s ease, box-shadow .15s ease; background: #fff;
}
.checkout-input:focus { outline: none; border-color: #1E3A8A; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1); }
.checkout-input::placeholder { color: #B0B5BE; }

/* School Address Card */
.school-address-card {
    border: 1.5px solid #E0E7FF; background: #F5F7FF; border-radius: 12px; padding: 18px 20px; margin-bottom: 16px;
}
.school-address-header {
    display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 13.5px; color: #1E3A8A; margin-bottom: 12px;
}
.school-address-free-badge {
    margin-left: auto; background: #DCFCE7; color: #059669; font-size: 10.5px; font-weight: 800; padding: 3px 9px; border-radius: 20px;
}
.school-address-body { padding-left: 26px; }
.school-address-name { font-weight: 700; font-size: 14px; color: #111827; margin-bottom: 4px; }
.school-address-details { font-size: 12.5px; color: #6B7280; line-height: 1.5; }
.school-address-phone { font-size: 12.5px; color: #6B7280; margin-top: 8px; display: flex; align-items: center; gap: 5px; }

/* Payment Options */
.payment-option {
    display: flex; flex-direction: column; align-items: center; text-align: center; gap: 8px; padding: 22px 14px;
    border: 1.5px solid #E5E7EB; border-radius: 14px; cursor: pointer; position: relative; transition: all .18s ease;
}
.payment-option:hover { border-color: #C7D2FE; }
.payment-option.is-selected { border-color: #1E3A8A; background: #F5F7FF; }
.payment-radio { position: absolute; opacity: 0; width: 0; height: 0; }
.payment-option-icon {
    width: 46px; height: 46px; border-radius: 12px; background: #F1F3F6; color: #6B7280;
    display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all .18s ease;
}
.payment-option.is-selected .payment-option-icon { background: #1E3A8A; color: #fff; }
.payment-option-title { font-size: 13.5px; font-weight: 700; color: #111827; }
.payment-option-check {
    position: absolute; top: 10px; right: 10px; width: 20px; height: 20px; border-radius: 50%;
    background: #1E3A8A; color: #fff; display: none; align-items: center; justify-content: center; font-size: 11px;
}
.payment-option.is-selected .payment-option-check { display: flex; }

/* Order Summary */
.checkout-summary-panel {
    background: #fff; border-radius: 16px; border: 1px solid #EDEFF3;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03); padding: 28px;
}
.checkout-summary-title { font-size: 1.05rem; font-weight: 800; color: #111827; margin-bottom: 20px; }
.checkout-summary-items {
    max-height: 320px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px; padding-right: 4px;
}
.checkout-summary-items::-webkit-scrollbar { width: 4px; }
.checkout-summary-items::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
.checkout-summary-item { display: flex; align-items: center; gap: 12px; }
.checkout-summary-item-img {
    position: relative; width: 52px; height: 52px; flex-shrink: 0; border-radius: 10px; overflow: hidden;
    background: #F5F5F7; border: 1px solid #EEF0F3;
}
.checkout-summary-item-img img { width: 100%; height: 100%; object-fit: cover; }
.checkout-summary-item-qty {
    position: absolute; top: -6px; right: -6px; background: #1E3A8A; color: #fff; font-size: 10px;
    font-weight: 800; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center;
    justify-content: center; border: 2px solid #fff;
}
.checkout-summary-item-info { flex: 1; min-width: 0; }
.checkout-summary-item-name { font-size: 13px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.checkout-summary-item-variant { font-size: 11.5px; color: #9CA3AF; margin-top: 2px; }
.checkout-summary-item-price { font-size: 13px; font-weight: 700; color: #111827; flex-shrink: 0; }
.checkout-summary-divider { border-top: 1px dashed #E5E7EB; margin: 20px 0; }
.checkout-summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; }
.checkout-summary-label { font-size: 13.5px; color: #6B7280; }
.checkout-summary-value { font-size: 13.5px; font-weight: 700; color: #111827; }
.checkout-summary-free { color: #059669; }
.checkout-summary-total-row {
    display: flex; justify-content: space-between; align-items: center; padding-top: 16px; margin-top: 4px; margin-bottom: 22px; border-top: 1px solid #F1F3F6;
}
.checkout-summary-total-label { font-size: 15px; font-weight: 800; color: #111827; }
.checkout-summary-total-value { font-size: 1.35rem; font-weight: 800; color: #1E3A8A; }
.btn-place-order {
    width: 100%; display: flex; align-items: center; justify-content: center; background: #1E3A8A;
    color: #fff; border: none; font-weight: 700; font-size: 14.5px; padding: 15px; border-radius: 10px;
    cursor: pointer; transition: background .2s ease;
}
.btn-place-order:hover { background: #16296b; }
.checkout-secure-note {
    display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 11.5px; color: #9CA3AF; margin-top: 16px; text-align: center;
}
.checkout-secure-note i { color: #059669; }

/* Review Panel Styles */
.review-panel {
    background: #fff; border-radius: 16px; border: 1px solid #EDEFF3;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03); overflow: hidden; margin-bottom: 24px;
}
.review-panel-header {
    display: flex; align-items: center; gap: 12px; padding: 20px 24px; border-bottom: 1px solid #F1F3F6; background: #fcfcfc;
}
.review-panel-icon {
    width: 36px; height: 36px; border-radius: 8px; background: #EEF2FF; color: #1E3A8A;
    display: flex; align-items: center; justify-content: center; font-size: 16px;
}
.review-panel-title { font-size: 1rem; font-weight: 800; color: #111827; margin: 0; }
.review-panel-body { padding: 24px; }
.review-items-list { display: flex; flex-direction: column; gap: 12px; }
.review-item {
    display: flex; align-items: center; gap: 16px; padding: 12px; border-radius: 12px; border: 1px solid #F1F3F6;
}
.review-item-img { width: 50px; height: 50px; border-radius: 8px; overflow: hidden; background: #F5F5F7; }
.review-item-img img { width: 100%; height: 100%; object-fit: cover; }
.review-item-info { flex: 1; }
.review-item-name { font-size: 14px; font-weight: 700; color: #111827; }
.review-item-variant { font-size: 12px; color: #6B7280; }
.review-item-price { font-size: 14px; font-weight: 700; color: #111827; }
.review-detail-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13.5px; }
.review-detail-label { color: #6B7280; }
.review-detail-value { color: #111827; font-weight: 600; }
.review-detail-badge {
    margin-top: 16px; display: inline-block; padding: 4px 12px; border-radius: 20px;
    font-size: 11px; font-weight: 800; text-transform: uppercase;
}
.badge-school { background: #DCFCE7; color: #059669; }
.badge-home { background: #FEE2E2; color: #B91C1C; }
.btn-back-to-checkout {
    display: inline-flex; align-items: center; color: #6B7280; text-decoration: none; font-size: 13px; font-weight: 600; transition: color 0.2s;
}
.btn-back-to-checkout:hover { color: #1E3A8A; }
.review-summary-panel {
    background: #fff; border-radius: 16px; border: 1px solid #EDEFF3;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); padding: 28px;
}
.review-summary-title { font-size: 1.1rem; font-weight: 800; color: #111827; margin-bottom: 24px; }
.review-summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; color: #6B7280; }
.review-summary-divider { border-top: 1px solid #F1F3F6; margin: 20px 0; }
.review-summary-total-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.review-summary-total-value { font-size: 1.5rem; font-weight: 800; color: #1E3A8A; }
.btn-confirm-order {
    width: 100%; display: flex; align-items: center; justify-content: center; background: #1E3A8A;
    color: #fff; border: none; font-weight: 700; font-size: 15px; padding: 16px; border-radius: 12px;
    cursor: pointer; transition: all 0.2s;
}
.btn-confirm-order:hover { background: #16296b; }
.review-secure-text {
    display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 11px; color: #9CA3AF; margin-top: 16px; text-align: center;
}
.review-secure-text i { color: #059669; }

/* Success Card */
.success-card {
    background: #fff; border-radius: 24px; padding: 60px 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    border: 1px solid #EDEFF3;
}
.success-icon {
    width: 80px; height: 80px; background: #DCFCE7; color: #059669; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 24px;
}
.success-details-box {
    background: #F8FAFC; border-radius: 16px; padding: 20px; border: 1px solid #E2E8F0; display: inline-block; min-width: 300px;
}
.success-detail { display: flex; justify-content: space-between; align-items: center; gap: 20px; font-size: 14px; }
.detail-label { color: #6B7280; font-weight: 600; }
.detail-value { font-weight: 700; }
.btn-success-primary {
    background: #1E3A8A; color: #fff; padding: 12px 24px; border-radius: 10px; text-decoration: none;
    font-weight: 700; font-size: 14px; transition: background 0.2s;
}
.btn-success-primary:hover { background: #16296b; color: #fff; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentState = "{{ $currentState }}";
        const cartItems = @json($cartItems);
        const subtotal = {{ $subtotal }};
        
        // Step Management
        function updateWizardStep(step) {
            // Reset all
            document.getElementById('wizard-checkout-step').style.display = 'none';
            document.getElementById('wizard-confirmation-step').style.display = 'none';
            document.getElementById('wizard-success-step').style.display = 'none';
            
            document.getElementById('step-checkout').classList.remove('is-active');
            document.getElementById('step-confirmation').classList.remove('is-active');
            document.getElementById('line-checkout').classList.remove('is-done');

            if (step === 'checkout') {
                document.getElementById('wizard-checkout-step').style.display = 'block';
                document.getElementById('step-checkout').classList.add('is-active');
            } else if (step === 'confirmation') {
                document.getElementById('wizard-confirmation-step').style.display = 'block';
                document.getElementById('step-confirmation').classList.add('is-active');
                document.getElementById('step-checkout').classList.add('is-done');
                document.getElementById('line-checkout').classList.add('is-done');
                populateConfirmation();
            } else if (step === 'success') {
                document.getElementById('wizard-success-step').style.display = 'block';
                document.getElementById('step-confirmation').classList.add('is-done');
                document.getElementById('line-checkout').classList.add('is-done');
            }
        }

        function populateConfirmation() {
            const details = window.currentCheckoutDetails || @json(session('checkout_details'));
            
            if (details) {
                document.getElementById('conf-name').innerText = details.full_name || '-';
                document.getElementById('conf-phone').innerText = details.phone || '-';
                document.getElementById('conf-address').innerText = details.address || '-';
                document.getElementById('conf-city').innerText = details.city || '-';
                document.getElementById('conf-payment').innerText = (details.payment_method || 'cod').replace('_', ' ');
                
                const badge = document.getElementById('conf-delivery-badge');
                const deliveryType = details.delivery_type || 'school';
                badge.innerText = deliveryType === 'school' ? 'School Delivery' : 'Home Delivery';
                badge.className = 'review-detail-badge ' + (deliveryType === 'school' ? 'badge-school' : 'badge-home');
                
                const shipping = deliveryType === 'home' ? 8.00 : 0;
                document.getElementById('conf-shipping').innerText = shipping === 0 ? 'Free' : '₹' + shipping.toFixed(2);
                document.getElementById('conf-subtotal').innerText = '₹' + subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2 });
                document.getElementById('conf-total').innerText = '₹' + (subtotal + shipping).toLocaleString('en-IN', { minimumFractionDigits: 2 });
            }

            const itemsList = document.getElementById('confirm-items-list');
            itemsList.innerHTML = '';
            cartItems.forEach(item => {
                const imgUrl = item.product.first_image || (item.product.firstImage ? item.product.firstImage() : '/assets/images/no_image.jpg');
                itemsList.innerHTML += `
                    <div class="review-item">
                        <div class="review-item-img">
                            <img src="${imgUrl}" alt="${item.product.product_name}">
                        </div>
                        <div class="review-item-info">
                            <div class="review-item-name">${item.product.product_name}</div>
                            <div class="review-item-variant">${item.variant ? item.variant.display_name : 'N/A'}</div>
                        </div>
                        <div class="review-item-price">
                            ₹${(item.quantity * item.unit_price).toLocaleString('en-IN', { minimumFractionDigits: 2 })}
                        </div>
                    </div>
                `;
            });
        }

        // Initial state
        if (currentState === 'confirmation') {
            // We need the details to populate. We can either pass them from Laravel or fetch them via AJAX.
            // Since they are in session, we can pass them to JS
            window.currentCheckoutDetails = @json(session('checkout_details'));
            updateWizardStep('confirmation');
        } else {
            updateWizardStep('checkout');
        }

        // 1. Payment Method Logic
        const paymentOptions = document.querySelectorAll('.payment-option');
        paymentOptions.forEach(opt => {
            opt.addEventListener('click', function() {
                paymentOptions.forEach(o => o.classList.remove('is-selected'));
                this.classList.add('is-selected');
                this.querySelector('input').checked = true;
            });
        });

        // 2. Dynamic Address Logic
        const radioSchool = document.getElementById('delivery_school');
        const radioHome = document.getElementById('delivery_home');
        const deliverySchoolContainer = document.getElementById('deliv-school-container');
        const deliveryHomeContainer = document.getElementById('deliv-home-container');

        function toggleAddress(isSchool) {
            const schoolDisplay = document.getElementById('school-address-display');
            const homeFields = document.getElementById('home-address-fields');
            const homeInputs = homeFields.querySelectorAll('input, textarea');

            if (isSchool) {
                schoolDisplay.style.display = 'block';
                homeFields.style.display = 'none';
                homeInputs.forEach(input => input.required = false);
                deliverySchoolContainer.classList.add('is-selected');
                deliveryHomeContainer.classList.remove('is-selected');
            } else {
                schoolDisplay.style.display = 'none';
                homeFields.style.display = 'flex';
                homeInputs.forEach(input => input.required = true);
                deliverySchoolContainer.classList.remove('is-selected');
                deliveryHomeContainer.classList.add('is-selected');
            }
        }

        radioSchool.addEventListener('change', () => toggleAddress(true));
        radioHome.addEventListener('change', () => toggleAddress(false));
        deliverySchoolContainer.addEventListener('click', () => { radioSchool.checked = true; toggleAddress(true); });
        deliveryHomeContainer.addEventListener('click', () => { radioHome.checked = true; toggleAddress(false); });

        // Initialize address toggle
        toggleAddress(radioSchool.checked);

        // Handle Form Submission (Step 1 -> Step 2)
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            // Basic validation check before AJAX
            if (!this.checkValidity()) {
                this.reportValidity();
                return;
            }

            const btn = this.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="ti ti-loader-2 spin"></i> Saving...';

            $.ajax({
                url: "{{ route('website.checkout.save') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.currentCheckoutDetails = response.details;
                    updateWizardStep('confirmation');
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Please check your details.'));
                },
                complete: function() {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ti ti-chevron-right me-2"></i> Continue to Review';
                }
            });
        });

        // Handle Confirmation Submit (Step 2 -> Step 3)
        document.getElementById('btn-place-order').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="ti ti-loader-2 spin"></i> Placing Order...';

            $.ajax({
                url: "{{ route('website.order.store') }}",
                method: 'POST',
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    updateWizardStep('success');
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message || 'An error occurred.'));
                },
                complete: function() {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ti ti-check me-2"></i> Confirm & Place Order';
                }
            });
        });

        // Back Button
        document.getElementById('btn-back-to-checkout').addEventListener('click', function() {
            updateWizardStep('checkout');
        });
    });
</script>
@endsection
