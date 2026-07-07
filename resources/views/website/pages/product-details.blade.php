@extends('website.components.common')

@section('content')
    <!-- Page Header (Full Width Banner with Background Image) -->
    <div class="geo-page-header" style="background-image: url('https://images.unsplash.com/photo-1589756823855-edd13437c56e?auto=format&fit=crop&q=80&w=1200');">
      <div class="container">
        <h1 class="display-6 fw-extrabold text-white mb-2">Garment Details</h1>
        <ul class="geo-breadcrumb mb-0">
          <li><a href="index.html">Home</a></li>
          <li>&bull;</li>
          <li><a href="shop.html">Catalogue</a></li>
          <li>&bull;</li>
          <li class="active-item">Garment Details</li>
        </ul>
      </div>
    </div>

    <style>
      .size-badge.out-of-stock {
        border-color: #EF4444 !important;
        color: #EF4444 !important;
        background-color: #FEE2E2 !important;
        cursor: not-allowed !important;
        opacity: 0.6;
      }
      .color-swatch.out-of-stock {
        border: 2px solid #EF4444 !important;
        cursor: not-allowed !important;
        opacity: 0.6;
        position: relative;
      }
      .color-swatch.out-of-stock::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 70%;
        height: 2px;
        background: #EF4444;
        transform: translate(-50%, -50%) rotate(45deg);
      }
      .btn-out-of-stock {
        background-color: #EF4444 !important;
        border-color: #EF4444 !important;
        color: white !important;
        cursor: not-allowed !important;
      }
      .size-badge.active-selection {
        background-color: var(--qu-primary) !important;
        color: white !important;
        border-color: var(--qu-primary) !important;
      }
      .color-swatch.active-selection {
        outline: 2px solid var(--qu-primary);
        outline-offset: 2px;
      }
    </style>

    <!-- Main Content -->
    <main class="container py-5">

      
      <!-- Product Showcase Block (Geometric Balance styled 20px card) -->
      <div class="card-geo p-4 p-md-5 mb-5">
        <div class="row g-5">
          
          <!-- Left Col: Product Image (Zoom styling) -->
          <div class="col-md-6">
            <div style="background: #F3F4F6; border-radius: var(--qu-radius); overflow: hidden; aspect-ratio: 4/5; border: 1px solid var(--qu-border-color);">
              <img id="details-image" src="{{ $product->firstImage() }}" alt="{{ $product->product_name }}" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
          </div>

          <!-- Right Col: Product Info & Selectors -->
          <div class="col-md-6 d-flex flex-column justify-content-center">
            
            <div id="details-school" class="fw-bold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 1px; color: var(--qu-primary);">
              {{ $product->schoolApprovals->first()?->school?->school_name ?? 'General Wear' }}
            </div>
            
            <h1 id="details-name" class="display-6 fw-extrabold text-dark mb-3">
              {{ $product->product_name }}
            </h1>

            <!-- Ratings -->
            <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
              <div class="rating-stars-container">
                @for($i=0; $i<5; $i++)
                    <svg width="14" height="14" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                @endfor
              </div>
              <span id="details-rating" class="small fw-bold text-dark">4.5</span>
              <span id="details-reviews" class="small text-muted">(Customer Reviews)</span>
            </div>

            <!-- Price -->
            <div id="details-price" class="display-5 fw-bold text-primary mb-4" style="font-family: var(--font-display);" data-base-price="{{ $product->price }}">
              ${{ number_format($product->price, 2) }}
            </div>

            <!-- Description -->
            <p id="details-description" class="text-secondary mb-4 small" style="line-height: 1.6;">
              {{ $product->description }}
            </p>

            <!-- Color Options -->
            <div class="mb-4">
              <label class="form-label small fw-semibold d-block mb-2">Available Colors</label>
              <div id="details-colors-container" class="d-flex gap-2">
                @foreach($product->variants->pluck('color')->unique() as $color)
                    <span class="color-swatch" style="background-color: #CCC; cursor: pointer;" data-color="{{ $color }}" title="{{ $color }}"></span>
                @endforeach
              </div>
            </div>

            <!-- Size Options -->
            <div class="mb-4">
              <label class="form-label small fw-semibold d-block mb-2">Select Sizing</label>
              <div id="details-sizes-container" class="d-flex flex-wrap gap-2">
                @foreach($product->variants->pluck('size')->unique() as $size)
                    <span class="size-badge" data-size="{{ $size }}" style="cursor: pointer;">{{ $size }}</span>
                @endforeach
              </div>
              <span class="text-muted" style="font-size: 11px;">Complies with academic sizing board tolerances (+/- 0.5 in)</span>
            </div>

            <!-- Qty and Basket Button row -->
            <div class="d-flex flex-wrap align-items-center gap-3 pt-3 border-top mt-3">
              <!-- Qty picker -->
              <div class="d-flex align-items-center border rounded-3 p-1" style="height: 44px; background: #FFF;">
                <button id="details-qty-minus" class="btn btn-secondary border-0 p-1 px-3 fs-5" style="height: 100%; display: flex; align-items: center;">-</button>
                <input id="details-qty-input" type="text" class="form-control text-center border-0 p-0 fw-bold" value="1" readonly style="width: 44px;" />
                <button id="details-qty-plus" class="btn btn-secondary border-0 p-1 px-3 fs-5" style="height: 100%; display: flex; align-items: center;">+</button>
              </div>
              
              <!-- Add to cart -->
              <button id="details-add-btn" class="btn btn-primary px-4 py-2.5 flex-grow-1 add-to-cart-btn" 
                      style="height: 44px;" 
                      data-product-id="{{ $product->product_id }}" 
                      data-quantity="1">
                Add to Basket
              </button>



              <!-- Add to wishlist -->
              <button id="details-wishlist-btn" class="btn btn-outline-primary px-3" style="height: 44px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
              </button>
            </div>

          </div>

        </div>
      </div>

      <!-- Related Items Listing -->
      <section class="py-4">
        <h3 class="fw-bold mb-4" style="color: var(--qu-primary); font-family: var(--font-display);">Authorized Matching Pieces</h3>
        <div class="row g-4" id="details-related-grid">
          <!-- Dynamically populated via assets/js/app.js -->
        </div>
      </section>

    </main>

    <script id="product-variants-data" type="application/json">
        {!! json_encode($product->variants->map(function($v) {
            return [
                'variant_id' => $v->variant_id,
                'size' => $v->size?->display_name ?? $v->size?->size_name,
                'color' => $v->color?->color_name,
                'stock' => $v->stock_qty,
                'price' => $v->selling_price,
            ];
        })) !!}
    </script>

    <script src="{{ asset('assets/js/product-details.js') }}"></script>

    <!-- Footer -->


    <footer class="footer-geo">
      <div class="container footer-inner">
        <div>
          <span style="font-family: var(--font-display); font-weight: 800; color: var(--qu-primary);">ESCHOOL</span><span style="font-family: var(--font-display); font-weight: 300;">CART</span>
          <p class="mb-0 mt-1" style="font-size: 11px; color: #9CA3AF;">&copy; 2026 eSchool Cart Inc. All institutional designs are property of official regional school boards.</p>
        </div>
        <div class="footer-links-geo">
          <a href="about.html">About Us</a>
          <a href="shop.html">Catalogue</a>
          <a href="contact.html">Contact Us</a>
          <a href="wishlist.html">Wishlist</a>
        </div>
      </div>
    </footer>

  @endsection