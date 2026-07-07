/**
 * Product Details Management
 * Compatible with both full details page and quick-view modal.
 */
window.initProductDetails = function (root = document) {
    const findEl = (selectors) => {
        for (const s of selectors) {
            const el = root.getElementById ? root.getElementById(s) : root.querySelector(`#${s}`);
            if (el) return el;
            const q = root.querySelector(s);
            if (q) return q;
        }
        return null;
    };

    const variantsDataEl = findEl(['product-variants-data', '#product-variants-data']);
    if (!variantsDataEl) return;

    const variants = JSON.parse(variantsDataEl.textContent);
    const colorContainer = findEl(['details-colors-container', 'qv-color-group', '#details-colors-container', '#qv-color-group']);
    const sizeContainer = findEl(['details-sizes-container', 'qv-size-group', '#details-sizes-container', '#qv-size-group']);
    const addBtn = findEl(['details-add-btn', 'qv-add-to-basket', '#details-add-btn', '#qv-add-to-basket']);
    const priceEl = findEl(['details-price', 'product-price', '#details-price', '.product-price']);
    
    const basePrice = priceEl ? priceEl.dataset.basePrice : '0';
    let selectedColor = null;
    let selectedSize = null;

    function formatPrice(amount) {
        return '₹' + parseFloat(amount).toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateAvailability() {
        const variant = variants.find(v => v.color === selectedColor && v.size === selectedSize);
        
        if (!variant) {
            if (addBtn) {
                addBtn.disabled = true;
                addBtn.innerHTML = 'Select Color & Size';
                addBtn.classList.add('btn-out-of-stock');
            }
            if (priceEl) priceEl.textContent = formatPrice(basePrice);
            return;
        }

        if (priceEl && variant.price !== undefined) {
            priceEl.textContent = formatPrice(variant.price);
        }

        if (addBtn) {
            if (variant.stock <= 0) {
                addBtn.disabled = true;
                addBtn.innerHTML = 'Out of Stock';
                addBtn.classList.add('btn-out-of-stock');
            } else {
                addBtn.disabled = false;
                addBtn.innerHTML = 'Add to Basket';
                addBtn.classList.remove('btn-out-of-stock');
                addBtn.dataset.variantId = variant.variant_id;
            }
        }
    }

    if (colorContainer) {
        const swatches = colorContainer.querySelectorAll('.color-swatch, .color-item');
        swatches.forEach(swatch => {
            const color = swatch.dataset.color;
            const hasStock = variants.some(v => v.color === color && v.stock > 0);
            if (!hasStock) swatch.classList.add('out-of-stock');

            swatch.addEventListener('click', () => {
                if (swatch.classList.contains('out-of-stock')) return;
                swatches.forEach(s => {
                    s.classList.remove('active-selection');
                    s.classList.remove('is-selected');
                });
                swatch.classList.add('active-selection');
                swatch.classList.add('is-selected');
                selectedColor = color;
                updateAvailability();
            });
        });
    }

    if (sizeContainer) {
        const badges = sizeContainer.querySelectorAll('.size-badge, .size-pill');
        badges.forEach(badge => {
            const size = badge.dataset.size;
            const hasStock = variants.some(v => v.size === size && v.stock > 0);
            if (!hasStock) badge.classList.add('out-of-stock');

            badge.addEventListener('click', () => {
                if (badge.classList.contains('out-of-stock')) return;
                badges.forEach(b => {
                    b.classList.remove('active-selection');
                    b.classList.remove('is-selected');
                });
                badge.classList.add('active-selection');
                badge.classList.add('is-selected');
                selectedSize = size;
                updateAvailability();
            });
        });
    }

    updateAvailability();
};

document.addEventListener('DOMContentLoaded', () => {
    window.initProductDetails();
});
