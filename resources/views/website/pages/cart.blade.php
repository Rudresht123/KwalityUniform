@extends('website.components.common')

@section('content')
  

    <!-- Page Header (Full Width Banner with Background Image) -->
    <div class="geo-page-header" style="background-image: url('https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&q=80&w=1200');">
      <div class="container">
        <h1 class="display-6 fw-extrabold text-white mb-2">Your Shopping Basket</h1>
        <ul class="geo-breadcrumb mb-0">
          <li><a href="index.html">Home</a></li>
          <li>&bull;</li>
          <li class="active-item">Your Shopping Basket</li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <main class="container py-5">
      
      <!-- EMPTY STATE -->
      <div id="cart-empty-state" class="text-center py-5 card-geo" style="display: none;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="1.5" class="mb-3"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
        <h4 class="fw-bold">Your basket is currently empty</h4>
        <p class="text-muted small">Access an authorized portal or explore everyday essentials to populate your cart.</p>
        <a href="shop.html" class="btn btn-primary btn-sm rounded-pill mt-3 px-4">Browse Uniform Catalogue</a>
      </div>

      <!-- FULL STATE -->
      <div id="cart-full-state" class="row g-4" style="display: none;">
        
        <!-- Cart Items list (Left Col - 8 cols) -->
        <div class="col-lg-8">
          
          <!-- Free Delivery Progress Meter -->
          <div class="card-geo p-4 mb-4" id="delivery-meter-card" style="border-left: 4px solid var(--qu-primary);">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="fw-bold text-dark d-flex align-items-center gap-2" id="delivery-status-text" style="font-size: 14px;">
                <span>🚚</span> <span id="delivery-status-message">Add <strong class="text-primary" id="delivery-needed-amount">$0.00</strong> more for <strong>FREE Home Delivery</strong></span>
              </span>
              <span class="badge bg-primary text-white rounded-pill px-2 py-1" id="delivery-percent-text" style="font-size: 11px;">0%</span>
            </div>
            <div class="progress" style="height: 8px; border-radius: 10px; background-color: #E5E7EB; overflow: hidden;">
              <div class="progress-bar progress-bar-striped progress-bar-animated" id="delivery-progress-bar" role="progressbar" style="width: 0%; background-color: var(--qu-primary); transition: width 0.4s ease;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="text-muted small mb-0 mt-2.5" style="font-size: 11px; line-height: 1.4;">
              🎒 <strong>Deliver to School Desk:</strong> Standard deliveries directly to your school's official pick-up counter are always <strong>100% FREE</strong> with no order minimum!
            </p>
          </div>

          <!-- Desktop Table (Hidden on Mobile) -->
          <div class="card-geo p-0 d-none d-md-block overflow-hidden mb-4">
            <table class="table-geo mb-0">
              <thead>
                <tr>
                  <th style="width: 48%;">Uniform Garment</th>
                  <th style="width: 15%;">Price</th>
                  <th style="width: 18%;">Quantity</th>
                  <th style="width: 14%;">Total</th>
                  <th style="width: 5%;"></th>
                </tr>
              </thead>
              <tbody id="cart-table-body">
                <!-- Injected dynamically via assets/js/app.js -->
              </tbody>
            </table>
          </div>

          <!-- Mobile Cards List (Hidden on Desktop) -->
          <div id="cart-mobile-list" class="d-flex d-md-none flex-column gap-3 mb-4">
            <!-- Injected dynamically via assets/js/app.js -->
          </div>

          <!-- Empty Cart Action Row -->
          <div class="d-flex justify-content-between align-items-center">
            <a href="shop.html" class="btn btn-outline-secondary btn-sm px-4 rounded-pill fw-semibold">
              &larr; Return to Sizing Catalogue
            </a>
            <button class="btn btn-link text-muted text-decoration-none small p-0" id="clear-basket-btn" onclick="if(confirm('Are you sure you want to clear your shopping basket?')) { State.clearCart(); State.initCart(); State.showToast('Your shopping basket has been cleared.'); }">
              Clear Shopping Basket
            </button>
          </div>

        </div>

        <!-- Summary & Totals Panel (Right Col - 4 cols) -->
        <div class="col-lg-4">
          <div class="card-geo p-4" style="position: sticky; top: 100px;">
            <h4 class="fw-bold mb-3 pb-2 text-dark" style="font-size: 18px; border-bottom: 2px solid var(--qu-primary);">Order Summary</h4>
            
            <!-- Delivery Options Radio List -->
            <div class="mb-4">
              <label class="fw-bold text-dark small mb-2 d-block">Select Distribution Method:</label>
              <div class="d-flex flex-column gap-2">
                
                <!-- Deliver to School Option -->
                <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer" id="deliv-school-container" style="border: 2px solid var(--qu-primary) !important; background-color: rgba(30, 58, 138, 0.02); transition: all 0.2s ease;">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="radio" name="delivery-option" id="deliv-school" value="school" checked style="cursor: pointer;">
                    <label class="form-check-label ms-2 cursor-pointer" for="deliv-school" style="user-select: none;">
                      <span class="fw-bold text-dark small d-block" style="line-height: 1.2;">Deliver to School Desk</span>
                      <span class="text-secondary" style="font-size: 11px;">Official academic pick-up desk</span>
                    </label>
                  </div>
                  <span class="text-success fw-bold small">FREE</span>
                </div>

                <!-- Deliver to Home Option -->
                <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer" id="deliv-home-container" style="border: 1px solid var(--qu-border-color); transition: all 0.2s ease;">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="radio" name="delivery-option" id="deliv-home" value="home" style="cursor: pointer;">
                    <label class="form-check-label ms-2 cursor-pointer" for="deliv-home" style="user-select: none;">
                      <span class="fw-bold text-dark small d-block" style="line-height: 1.2;">Courier Home Delivery</span>
                      <span class="text-secondary" style="font-size: 11px;">Direct residential courier dispatch</span>
                    </label>
                  </div>
                  <span class="text-dark fw-bold small" id="home-delivery-fee-badge">$8.00</span>
                </div>

              </div>
            </div>

            <!-- Optional Premium Add-ons -->
            <div class="mb-4 pt-3 border-top">
              <label class="fw-bold text-dark small mb-2 d-block">Sizing & Presentation Add-ons:</label>
              
              <div class="p-2.5 border rounded mb-2" style="background-color: var(--qu-bg-light); border-color: var(--qu-border-color);">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" id="addon-wrap" style="cursor: pointer;">
                  <label class="form-check-label small text-dark cursor-pointer ms-1 fw-medium" for="addon-wrap" style="font-size: 12px; user-select: none;">
                    🎁 Premium Gold-Foil Gift Box (+$5.00)
                  </label>
                </div>
              </div>

              <div class="p-2.5 border rounded" style="background-color: var(--qu-bg-light); border-color: var(--qu-border-color);">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" id="addon-labels" style="cursor: pointer;">
                  <label class="form-check-label small text-dark cursor-pointer ms-1 fw-medium" for="addon-labels" style="font-size: 12px; user-select: none;">
                    🏷️ Iron-On Laundry Name Labels (+$3.50)
                  </label>
                </div>
              </div>
            </div>

            <!-- Interactive Promo Code Section -->
            <div class="mb-4 pt-3 border-top">
              <label class="form-label small fw-bold text-dark mb-1 d-block">Coupons & Promo Codes</label>
              <div class="input-group">
                <input type="text" id="promo-input" class="form-control form-control-sm" placeholder="e.g. STUDENT15" style="border-radius: var(--qu-radius-sm) 0 0 var(--qu-radius-sm); border: 1px solid var(--qu-border-color); padding: 8px 12px; font-weight: 600; text-transform: uppercase;">
                <button class="btn btn-primary btn-sm px-3 fw-bold" type="button" id="promo-apply-btn" style="border-radius: 0 var(--qu-radius-sm) var(--qu-radius-sm) 0;">Apply</button>
              </div>
              <div id="promo-message" class="small mt-2 p-2 rounded fw-medium text-center" style="display: none; font-size: 12px;"></div>
              
              <!-- Quick hints of coupons -->
              <p class="text-muted mb-0 mt-2 text-center" style="font-size: 11px;">
                Use code <span class="badge bg-secondary-subtle text-dark border fw-bold px-1.5 py-0.5">STUDENT15</span> for 15% off uniforms!
              </p>
            </div>
            
            <!-- Price Calculation Details Breakdown -->
            <div class="pt-3 border-top text-secondary small" style="font-size: 13px;">
              <div class="d-flex justify-content-between mb-2">
                <span>Garment Subtotal</span>
                <span id="cart-subtotal" class="fw-bold text-dark">$0.00</span>
              </div>
              
              <div class="d-flex justify-content-between mb-2" id="delivery-breakdown-row">
                <span>Distribution Delivery</span>
                <span id="cart-delivery" class="fw-bold text-success">FREE</span>
              </div>

              <div class="d-flex justify-content-between mb-2 d-none" id="addons-breakdown-row">
                <span>Packaging & Label Add-ons</span>
                <span id="cart-addons" class="fw-bold text-dark">+$0.00</span>
              </div>

              <div class="d-flex justify-content-between mb-3 text-danger fw-semibold d-none" id="discount-breakdown-row">
                <span>Coupon Promo Discount (15%)</span>
                <span id="cart-discount">-$0.00</span>
              </div>
              
              <div class="d-flex justify-content-between mb-3 pt-3 border-top align-items-center">
                <span class="fw-bold text-dark fs-6">Estimated Total</span>
                <span id="cart-total" class="fw-extrabold text-primary fs-4" style="font-family: var(--font-display);">$0.00</span>
              </div>
            </div>

            <!-- Checkout Buttons -->
            <div class="d-grid gap-2 mt-4">
              <a href="checkout.html" class="btn btn-primary py-3 fw-bold d-flex align-items-center justify-content-center gap-2" style="border-radius: var(--qu-radius-sm); font-size: 15px; box-shadow: var(--qu-shadow);">
                Proceed to Secure Checkout <span>&rarr;</span>
              </a>
            </div>

            <!-- Visual Trust Badges / Guarantee Center -->
            <div class="mt-4 pt-3 border-top text-center">
              <div class="row g-2">
                <div class="col-4">
                  <div class="p-1">
                    <span class="fs-4 d-block mb-1" style="line-height: 1;">🛡️</span>
                    <strong class="d-block text-dark" style="font-size: 10px; line-height: 1.2;">100% Approved</strong>
                    <span class="text-secondary d-block" style="font-size: 9px; line-height: 1.1;">Official Board Designs</span>
                  </div>
                </div>
                <div class="col-4">
                  <div class="p-1">
                    <span class="fs-4 d-block mb-1" style="line-height: 1;">🔄</span>
                    <strong class="d-block text-dark" style="font-size: 10px; line-height: 1.2;">Easy Sizing</strong>
                    <span class="text-secondary d-block" style="font-size: 9px; line-height: 1.1;">30-Day Size Exchange</span>
                  </div>
                </div>
                <div class="col-4">
                  <div class="p-1">
                    <span class="fs-4 d-block mb-1" style="line-height: 1;">🔒</span>
                    <strong class="d-block text-dark" style="font-size: 10px; line-height: 1.2;">Secured Checkout</strong>
                    <span class="text-secondary d-block" style="font-size: 9px; line-height: 1.1;">SSL Encrypted Pay</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </main>

    
@endsection