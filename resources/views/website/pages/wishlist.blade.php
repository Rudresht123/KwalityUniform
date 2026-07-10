@extends('website.components.common')

@include('layouts.modals.editmodal', [
    'modalId' => 'productShow',
    'title' => 'Product Details',
    'modalClass' => 'qv-modal-premium',
    'subtitle' => 'Uniform specification & availability',
    'showFooter' => false,
    'buttonText' => 'Add To Basket',
])

@section('content')
<div id="toast-container" class="toast-container"></div>
<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">My Wishlist</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li class="active-item">Wishlist</li>
        </ul>
    </div>
</div>

<main class="container py-5">
    <div class="row">
        <div class="col-12">
            @if($wishlistItems->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="ti-heart-off display-1 text-muted opacity-25"></i>
                    </div>
                    <h3 class="fw-bold text-secondary">Your wishlist is empty</h3>
                    <p class="text-muted mb-4">Save your favorite items and come back to them later!</p>
                    <a href="{{ route('website.shop') }}" class="btn btn-primary btn-lg px-5 rounded-pill">
                        <i class="ti-shopping-cart me-2"></i> Start Shopping
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($wishlistItems as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden wishlist-card">
                                <div class="position-relative">
                                    <img src="{{ $item->product->firstImage() }}" class="card-img-top" alt="{{ $item->product->product_name }}" style="height: 250px; object-fit: cover;">
                                    <button class="btn btn-danger btn-remove-wishlist position-absolute top-0 end-0 m-3 rounded-circle p-2" 
                                            data-url="{{ route('website.wishlist.remove', $item->wishlist_item_id ) }}" title="Remove from Wishlist">
                                        <i class="ti-trash"></i>
                                    </button>
                                </div>
                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-dark mb-1">{{ $item->product->product_name }}</h6>
                                    <p class="small text-muted mb-3">{{ $item->variant->display_name ?? 'Standard' }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <span class="fw-bold text-primary fs-5">
                                            ₹{{ number_format($item->variant->selling_price ?? $item->product->variants->first()?->selling_price ?? 0, 2) }}
                                        </span>
                                    </div>
                                    <a href="#" 
                                       class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold editUrl" 
                                       data-url="{{ route('website.product.json', $item->product->product_id) }}" 
                                       data-modalid="productShow">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    {{ $wishlistItems->links() }}
                </div>
            @endif
        </div>
    </div>
</main>

<style>
.wishlist-card { transition: all 0.3s ease; }
.wishlist-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; }
.btn-remove-wishlist { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; }

/* Custom Premium Toast Styles */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.custom-toast {
    min-width: 300px;
    max-width: 400px;
    background: #fff;
    color: #1f2937;
    padding: 16px 20px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 14px;
    border-left: 6px solid #1E3A8A;
    animation: slideInRight 0.3s ease-out forwards;
    transition: all 0.3s ease;
}

.custom-toast.success { border-left-color: #10b981; }
.custom-toast.error { border-left-color: #ef4444; }

.custom-toast .toast-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 18px;
}

.custom-toast.success .toast-icon { background: #dcfce7; color: #10b981; }
.custom-toast.error .toast-icon { background: #fee2e2; color: #ef4444; }

.custom-toast .toast-content { flex-grow: 1; font-size: 14px; font-weight: 500; }
.custom-toast .toast-close {
    cursor: pointer;
    opacity: 0.5;
    transition: opacity 0.2s;
    font-size: 18px;
}
.custom-toast .toast-close:hover { opacity: 1; }

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.fade-out {
    transform: translateX(100%);
    opacity: 0;
}
</style>

<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `custom-toast ${type}`;
        
        const icon = type === 'success' ? 'ti-check' : 'ti-x';
        
        toast.innerHTML = `
            <div class="toast-icon"><i class="ti ${icon}"></i></div>
            <div class="toast-content">${message}</div>
            <div class="toast-close" onclick="this.parentElement.remove()"><i class="ti ti-x"></i></div>
        `;
        
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('fade-out');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    $(document).ready(function() {
        $('.btn-remove-wishlist').click(function() {
            const url = $(this).data('url');
            const btn = $(this);
            
            if(confirm('Remove this item from your wishlist?')) {
                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
                
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        showToast(response.message || 'Removed from wishlist!', 'success');
                        btn.closest('.wishlist-card').fadeOut(400, function() {
                            $(this).remove();
                        });
                        window.location.reload();
                    },
                    error: function() {
                        showToast('Failed to remove item. Please try again.', 'error');
                        btn.prop('disabled', false).html('<i class="ti ti-trash"></i>');
                    }
                });
            }
        });
    });
</script>
<script src="{{ asset('assets/js/product-details.js') }}" defer></script>
@endsection
