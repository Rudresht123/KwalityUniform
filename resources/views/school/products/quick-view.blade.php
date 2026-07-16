<div class="row g-0 quick-view-wrap">

    {{-- ========================================= --}}
    {{-- Product Images --}}
    {{-- ========================================= --}}
    <div class="col-lg-5">
        <div class="product-gallery">

            @if (count($images))

                <div class="gallery-main" id="qv-zoom-wrap">
                    <img src="{{ $images[0] }}" alt="{{ $product->product_name }}" class="gallery-main-img"
                        id="qv-main-image">

                    @if (count($images) > 1)
                        <span class="gallery-counter">
                            <span id="qv-current-index">1</span> / {{ count($images) }}
                        </span>
                    @endif
                </div>

                @if (count($images) > 1)
                    <div class="gallery-thumbs">
                        @foreach ($images as $index => $image)
                            <button type="button" class="gallery-thumb {{ $index === 0 ? 'is-active' : '' }}"
                                data-full="{{ $image }}" data-index="{{ $index + 1 }}"
                                aria-label="View image {{ $index + 1 }}">
                                <img src="{{ $image }}"
                                    alt="{{ $product->product_name }} thumbnail {{ $index + 1 }}">
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
                $colors = collect($product->variants)->unique('color_id');
            @endphp

            @if ($colors->count())

                <div class="option-row">

                    <label class="mb-2">

                        Color

                    </label>

                    <div class="d-flex flex-wrap gap-2" id="qv-color-group">

                        @foreach ($colors as $index => $variant)
                            @php $color = $variant->color; @endphp
                            <button type="button" class="color-item {{ $index == 0 ? 'is-selected' : '' }}">

                                <span class="color-circle" style="background:{{ $color?->hex_code ?? '#ccc' }}">
                                </span>

                                {{ $color?->color_name ?? 'N/A' }}

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
                            {{ $product->category?->category_name ?? 'General' }}
                        </span>

                        <span class="verified-badge">
                            <i class="ti ti-shield-check"></i>
                            Verified
                        </span>

                    </div>

                    <div class="d-flex justify-content-between align-items-start gap-3">

                        <div>

                            <h4 class="product-title mb-1">
                                {{ $product->product_name }}
                            </h4>

                            <div class="product-meta">

                                <span>
                                    <i class="ti ti-building-store"></i>
                                    {{ $product->vendor?->business_name ?? 'N/A' }}
                                </span>

                            </div>

                        </div>

                        <div class="price-box">

                            <div class="product-price">

                                ₹{{ number_format($product->price ?? 0, 2) }}

                                <small>

                                    Inclusive of all taxes

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Description --}}
            @if (!empty($product->description))

                <div class="product-description-wrapper bg-light p-2" style="border-radius: 10px">

                    <p class="product-description collapsed" id="productDescription">

                        {{ $product->description }}

                    </p>

                    @if (strlen($product->description) > 180)
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

                        {{ $product->fabric ?: 'N/A' }}

                    </strong>

                </div>

                <div>

                    <span>Gender</span>

                    <strong>

                        {{ ucfirst($product->gender_type ?? 'N/A') }}

                    </strong>

                </div>

            </div>


            {{-- Sizes --}}
            @php
                $sizes = collect($product->variants)->map(fn($v) => $v->size?->size_name ?? null)->filter()->unique();
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

            {{-- Action --}}
            <div class="qv-action-row">
                @if ($isApproved)
                    <button class="btn-approve-school approved w-100 py-3 fs-6" disabled>
                        <i class="ti ti-check me-2"></i> Approved for School
                    </button>
                @else
                    <button class="btn-approve-school w-100 py-3" onclick="handleApproveClick('{{ $product->product_id }}')">
                        <i class="ti ti-check me-2"></i> Approve for my School
                    </button>
                @endif
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

<style>
    .btn-approve-school {
        background: var(--bs-primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background .2s;
    }
    .btn-approve-school:hover {
        background: #4a4fb8 !important;
    }
    .btn-approve-school.approved {
        background: var(--bs-success);
        cursor: default;
    }
</style>


<script src="{{ asset('assets/product-quickview.js') }}"></script>
<script>
    (function() {
        window.csrfToken = '{{ csrf_token() }}';
        initProductQuickView(@json($product));
    })();
</script>
<script>
    @php
        $jsVariants = $product->variants->map(function($v) {
            return [
                'display_name' => $v->size?->size_name ?? 'N/A',
                'color_name' => $v->color?->color_name ?? 'N/A',
                'selling_price' => $v->selling_price,
                'stock_qty' => $v->stock_qty,
                'variant_id' => $v->variant_id
            ];
        });
    @endphp
    (function() {
        window.csrfToken = '{{ csrf_token() }}';
        // Pass the product data in a format compatible with the JS
        initProductQuickView({
            id: "{{ $product->product_id }}",
            name: "{{ $product->product_name }}",
            price: {{ $product->price }},
            images: @json($images),
            variants: @json($jsVariants),
            category: "{{ $product->category?->category_name ?? 'General' }}",
            school: "{{ $product->vendor?->business_name ?? 'N/A' }}",
            description: "{{ addslashes($product->description) }}",
            fabric: "{{ $product->fabric ?? 'N/A' }}",
            gender: "{{ $product->gender_type ?? 'N/A' }}"
        });
    })();
</script>
