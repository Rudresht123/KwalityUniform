@extends('website.components.common')

@section('content')



<!-- ================= Hero Banner ================= -->
<div class="geo-page-header">
    <div class="geo-page-header-overlay"></div>

    <div class="container">
        <span class="badge-geo mb-3">eSchoolKart</span>

        <h1 class="display-4 fw-bold text-white mb-3">
            Recently Viewed Products
        </h1>

        <p class="text-white-50 fs-5 col-lg-7">
Pick up right where you left off with your favorite garments
        </p>

        <ul class="geo-breadcrumb mt-4">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>&bull;</li>
            <li class="active-item">Recent Viewed</li>
        </ul>
    </div>
</div>


<div class="container py-5">
    @if($products && $products->count() > 0)
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100 shadow-sm border-0 rounded-4 overflow-hidden transition-all">
                        <div class="product-image-wrap position-relative">
                            <a href="{{ route('website.product.show', $product->product_id) }}">
                                <img src="{{ $product->images->first() ? getFileUrl($product->images->first()->file_id) : asset('assets/images/placeholder-product.jpg') }}" 
                                     class="img-fluid w-100" alt="{{ $product->product_name }}" 
                                     style="height: 250px; object-fit: cover;">
                            </a>
                            <div class="product-badge position-absolute top-0 start-0 m-3">
                                <span class="badge bg-primary rounded-pill">Recently Viewed</span>
                            </div>
                        </div>
                        
                        <div class="p-3 text-center">
                            <h6 class="fw-bold mb-1 text-truncate">{{ $product->product_name }}</h6>
                            <p class="text-muted small mb-2">{{ $product->category?->category_name ?? 'Uniform' }}</p>
                            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                                <span class="fw-bold text-primary fs-5">₹{{ number_format($product->price, 2) }}</span>
                            </div>
                            <a href="{{ route('website.product.show', $product->product_id) }}" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-bold">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12 text-center py-5">
            <div class="empty-state">
                <i class="ti ti-history-off display-1 text-muted mb-3"></i>
                <h4 class="fw-bold">No Recently Viewed Products</h4>
                <p class="text-muted">Explore our shop to find your perfect school uniform!</p>
                <a href="{{ route('website.shop') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold mt-3">
                    Visit Shop
                </a>
            </div>
        </div>
    @endif
</div>

@endsection