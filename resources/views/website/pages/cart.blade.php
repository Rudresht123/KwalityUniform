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

                        @if (!$cartItems->isEmpty())
                            <button type="button" class="clear-cart-btn" id="clear-cart"
                                data-url="{{ route('website.cart.clear') }}">
                                <i class="ti ti-trash-x me-1"></i> Clear All
                            </button>
                        @endif
                    </div>

                    @if ($cartItems->isEmpty())
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
                            @foreach ($cartItems as $item)
                                <div class="cart-item-card" id="item-{{ $item->cart_item_id }}">

                                    <div class="cart-item-image">
                                        <img src="{{ $item->product->firstImage() }}"
                                            alt="{{ $item->product->product_name }}">
                                    </div>

                                    <div class="cart-item-info">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <div class="cart-item-school">
                                                {{ $item->product->schoolApprovals->first()?->school?->school_name ?? 'General Wear' }}
                                            </div>
                                            <span class="badge bg-success-subtle text-success"
                                                style="font-size: 9px; padding: 2px 6px; border-radius: 4px;">Verified</span>
                                        </div>
                                        <div class="cart-item-name">{{ $item->product->product_name }}</div>
                                        <div class="cart-item-variant">
                                            <span>{{ $item->variant->size->display_name ?? 'N/A' }}</span>
                                            <span class="dot">&bull;</span>
                                            <span>{{ $item->variant->color->color_name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="text-muted small mt-1" style="font-size: 11px; line-height: 1.2;">
                                            {{ Str::limit($item->product->description, 60) }}
                                        </div>
                                    </div>

                                    <div class="cart-item-qty">
                                        <button class="cart-qty-btn qty-update" data-id="{{ $item->cart_item_id }}"
                                            data-qty="{{ $item->quantity - 1 }}" data-min="1">
                                            <i class="ti-minus"></i>
                                        </button>
                                        <span class="cart-qty-val qty-val">{{ $item->quantity }}</span>
                                        <button class="cart-qty-btn qty-update" data-id="{{ $item->cart_item_id }}"
                                            data-qty="{{ $item->quantity + 1 }}">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>

                                    <div class="d-flex flex-column align-items-end">
                                        <div class="text-secondary small" style="font-size: 11px;">
                                            ₹{{ number_format($item->unit_price, 2) }}</div>
                                        <div class="fw-bold text-dark item-total-price">
                                            ₹{{ number_format($item->quantity * $item->unit_price, 2) }}
                                        </div>
                                    </div>

                                    <button class="cart-item-remove remove-item"
                                        data-url="{{ route('website.cart.remove', $item->cart_item_id) }}"
                                        title="Remove item">
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

                    <!-- Delivery Options -->
                    <div class="mb-4">
                        <label class="fw-bold text-dark small mb-2 d-block">Select Distribution Method:</label>
                        <div class="d-flex flex-column gap-2">
                            <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer"
                                id="delivery-school"
                                style="border: 2px solid var(--qu-primary); background-color: rgba(30, 58, 138, 0.02); cursor: pointer;">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="delivery-option" checked>
                                    <label class="form-check-label ms-2 cursor-pointer" style="user-select: none;">
                                        <span class="fw-bold text-dark small d-block" style="line-height: 1.2;">Deliver to
                                            School Desk</span>
                                        <span class="text-secondary" style="font-size: 11px;">Official academic pick-up
                                            desk</span>
                                    </label>
                                </div>
                                <span class="text-success fw-bold small">FREE</span>
                            </div>

                            <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer"
                                id="delivery-home"
                                style="border: 2px solid #dee2e6; background-color: transparent; cursor: pointer;">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="delivery-option">
                                    <label class="form-check-label ms-2 cursor-pointer" style="user-select: none;">
                                        <span class="fw-bold text-dark small d-block" style="line-height: 1.2;">Home
                                            Delivery</span>
                                        <span class="text-secondary" style="font-size: 11px;">Direct residential courier
                                            dispatch</span>
                                    </label>
                                </div>
                                <span class="text-success fw-bold small">FREE</span>
                                {{-- <span class="text-dark fw-bold small">$8.00</span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value" id="summary-subtotal">₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Shipping</span>
                        <span class="summary-value summary-free" id="summary-shipping">Free</span>
                    </div>

                    <div class="summary-total-row">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-value" id="summary-total">₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <a href="{{ route('website.checkout') }}"
                        class="btn-checkout {{ $cartItems->isEmpty() ? 'disabled' : '' }}">
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
            let deliveryFee = 0;

            function updateTotals(subtotal) {
                const total = parseFloat(subtotal) + deliveryFee;
                animatePriceChange($('#summary-subtotal'), subtotal);
                animatePriceChange($('#summary-total'), total);
                $('#summary-shipping').text(deliveryFee === 0 ? 'Free' : '₹' + deliveryFee.toFixed(2));
            }

            /* ===================================================
               Delivery Options Interaction
            =================================================== */
            $('#delivery-school').on('click', function() {
                deliveryFee = 0;
                $(this).css({
                    'border': '2px solid var(--qu-primary)',
                    'background-color': 'rgba(30, 58, 138, 0.02)'
                });
                $('#delivery-home').css({
                    'border': '2px solid #dee2e6',
                    'background-color': 'transparent'
                });
                $('input[name="delivery-option"]').eq(0).prop('checked', true);

                localStorage.setItem('qu_delivery_preference', 'school');

                const currentSubtotal = $('#summary-subtotal').text().replace(/[₹,]/g, '');
                updateTotals(currentSubtotal);
            });

            $('#delivery-home').on('click', function() {
                deliveryFee = 0.00;
                $(this).css({
                    'border': '2px solid var(--qu-primary)',
                    'background-color': 'rgba(30, 58, 138, 0.02)'
                });
                $('#delivery-school').css({
                    'border': '2px solid #dee2e6',
                    'background-color': 'transparent'
                });
                $('input[name="delivery-option"]').eq(1).prop('checked', true);

                localStorage.setItem('qu_delivery_preference', 'home');

                const currentSubtotal = $('#summary-subtotal').text().replace(/[₹,]/g, '');
                updateTotals(currentSubtotal);
            });

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
                    data: JSON.stringify({
                        cart_item_id: id,
                        quantity: qty
                    }),
                    dataType: 'json',

                    success: function(response) {
                        $row.find('.qty-val').text(response.quantity ?? qty);
                        $row.find('.qty-update').each(function() {
                            const isMinus = $(this).find('i').hasClass('ti-minus');
                            $(this).data('qty', isMinus ? response.quantity - 1 :
                                response.quantity + 1);
                        });

                        animatePriceChange($row.find('.item-total-price'), response.item_total);
                        updateTotals(response.subtotal);
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
            ================================================== */
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
                        $row.slideUp(250, function() {
                            $row.remove();
                            const remaining = $('.cart-item-card').length;
                            $('.cart-count-badge').text(remaining);

                            const newSubtotal = response.subtotal || $(
                                '#summary-subtotal').text().replace(/[₹,]/g, '');
                            updateTotals(newSubtotal);

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
            ================================================== */
            $('#clear-cart').on('click', function() {
                if (!confirm('Are you sure you want to clear your entire basket?')) return;
                $.ajax({
                    url: $('#clear-cart').data('url'),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function() {
                        alert('Could not clear basket.');
                    }
                });
            });

            function animatePriceChange($el, newValue) {
                if (newValue === undefined || newValue === null) return;
                const oldText = $el.text().replace(/[₹,]/g, '');
                const oldValue = parseFloat(oldText) || 0;
                const target = parseFloat(newValue);
                $el.addClass('price-pop');
                setTimeout(() => $el.removeClass('price-pop'), 350);
                $({
                    val: oldValue
                }).animate({
                    val: target
                }, {
                    duration: 400,
                    easing: 'swing',
                    step: function(now) {
                        $el.text('₹' + now.toLocaleString('en-IN', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                    },
                    complete: function() {
                        $el.text('₹' + target.toLocaleString('en-IN', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                    }
                });
            }

            function flashRow($row) {
                $row.addClass('row-flash');
                setTimeout(() => $row.removeClass('row-flash'), 400);
            }
        });
    </script>
@endsection
