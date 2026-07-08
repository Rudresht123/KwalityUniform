@extends('website.components.common')

@section('content')
<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">Order Success!</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li class="active-item">Thank You</li>
        </ul>
    </div>
</div>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="success-card">
                <div class="success-icon">
                    <i class="ti ti-circle-check"></i>
                </div>
                <h2 class="fw-extrabold text-dark mb-3">Thank You for Your Order!</h2>
                <p class="text-muted mb-4">
                    Your uniform order has been placed successfully. We've sent a confirmation email to your registered address.
                </p>
                
                <div class="success-details-box">
                    <div class="success-detail">
                        <span class="detail-label">Order Status:</span>
                        <span class="detail-value badge bg-success-subtle text-success">Processing</span>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center mt-5">
                    <a href="{{ route('website.shop') }}" class="btn-success-primary">
                        <i class="ti ti-shopping-cart me-2"></i> Continue Shopping
                    </a>
                    <a href="{{ route('website.shop') }}" class="btn-success-secondary">
                        View My Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.success-card {
    background: #fff;
    border-radius: 24px;
    padding: 60px 40px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    border: 1px solid #EDEFF3;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: #DCFCE7;
    color: #059669;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin: 0 auto 24px;
}

.success-details-box {
    background: #F8FAFC;
    border-radius: 16px;
    padding: 20px;
    border: 1px solid #E2E8F0;
    display: inline-block;
    min-width: 300px;
}

.success-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    font-size: 14px;
}

.detail-label {
    color: #6B7280;
    font-weight: 600;
}

.detail-value {
    font-weight: 700;
}

.btn-success-primary {
    background: #1E3A8A;
    color: #fff;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: background 0.2s;
}

.btn-success-primary:hover {
    background: #16296b;
    color: #fff;
}

.btn-success-secondary {
    background: #fff;
    color: #1E3A8A;
    border: 1px solid #1E3A8A;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.2s;
}

.btn-success-secondary:hover {
    background: #F5F7FF;
    color: #1E3A8A;
}
</style>
@endsection
