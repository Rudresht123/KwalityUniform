<div>
    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: var(--qu-radius-md);">
                <div class="modal-header border-bottom-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold text-dark" id="cartModalLabel">🛍️ Your Shopping Basket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    @livewire('cart-manager')
                </div>
            </div>
        </div>
    </div>

    <!-- Trigger for Modal (To be placed in Header) -->
    <div id="cart-trigger" class="cursor-pointer position-relative d-inline-block" data-bs-toggle="modal" data-bs-target="#cartModal">
        <div class="btn btn-light rounded-circle p-2 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-dark"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        </div>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 10px; transform: translate(-50%, -50%);">
            @livewire('cart-counter')
        </span>
    </div>
</div>
