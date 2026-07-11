<div>
    <!-- EMPTY STATE -->
    @if($cartItems->isEmpty())
        <div class="text-center py-5 card-geo">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="1.5" class="mb-3"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            <h4 class="fw-bold">Your basket is currently empty</h4>
            <p class="text-muted small">Access an authorized portal or explore everyday essentials to populate your cart.</p>
            <a href="/shop" class="btn btn-primary btn-sm rounded-pill mt-3 px-4">Browse Uniform Catalogue</a>
        </div>
    @else
        <div class="row g-4">
            <!-- Cart Items list -->
            <div class="col-lg-8">
                <!-- Free Delivery Progress Meter -->
                <div class="card-geo p-4 mb-4" style="border-left: 4px solid var(--qu-primary);">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                            <span>🚚</span> 
                            <span>
                                @if($subtotal >= 50)
                                    <span class="text-success">You've unlocked <strong>FREE Home Delivery!</strong></span>
                                @else
                                    Add <strong class="text-primary">${{ number_format(50 - $subtotal, 2) }}</strong> more for <strong>FREE Home Delivery</strong>
                                @endif
                            </span>
                        </span>
                        <span class="badge bg-primary text-white rounded-pill px-2 py-1" style="font-size: 11px;">
                            {{ min(100, round(($subtotal / 50) * 100)) }}%
                        </span>
                    </div>
                    <div class="progress" style="height: 8px; border-radius: 10px; background-color: #E5E7EB; overflow: hidden;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                             style="width: {{ min(100, ($subtotal / 50) * 100) }}%; background-color: var(--qu-primary); transition: width 0.4s ease;">
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2.5" style="font-size: 11px; line-height: 1.4;">
                        🎒 <strong>Deliver to School Desk:</strong> Standard deliveries directly to your school's official pick-up counter are always <strong>100% FREE</strong>!
                    </p>
                </div>

                <!-- Desktop Table -->
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
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/50' }}" width="50" height="50" class="rounded shadow-sm" style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 14px;">{{ $item->product->name }}</div>
                                                <div class="text-muted small" style="font-size: 12px;">{{ $item->variant?->size?->display_name ?? 'Standard' }} / {{ $item->variant?->color?->color_name ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-dark fw-medium">${{ number_format($item->unit_price, 2) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <button wire:click="updateQuantity('{{ $item->cart_item_id }}', -1)" class="btn btn-sm btn-outline-secondary rounded-circle px-2">-</button>
                                            <span class="fw-bold" style="min-width: 20px; text-align: center;">{{ $item->quantity }}</span>
                                            <button wire:click="updateQuantity('{{ $item->cart_item_id }}', 1)" class="btn btn-sm btn-outline-secondary rounded-circle px-2">+</button>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-dark">${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                    <td>
                                        <button wire:click="removeItem('{{ $item->cart_item_id }}')" class="btn btn-link text-danger p-0" title="Remove Item">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards List -->
                <div class="d-flex d-md-none flex-column gap-3 mb-4">
                    @foreach($cartItems as $item)
                        <div class="card-geo p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/50' }}" width="50" height="50" class="rounded shadow-sm" style="object-fit: cover;">
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 14px;">{{ $item->product->name }}</div>
                                    <div class="text-muted small" style="font-size: 12px;">{{ $item->variant?->size?->display_name ?? 'Standard' }} / {{ $item->variant?->color?->color_name ?? 'N/A' }}</div>
                                    <div class="text-primary fw-bold small">${{ number_format($item->unit_price, 2) }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <button wire:click="updateQuantity('{{ $item->cart_item_id }}', -1)" class="btn btn-sm btn-outline-secondary rounded-circle px-2">-</button>
                                    <span class="fw-bold" style="min-width: 20px; text-align: center;">{{ $item->quantity }}</span>
                                    <button wire:click="updateQuantity('{{ $item->cart_item_id }}', 1)" class="btn btn-sm btn-outline-secondary rounded-circle px-2">+</button>
                                </div>
                                <button wire:click="removeItem('{{ $item->cart_item_id }}')" class="btn btn-link text-danger p-0">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="/shop" class="btn btn-outline-secondary btn-sm px-4 rounded-pill fw-semibold">
                        &larr; Return to Sizing Catalogue
                    </a>
                    <button wire:click="clearCart" class="btn btn-link text-muted text-decoration-none small p-0" onclick="confirm('Are you sure you want to clear your shopping basket?') || event.stopImmediatePropagation()">
                        Clear Shopping Basket
                    </button>
                </div>
            </div>

            <!-- Summary & Totals Panel -->
            <div class="col-lg-4">
                <div class="card-geo p-4" style="position: sticky; top: 100px;">
                    <h4 class="fw-bold mb-3 pb-2 text-dark" style="font-size: 18px; border-bottom: 2px solid var(--qu-primary);">Order Summary</h4>
                    
                    <!-- Delivery Options -->
                    <div class="mb-4">
                        <label class="fw-bold text-dark small mb-2 d-block">Select Distribution Method:</label>
                        <div class="d-flex flex-column gap-2">
                            <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer {{ $deliveryOption === 'school' ? 'border-primary' : '' }}" 
                                 wire:click="setDeliveryOption('school')" 
                                 style="border: 2px solid {{ $deliveryOption === 'school' ? 'var(--qu-primary)' : '#dee2e6' }} !important; background-color: {{ $deliveryOption === 'school' ? 'rgba(30, 58, 138, 0.02)' : 'transparent' }}; transition: all 0.2s ease; cursor: pointer;">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="delivery-option" {{ $deliveryOption === 'school' ? 'checked' : '' }} style="pointer-events: none;">
                                    <label class="form-check-label ms-2 cursor-pointer" style="user-select: none;">
                                        <span class="fw-bold text-dark small d-block" style="line-height: 1.2;">Deliver to School Desk</span>
                                        <span class="text-secondary" style="font-size: 11px;">Official academic pick-up desk</span>
                                    </label>
                                </div>
                                <span class="text-success fw-bold small">FREE</span>
                            </div>

                            <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer {{ $deliveryOption === 'home' ? 'border-primary' : '' }}" 
                                 wire:click="setDeliveryOption('home')" 
                                 style="border: 2px solid {{ $deliveryOption === 'home' ? 'var(--qu-primary)' : '#dee2e6' }} !important; background-color: {{ $deliveryOption === 'home' ? 'rgba(30, 58, 138, 0.02)' : 'transparent' }}; transition: all 0.2s ease; cursor: pointer;">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="delivery-option" {{ $deliveryOption === 'home' ? 'checked' : '' }} style="pointer-events: none;">
                                    <label class="form-check-label ms-2 cursor-pointer" style="user-select: none;">
                                        <span class="fw-bold text-dark small d-block" style="line-height: 1.2;">Deliver to School Desk</span>
                                        <span class="text-secondary" style="font-size: 11px;">Direct residential courier dispatch</span>
                                    </label>
                                </div>
                                <span class="text-dark fw-bold small">$8.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Add-ons -->
                    <div class="mb-4 pt-3 border-top">
                        <label class="fw-bold text-dark small mb-2 d-block">Sizing & Presentation Add-ons:</label>
                        <div class="p-2.5 border rounded mb-2" style="background-color: var(--qu-bg-light); border-color: var(--qu-border-color); cursor: pointer;" wire:click="toggleAddon('gift_box')">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" {{ isset($addons['gift_box']) ? 'checked' : '' }} style="pointer-events: none;">
                                <label class="form-check-label small text-dark cursor-pointer ms-1 fw-medium" style="font-size: 12px; user-select: none;">
                                    🎁 Premium Gold-Foil Gift Box (+$5.00)
                                </label>
                            </div>
                        </div>
                        <div class="p-2.5 border rounded" style="background-color: var(--qu-bg-light); border-color: var(--qu-border-color); cursor: pointer;" wire:click="toggleAddon('labels')">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" {{ isset($addons['labels']) ? 'checked' : '' }} style="pointer-events: none;">
                                <label class="form-check-label small text-dark cursor-pointer ms-1 fw-medium" style="font-size: 12px; user-select: none;">
                                    🎁 Iron-On Laundry Name Labels (+$3.50)
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="pt-3 border-top text-secondary small" style="font-size: 13px;">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Garment Subtotal</span>
                            <span class="fw-bold text-dark">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Distribution Delivery</span>
                            <span class="fw-bold {{ $deliveryFee === 0 ? 'text-success' : 'text-dark' }}">${{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        @if(count($addons) > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Packaging & Label Add-ons</span>
                                <span class="fw-bold text-dark">
                                    +${{ number_format(count($addons) === 2 ? 8.50 : (isset($addons['gift_box']) ? 5.00 : 3.50), 2) }}
                                </span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mb-3 pt-3 border-top align-items-center">
                            <span class="fw-bold text-dark fs-6">Estimated Total</span>
                            <span class="fw-extrabold text-primary fs-4" style="font-family: var(--font-display);">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Checkout -->
                    <div class="d-grid gap-2 mt-4">
                        <a href="/checkout" class="btn btn-primary py-3 fw-bold d-flex align-items-center justify-content-center gap-2" style="border-radius: var(--qu-radius-sm); font-size: 15px; box-shadow: var(--qu-shadow);">
                            Proceed to Secure Checkout <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
