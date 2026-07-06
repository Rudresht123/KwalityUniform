/**
 * Product Quick View Logic
 * Handles image gallery, zoom, variant selection, price calculation, and adding to cart.
 */

function initProductQuickView(productData) {
    const product = productData;
    const mainImg = document.getElementById('qv-main-image');
    const thumbs = document.querySelectorAll('.gallery-thumb');
    const counterEl = document.getElementById('qv-current-index');

    // Image Gallery
    thumbs.forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            const fullSrc = thumb.getAttribute('data-full');
            if (!mainImg || mainImg.src === fullSrc) return;

            mainImg.style.opacity = 0;
            setTimeout(function() {
                mainImg.src = fullSrc;
                mainImg.style.opacity = 1;
            }, 120);

            thumbs.forEach(function(t) {
                t.classList.remove('is-active');
            });
            thumb.classList.add('is-active');

            if (counterEl) counterEl.textContent = thumb.getAttribute('data-index');
        });
    });

    // Zoom Effect
    const zoomWrap = document.getElementById('qv-zoom-wrap');
    if (zoomWrap && mainImg) {
        zoomWrap.addEventListener('mousemove', function(e) {
            const rect = zoomWrap.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            mainImg.style.transformOrigin = `${x}% ${y}%`;
        });
        zoomWrap.addEventListener('mouseenter', function() {
            mainImg.style.transform = 'scale(1.35)';
        });
        zoomWrap.addEventListener('mouseleave', function() {
            mainImg.style.transform = 'scale(1)';
        });
    }

    // Price and Quantity Management
    const qtyValue = document.getElementById('qv-qty-value');
    const addBtn = document.getElementById('qv-add-to-basket');

    function updatePrice() {
        const selectedSize = document.querySelector('#qv-size-group .size-pill.is-selected')?.textContent.trim();
        const selectedColor = document.querySelector('#qv-color-group .color-item.is-selected')?.textContent.trim();
        const quantity = parseInt(qtyValue?.textContent || '1', 10);

        // Find variant based on selected size and color
        const variant = product.variants.find(v => 
            v.display_name === selectedSize && v.color_name === selectedColor
        );

        // 1. Update Price
        const unitPrice = variant ? (variant.selling_price ?? variant.price) : product.price;
        const total = unitPrice * quantity;

        if (addBtn) {
            addBtn.innerHTML = `<i class="ti ti-shopping-cart-plus me-2"></i> Add To Basket - ₹${total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        }

        // 2. Update Stock Status
        const stockStatusEl = document.getElementById('qv-stock-status');
        if (stockStatusEl) {
            const stockDot = stockStatusEl.querySelector('.stock-dot');
            const stockText = stockStatusEl.querySelector('.stock-text');
            const stockQty = variant ? variant.stock_qty : 0;

            if (stockQty <= 0) {
                stockDot.style.backgroundColor = '#ef4444';
                stockText.textContent = 'Out of Stock';
                stockText.className = 'stock-text small fw-semibold text-danger';
                addBtn.disabled = true;
                addBtn.classList.add('disabled');
            } else if (stockQty < 10) {
                stockDot.style.backgroundColor = '#f59e0b';
                stockText.textContent = `Limited Stock: ${stockQty} left`;
                stockText.className = 'stock-text small fw-semibold text-warning';
                addBtn.disabled = quantity > stockQty;
                addBtn.classList.toggle('disabled', quantity > stockQty);
            } else {
                stockDot.style.backgroundColor = '#10b981';
                stockText.textContent = 'In Stock & Ready to Ship';
                stockText.className = 'stock-text small fw-semibold text-success';
                addBtn.disabled = quantity > stockQty;
                addBtn.classList.toggle('disabled', quantity > stockQty);
            }
        }
    }

    // Size selection
    document.getElementById('qv-size-group')?.addEventListener('click', function(e) {
        const btn = e.target.closest('.size-pill');
        if (!btn) return;
        this.querySelectorAll('.size-pill').forEach(b => b.classList.remove('is-selected'));
        btn.classList.add('is-selected');
        updatePrice();
    });

    // Color selection
    document.getElementById('qv-color-group')?.addEventListener('click', function(e) {
        const btn = e.target.closest('.color-item');
        if (!btn) return;
        this.querySelectorAll('.color-item').forEach(b => b.classList.remove('is-selected'));
        btn.classList.add('is-selected');
        updatePrice();
    });

    // Quantity controls
    document.getElementById('qv-qty-minus')?.addEventListener('click', function() {
        if (!qtyValue) return;
        const val = Math.max(1, parseInt(qtyValue.textContent, 10) - 1);
        qtyValue.textContent = val;
        updatePrice();
    });

    document.getElementById('qv-qty-plus')?.addEventListener('click', function() {
        if (!qtyValue) return;
        const val = parseInt(qtyValue.textContent, 10) + 1;
        qtyValue.textContent = val;
        updatePrice();
    });

    // Add to Basket
    addBtn?.addEventListener('click', async function() {
        const selectedSize = document.querySelector('#qv-size-group .size-pill.is-selected');
        const selectedColor = document.querySelector('#qv-color-group .color-item.is-selected');

        if (!selectedSize || !selectedColor) {
            Swal.fire({
                icon: 'warning',
                title: 'Selection Required',
                text: 'Please select both size and color before adding to basket.',
                confirmButtonColor: '#6B62DD'
            });
            return;
        }

        const sizeText = selectedSize.textContent.trim();
        const colorText = selectedColor.textContent.trim();
        const variant = product.variants.find(v => v.display_name === sizeText && v.color_name === colorText);

        if (!variant || variant.stock_qty < parseInt(qtyValue.textContent, 10)) {
            Swal.fire({
                icon: 'error',
                title: 'Insufficient Stock',
                text: `Sorry, only ${variant?.stock_qty ?? 0} items are available.`,
                confirmButtonColor: '#6B62DD'
            });
            return;
        }

        const data = {
            product_id: product.id,
            variant_id: variant ? variant.variant_id : '',
            quantity: qtyValue.textContent,
            _token: window.csrfToken || '' 
        };

        // STRICT DISABLEMENT: Prevent double clicks immediately
        this.disabled = true;
        this.classList.add('disabled');
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Adding...';

        try {
            const response = await fetch('/cart/add', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            
            // Update Cart Badge
            const cartBadge = document.getElementById('cart-badge');
            if (cartBadge && result.cart_count) {
                cartBadge.textContent = result.cart_count;
                cartBadge.style.display = result.cart_count > 0 ? 'block' : 'none';
            }

            Swal.fire({
                icon: 'success',
                title: 'Added!',
                text: result.message,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong. Please try again.',
                confirmButtonColor: '#6B62DD'
            });
        } finally {
            // Re-enable only after price update to ensure state is correct
            updatePrice();
            if (!addBtn.disabled) {
                this.disabled = false;
                this.classList.remove('disabled');
            }
        }
    });

    // Description toggle
    const toggleBtn = document.getElementById('toggleDescription');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            const description = document.getElementById('productDescription');
            description.classList.toggle('collapsed');
            description.classList.toggle('expanded');
            this.innerHTML = description.classList.contains('expanded') ?
                'Read Less <i class="ti ti-chevron-up"></i>' :
                'Read More <i class="ti ti-chevron-down"></i>';
        });
    }

    // Initial price call
    updatePrice();
}
