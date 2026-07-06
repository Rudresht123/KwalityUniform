/**
 * Add Product to Basket
 *
 * @param {HTMLElement|null} button
 * @param {string} productId
 * @param {string|null} variantId
 * @param {number} quantity
 */
async function addToBasket(button, productId, variantId = null, quantity = 1) {

    if (!productId) {
        console.error("Product ID is required.");
        return;
    }

    const originalHtml = button ? button.innerHTML : null;

    try {

        // Disable button
        if (button) {
            button.disabled = true;
            button.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2"></span>
                Adding...
            `;
        }

        const formData = new FormData();

        formData.append("product_id", productId);

        if (variantId) {
            formData.append("variant_id", variantId);
        }

        formData.append("quantity", quantity);

        const response = await fetch("/cart/add", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json"
            },
            body: formData
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {

            updateCartBadge(data.cart_count ?? 0);

            toastr.success(data.message || "Product added to basket.");

        } else {

            toastr.error(data.message || "Unable to add product.");

        }

    } catch (error) {

        console.error("Add To Basket Error:", error);

        toastr.error("Something went wrong. Please try again.");

    } finally {

        if (button) {

            button.disabled = false;
            button.innerHTML = originalHtml;

        }

    }

}

/**
 * Update Cart Badge
 */
function updateCartBadge(count = 0) {

    const badge = document.getElementById("cart-badge");

    if (!badge) return;

    badge.textContent = count;

    badge.style.display = count > 0 ? "flex" : "none";

}
document.addEventListener("click", function (e) {

    const button = e.target.closest(".add-to-cart-btn");

    if (!button) return;

    console.log(button.dataset);

    addToBasket(
        button,
        button.dataset.productId,
        button.dataset.variantId || null,
        parseInt(button.dataset.quantity || 1)
    );

});