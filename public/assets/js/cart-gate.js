$(document).ready(function() {
    $('#cart-icon-link').on('click', function(e) {
        e.preventDefault();
        
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        if (isAuthenticated) {
            // Use the same AJAX loading pattern as product-details
            loadModal("{{ route('website.cart.index') }}", 'cartModal');
        } else {
            // Trigger the Login Modal
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }
    });
});
