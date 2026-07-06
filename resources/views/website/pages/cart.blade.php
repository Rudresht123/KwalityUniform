@extends('website.components.common')

@section('content')
<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">Your Shopping Basket</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li class="active-item">Basket</li>
        </ul>
    </div>
</div>

<main class="container py-5">
    <div class="row g-4">

        {{-- ============================================= --}}
        {{-- Cart Items List --}}
        {{-- ============================================= --}}
        <div class="col-lg-8">
            <div class="cart-panel">

                <div class="cart-panel-header">
                    <h5 class="cart-panel-title">
                        Selected Garments
                        <span class="cart-count-badge">{{ $cartItems->count() }}</span>
                    </h5>

                    @if(!$cartItems->isEmpty())
                        <button type="button" class="clear-cart-btn" id="clear-cart" data-url="{{ route('website.cart.clear') }}">
                            <i class="ti ti-trash-x me-1"></i> Clear All
                        </button>
                    @endif
                </div>

                @if($cartItems->isEmpty())
                    <div class="cart-empty-state">
                        <div class="cart-empty-icon">
                            <i class="ti ti-shopping-cart-off"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Your basket is empty</h4>
                        <p class="text-muted mb-4">Looks like you haven't added any items to your basket yet.</p>
                        <a href="{{ route('website.shop') }}" class="btn-shop-now">
                            Start Shopping <i class="ti ti-arrow-right ms-1"></i>
                        </a>
                    </div>
                @else
                    <div class="cart-items-list">
                        @foreach($cartItems as $item)
                            <div class="cart-item-card" id="item-{{ $item->cart_item_id }}">

                                <div class="cart-item-image">
                                    <img src="{{ $item->product->firstImage() }}" alt="{{ $item->product->product_name }}">
                                </div>

                                <div class="cart-item-info">
                                    <div class="cart-item-school">
                                        {{ $item->product->schoolApprovals->first()?->school?->school_name ?? 'General Wear' }}
                                    </div>
                                    <div class="cart-item-name">{{ $item->product->product_name }}</div>
                                    <div class="cart-item-variant">
                                        <span>{{ $item->variant->display_name ?? 'N/A' }}</span>
                                        <span class="dot">&bull;</span>
                                        <span>{{ $item->variant->color_name ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="cart-item-qty">
                                    <button class="cart-qty-btn qty-update"
                                        data-id="{{ $item->cart_item_id }}" data-qty="{{ $item->quantity - 1 }}" data-min="1">
                                        <i class="ti-minus"></i>
                                    </button>
                                    <span class="cart-qty-val qty-val">{{ $item->quantity }}</span>
                                    <button class="cart-qty-btn qty-update"
                                        data-id="{{ $item->cart_item_id }}" data-qty="{{ $item->quantity + 1 }}">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>

                                <div class="cart-item-price">
                                    ₹{{ number_format($item->unit_price, 2) }}
                                </div>

                                <button class="cart-item-remove remove-item" data-url="{{ route('website.cart.remove', $item->cart_item_id) }}" title="Remove item">
                                    <i class="ti ti-trash"></i>
                                </button>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- Summary Panel --}}
        {{-- ============================================= --}}
        <div class="col-lg-4">
            <div class="summary-panel sticky-top" style="top: 100px;">
                <h5 class="summary-title">Order Summary</h5>

                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">₹{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Shipping</span>
                    <span class="summary-value summary-free">Free</span>
                </div>

                <div class="summary-total-row">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-value">₹{{ number_format($subtotal, 2) }}</span>
                </div>

                <a href="" class="btn-checkout {{ $cartItems->isEmpty() ? 'disabled' : '' }}">
                    Proceed to Checkout <i class="ti ti-arrow-right ms-2"></i>
                </a>

                <div class="summary-trust-row">
                    <div class="trust-item">
                        <i class="ti ti-shield-check"></i>
                        <span>Secure Checkout</span>
                    </div>
                    <div class="trust-item">
                        <i class="ti ti-truck-delivery"></i>
                        <span>Free Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<script>
$(document).ready(function() {

    /* ===================================================
       Update Quantity (AJAX + Animated Price Update)
    =================================================== */
    $(document).on('click', '.qty-update', function() {
        const $btn = $(this);
        const $row = $btn.closest('.cart-item-card');
        const id = $btn.data('id');
        const qty = parseInt($btn.data('qty'));
        const min = $btn.data('min') || 1;

        if (qty < min) return;

        // Disable both qty buttons in this row while request is in flight
        const $qtyBtns = $row.find('.qty-update');
        $qtyBtns.prop('disabled', true).css('opacity', 0.5);

        $.ajax({
            url: "{{ route('website.cart.update') }}",
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'X-Requested-With': 'XMLHttpRequest'
            },
            data: JSON.stringify({ cart_item_id: id, quantity: qty }),
            dataType: 'json',

            success: function(response) {
                // Expecting response like:
                // { item_total: 450.00, subtotal: 1250.00, total: 1250.00, quantity: 3 }

                // 1. Update this row's quantity display
                $row.find('.qty-val').text(response.quantity ?? qty);

                // 2. Update the +/- button data-qty attributes for next click
                $row.find('.qty-update').each(function() {
                    const isMinus = $(this).find('i').hasClass('ti-minus');
                    $(this).data('qty', isMinus ? response.quantity - 1 : response.quantity + 1);
                });

                // 3. Animate + update this row's item total price
                animatePriceChange($row.find('.cart-item-price'), response.item_total);

                // 4. Animate + update the summary panel subtotal & total
                animatePriceChange($('#summary-subtotal'), response.subtotal);
                animatePriceChange($('#summary-total'), response.total ?? response.subtotal);

                // 5. Quick highlight flash on the whole row to show something happened
                flashRow($row);
            },

            error: function() {
                alert('Could not update quantity. Please try again.');
            },

            complete: function() {
                $qtyBtns.prop('disabled', false).css('opacity', 1);
            }
        });
    });

    /* ===================================================
       Remove Item (AJAX + Fade Out Animation)
    =================================================== */
    $(document).on('click', '.remove-item', function() {
        if (!confirm('Remove this item from your basket?')) return;

        const $btn = $(this);
        const $row = $btn.closest('.cart-item-card');

        $.ajax({
            url: $btn.data('url'),
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'X-Requested-With': 'XMLHttpRequest'
            },
            dataType: 'json',

            success: function(response) {
                // Smoothly collapse and remove the row
                $row.slideUp(250, function() {
                    $row.remove();

                    // Update badge count
                    const remaining = $('.cart-item-card').length;
                    $('.cart-count-badge').text(remaining);

                    // Update totals
                    animatePriceChange($('#summary-subtotal'), response.subtotal);
                    animatePriceChange($('#summary-total'), response.total ?? response.subtotal);

                    // Show empty state if cart is now empty
                    if (remaining === 0) {
                        location.reload();
                    }
                });
            },

            error: function() {
                alert('Could not remove item. Please try again.');
            }
        });
    });

    /* ===================================================
       Clear Entire Cart
    =================================================== */
    $('#clear-cart').on('click', function() {
        if (!confirm('Are you sure you want to clear your entire basket?')) return;

        const $btn = $(this);

        $.ajax({
            url: $btn.data('url'),
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function() {
                location.reload();
            },
            error: function() {
                alert('Could not clear basket. Please try again.');
            }
        });
    });

    /* ===================================================
       Helper: Animate a price element to a new value
       - Counts up/down smoothly instead of an instant jump
       - Briefly scales + colors the text for a "pop" effect
    =================================================== */
    function animatePriceChange($el, newValue) {
        if (newValue === undefined || newValue === null) return;

        const oldText = $el.text().replace(/[₹,]/g, '');
        const oldValue = parseFloat(oldText) || 0;
        const target = parseFloat(newValue);

        // Pop effect
        $el.addClass('price-pop');
        setTimeout(() => $el.removeClass('price-pop'), 350);

        // Count animation
        $({ val: oldValue }).animate({ val: target }, {
            duration: 400,
            easing: 'swing',
            step: function(now) {
                $el.text('₹' + now.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            },
            complete: function() {
                $el.text('₹' + target.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            }
        });
    }

    /* ===================================================
       Helper: Flash a row briefly to indicate an update
    =================================================== */
    function flashRow($row) {
        $row.addClass('row-flash');
        setTimeout(() => $row.removeClass('row-flash'), 400);
    }

});
</script>
@endsection