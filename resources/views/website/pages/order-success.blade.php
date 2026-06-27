@extends('website.components.common')

@section('content')
    <!-- Main Content -->
    <main class="container py-5">

        <div class="card-geo p-4 p-md-5 text-center max-w-2xl mx-auto my-4">

            <!-- Success Icon -->
            <div
                style="background: var(--qu-badge-bg); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; border: 2px solid var(--qu-primary);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--qu-primary)"
                    stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>

            <span class="badge-geo mb-2">Academic Order Registered</span>
            <h1 class="display-6 fw-extrabold text-dark mb-3" style="color: var(--qu-primary);">Thank You for Shopping</h1>
            <p class="text-secondary mb-4">Your official school uniform order has been successfully logged into our staging
                distribution center.</p>

            <!-- Receipt Box (Geometric styled interior card) -->
            <div class="bg-light p-4 rounded-3 text-start mb-4" style="border: 1px solid var(--qu-border-color);">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Staged Order Identification</span>
                    <span id="success-order-id" class="fw-bold text-dark">QU-921384</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Parent / Customer</span>
                    <span id="success-customer-name" class="fw-bold text-dark">Sarah Jenkins</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Verification Email</span>
                    <span id="success-email" class="fw-bold text-dark">sarah@example.com</span>
                </div>
                <div class="d-flex justify-content-between pt-3 border-top mt-3">
                    <span class="fw-bold text-dark small">Total Authorized Charge</span>
                    <span id="success-total" class="fw-bold text-primary"
                        style="font-family: var(--font-display);">$0.00</span>
                </div>
            </div>

            <div class="alert alert-success small mb-4" style="border-radius: var(--qu-radius-sm); text-align: left;">
                ℹ️ <strong>Distribution Timing:</strong> Your order has been dispatched to your school's central
                administrative fitting office. It will be available for pickup this coming Tuesday at 9:00 AM.
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="index.html" class="btn btn-primary px-4">Return to Home Portal</a>
                <a href="shop.html" class="btn btn-secondary px-4">Shop More Essentials</a>
            </div>

        </div>

    </main>

    <script>
        // Retrieve values from URL query string
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('orderId') || 'QU-' + Math.floor(100000 + Math.random() * 900000);
        const name = urlParams.get('name') || 'Customer';
        const email = urlParams.get('email') || 'parent@example.com';
        const total = urlParams.get('total') || '0.00';

        document.getElementById('success-order-id').innerText = orderId;
        document.getElementById('success-customer-name').innerText = name;
        document.getElementById('success-email').innerText = email;
        document.getElementById('success-total').innerText = '$' + parseFloat(total).toFixed(2);
    </script>
@endsection
