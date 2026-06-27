@extends('website.components.common')


@section('content')
    <!-- Page Header (Full Width Banner with Background Image) -->
    <div class="geo-page-header" style="background-image: url('https://images.unsplash.com/photo-1589756823855-edd13437c56e?auto=format&fit=crop&q=80&w=1200');">
      <div class="container">
        <h1 class="display-6 fw-extrabold text-white mb-2">Secure Checkout</h1>
        <ul class="geo-breadcrumb mb-0">
          <li><a href="index.html">Home</a></li>
          <li>&bull;</li>
          <li><a href="cart.html">Basket</a></li>
          <li>&bull;</li>
          <li class="active-item">Secure Checkout</li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <main class="container py-5">
      
      <div class="row g-4">
        
        <!-- Forms columns (Left Col - 7 cols) -->
        <div class="col-lg-7">
          <form id="checkout-form">
            
            <!-- Step 1: Contact & Shipping -->
            <div class="card-geo p-4 mb-4">
              <h4 class="fw-bold mb-4 text-dark" style="font-size: 16px;"><span class="badge-geo me-2" style="background: var(--qu-primary); color: #FFF; width: 22px; height: 22px; padding:0; display: inline-flex; align-items:center; justify-content:center; border-radius:50%;">1</span>Contact & Shipping</h4>
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="chk-name" class="form-label small fw-semibold">Contact Full Name</label>
                  <input type="text" id="chk-name" class="form-control" placeholder="Sarah Jenkins" required />
                </div>
                <div class="col-md-6">
                  <label for="chk-email" class="form-label small fw-semibold">Email Address (Order Receipt)</label>
                  <input type="email" id="chk-email" class="form-control" placeholder="sarah@example.com" required />
                </div>
                <div class="col-md-6">
                  <label for="chk-phone" class="form-label small fw-semibold">Mobile Phone (Delivery SMS)</label>
                  <input type="tel" id="chk-phone" class="form-control" placeholder="+1 (555) 019-2831" required />
                </div>
                <div class="col-md-6">
                  <label for="chk-district" class="form-label small fw-semibold">School District Area</label>
                  <select id="chk-district" class="form-select" required>
                    <option value="" disabled selected>Select District...</option>
                    <option value="st-marys">Delhi NCR (Dwarka)</option>
                    <option value="oakwood">Kolkata (Park Street)</option>
                    <option value="crestview">New Delhi (Lajpat Nagar)</option>
                    <option value="pinecrest">Pune (Cantonment)</option>
                  </select>
                </div>
                <div class="col-12">
                  <label for="chk-address" class="form-label small fw-semibold">Delivery Street Address</label>
                  <input type="text" id="chk-address" class="form-control" placeholder="782 Maple Avenue" required />
                </div>
                <div class="col-md-6">
                  <label for="chk-city" class="form-label small fw-semibold">City</label>
                  <input type="text" id="chk-city" class="form-control" placeholder="Metro Heights" required />
                </div>
                <div class="col-md-6">
                  <label for="chk-zip" class="form-label small fw-semibold">ZIP Code</label>
                  <input type="text" id="chk-zip" class="form-control" placeholder="10012" required />
                </div>
              </div>
            </div>

            <!-- Step 2: Payment Simulation -->
            <div class="card-geo p-4">
              <h4 class="fw-bold mb-4 text-dark" style="font-size: 16px;"><span class="badge-geo me-2" style="background: var(--qu-primary); color: #FFF; width: 22px; height: 22px; padding:0; display: inline-flex; align-items:center; justify-content:center; border-radius:50%;">2</span>Simulated Billing Payment</h4>
              
              <div class="row g-3">
                <div class="col-12">
                  <label for="chk-card-name" class="form-label small fw-semibold">Name on Card</label>
                  <input type="text" id="chk-card-name" class="form-control" placeholder="Sarah Jenkins" required />
                </div>
                <div class="col-12">
                  <label for="chk-card-num" class="form-label small fw-semibold">Card Number (Simulated)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></span>
                    <input type="text" id="chk-card-num" class="form-control border-start-0" placeholder="4111 2222 3333 4444" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="chk-card-expiry" class="form-label small fw-semibold">Expiry Date</label>
                  <input type="text" id="chk-card-expiry" class="form-control" placeholder="12 / 28" required />
                </div>
                <div class="col-md-6">
                  <label for="chk-card-cvv" class="form-label small fw-semibold">CVV Code</label>
                  <input type="password" id="chk-card-cvv" class="form-control" placeholder="&bull;&bull;&bull;" maxlength="3" required />
                </div>
              </div>

              <div class="alert alert-info small mt-4 mb-0" style="border-radius: var(--qu-radius-sm);">
                🔐 <strong>Secure Sandbox Mode:</strong> This page is integrated into our secure staging environment. No actual funds will be drafted.
              </div>
            </div>

            <!-- Checkout Button -->
            <button type="submit" class="btn btn-primary w-100 py-3 mt-4">Place Official Uniform Order &rarr;</button>

          </form>
        </div>

        <!-- Order summary (Right Col - 5 cols) -->
        <div class="col-lg-5">
          <div class="card-geo p-4" style="position: sticky; top: 100px;">
            <h4 class="fw-bold mb-4 text-dark" style="font-size: 16px; border-bottom: 1px solid var(--qu-border-color); pb-3;">Order Verification</h4>
            
            <!-- Items summary container -->
            <div id="checkout-items-summary" class="mb-4">
              <!-- Injected dynamically via JS -->
            </div>

            <hr>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Garment Base Cost</span>
              <span class="fw-bold text-dark" id="checkout-base-cost">$0.00</span>
            </div>
            
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Standard Campus Delivery</span>
              <span class="text-success fw-bold">FREE</span>
            </div>

            <div class="d-flex justify-content-between mb-4 pt-3 border-top">
              <span class="fw-bold text-dark fs-6">Ultimate Charge Total</span>
              <span id="checkout-final-total" class="fw-bold text-primary fs-5" style="font-family: var(--font-display);">$0.00</span>
            </div>

            <div style="background: var(--qu-badge-bg); color: var(--qu-primary); font-size: 11px; padding: 12px; border-radius: var(--qu-radius-sm); font-weight: 600;" class="text-center">
              🏫 Official Delivery: Deliveries are dropped directly at the partner school's central administrative fitting office every Tuesday. Pickup is free of charge.
            </div>
          </div>
        </div>

      </div>

    </main>
@endsection