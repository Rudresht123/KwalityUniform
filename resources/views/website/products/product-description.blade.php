<div class="row g-0 quick-view-wrap">

    {{-- ========================================= --}}
    {{-- Product Images --}}
    {{-- ========================================= --}}
    <div class="col-lg-5">
        <div class="product-gallery">

            @if (count($product['images']))

                <div class="gallery-main" id="qv-zoom-wrap">
                    <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}" class="gallery-main-img"
                        id="qv-main-image">

                    @if (count($product['images']) > 1)
                        <span class="gallery-counter">
                            <span id="qv-current-index">1</span> / {{ count($product['images']) }}
                        </span>
                    @endif
                </div>

                @if (count($product['images']) > 1)
                    <div class="gallery-thumbs">
                        @foreach ($product['images'] as $index => $image)
                            <button type="button" class="gallery-thumb {{ $index === 0 ? 'is-active' : '' }}"
                                data-full="{{ $image }}" data-index="{{ $index + 1 }}"
                                aria-label="View image {{ $index + 1 }}">
                                <img src="{{ $image }}"
                                    alt="{{ $product['name'] }} thumbnail {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="gallery-main no-image">
                    <i class="ti ti-photo-off"></i>
                    <span>No Image Available</span>
                </div>
            @endif
            {{-- Colors --}}
            @php
                $colors = collect($product['variants'])->unique('color_id');
            @endphp

            @if ($colors->count())

                <div class="option-row">

                    <label class="mb-2">

                        Color

                    </label>

                    <div class="d-flex flex-wrap gap-2" id="qv-color-group">

                        @foreach ($colors as $index => $color)
                            <button type="button" class="color-item {{ $index == 0 ? 'is-selected' : '' }}">

                                <span class="color-circle" style="background:{{ $color['hex_code'] }}">
                                </span>

                                {{ $color['color_name'] }}

                            </button>
                        @endforeach

                    </div>

                </div>

            @endif
        </div>
    </div>

    {{-- ========================================= --}}
    {{-- Product Information --}}
    {{-- ========================================= --}}
    <div class="col-lg-7">

        <div class="product-info-wrapper">

            {{-- Product Header --}}
            <div class="product-header">

                <div class="product-info">

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                        <span class="category-badge">
                            {{ $product['category'] }}
                        </span>

                        <span class="verified-badge">
                            <i class="ti ti-shield-check"></i>
                            Verified
                        </span>

                    </div>

                    <div class="d-flex justify-content-between align-items-start gap-3">

                        <div>

                            <h4 class="product-title mb-1">
                                {{ $product['name'] }}
                            </h4>

                            <div class="product-meta">

                                <span>
                                    <i class="ti ti-school"></i>
                                    {{ $product['school'] }}
                                </span>

                            </div>

                        </div>

                        <div class="price-box">

                            <div class="product-price">

                                ₹{{ number_format($product['price'], 2) }}

                                <small>

                                    Inclusive of all taxes

                                </small>

                            </div>



                        </div>

                    </div>

                </div>

            </div>

            {{-- Description --}}
            @if (!empty($product['description']))

                <div class="product-description-wrapper bg-light p-2" style="border-radius: 10px">

                    <p class="product-description collapsed" id="productDescription">

                        {{ $product['description'] }}

                    </p>

                    @if (strlen($product['description']) > 180)
                        <button type="button" class="read-more-btn" id="toggleDescription">

                            Read More

                            <i class="ti ti-chevron-down"></i>

                        </button>
                    @endif

                </div>

            @endif


            {{-- Specifications --}}
            <div class="specifications">

                <div>

                    <span>Fabric</span>

                    <strong>

                        {{ $product['fabric'] ?: 'N/A' }}

                    </strong>

                </div>

                <div>

                    <span>Gender</span>

                    <strong>

                        {{ ucfirst($product['gender']) }}

                    </strong>

                </div>

            </div>


            {{-- Sizes --}}
            @php
                $sizes = collect($product['variants'])->pluck('display_name')->filter()->unique();
            @endphp

            @if ($sizes->count())

                <div class="option-row">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <label>

                            Size

                        </label>

                        <a href="#" class="size-guide-link">

                            Size Guide

                        </a>

                    </div>

                    <div class="d-flex flex-wrap gap-2" id="qv-size-group">

                        @foreach ($sizes as $index => $size)
                            <button type="button" class="size-pill {{ $index == 0 ? 'is-selected' : '' }}">

                                {{ $size }}

                            </button>
                        @endforeach

                    </div>

                </div>

            @endif

            {{-- Stock Status --}}
            <div id="qv-stock-status" class="mb-3 d-flex align-items-center gap-2" style="display: none;">
                <span class="stock-dot" style="width: 8px; height: 8px; border-radius: 50%; display: inline-block;"></span>
                <span class="stock-text small fw-semibold"></span>
            </div>

             {{-- Action --}}
<div class="qv-action-row">

    <div class="qty-stepper">
        <button type="button" class="qty-btn" id="qv-qty-minus">
            <i class="ti-minus"></i>
        </button>

        <span class="qty-value" id="qv-qty-value">1</span>

        <button type="button" class="qty-btn" id="qv-qty-plus">
            <i class="ti-plus"></i>
        </button>
    </div>

    <button class="btn-add-basket" id="qv-add-to-basket" data-product-id="{{ $product['id'] }}">
        <i class="ti ti-shopping-cart-plus me-2"></i>
        Add To Basket - ₹{{ number_format($product['price'], 2) }}
    </button>

</div>

            {{-- Trust Badges --}}

            <div class="qv-trust-row">

                <span>

                    <i class="ti ti-truck-delivery"></i>

                    Free Delivery

                </span>

                <span>

                    <i class="ti ti-rotate-2"></i>

                    7-Day Return

                </span>

                <span>

                    <i class="ti ti-shield-check"></i>

                    Secure Purchase

                </span>

            </div>

        </div>

    </div>
</div>

<script src="{{ asset('assets/product-quickview.js') }}"></script>
<script>
    (function() {
        window.csrfToken = '{{ csrf_token() }}';
        initProductQuickView(@json($product));
    })();
</script>
