@extends('layouts.common')

@section('content')
<style>
    :root {
        --primary-color: #6B62DD;
        --primary-hover: #5a52c7;
        --surface-color: #FFFFFF;
        --bg-color: #F8F9FA;
        --accent-sale: #FF4D4D;
        --accent-stock: #2ECC71;
        --text-primary: #212529;
        --text-secondary: #6C757D;
        --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
        --card-radius: 16px;
        --btn-radius: 12px;
        --transition-smooth: all 0.3s ease;
    }

    body {
        background-color: var(--bg-color);
        font-family: 'Inter', 'Poppins', sans-serif;
    }

    .premium-category-page {
        padding-top: 2rem;
        padding-bottom: 4rem;
    }

    /* Sticky Sidebar */
    .filter-sidebar {
        position: sticky;
        top: 80px;
        z-index: 100;
    }

    .filter-card {
        background: var(--surface-color);
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        border: none;
        padding: 1.5rem;
    }

    /* Custom Components */
    .color-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition-smooth);
        display: inline-block;
        margin-right: 8px;
    }

    .color-circle:hover, .color-circle.active {
        border-color: var(--primary-color);
        transform: scale(1.2);
    }

    /* Product Card */
    .product-card {
        background: var(--surface-color);
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        border: none;
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: var(--card-radius) var(--card-radius) 0 0;
    }

    .product-image-wrapper img {
        transition: var(--transition-smooth);
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .product-card:hover .product-image-wrapper img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 10;
        border-radius: 8px;
        padding: 4px 12px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    .action-overlay {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        padding: 12px;
        transition: var(--transition-smooth);
        display: flex;
        justify-content: center;
        gap: 10px;
        z-index: 20;
    }

    .product-card:hover .action-overlay {
        bottom: 0;
    }

    .btn-premium {
        border-radius: var(--btn-radius);
        padding: 8px 20px;
        font-weight: 500;
        transition: var(--transition-smooth);
    }

    .btn-primary-premium {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-primary-premium:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: white;
    }

    /* Banner Slider */
    .premium-banner {
        border-radius: var(--card-radius);
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
    }

    .banner-item {
        position: relative;
        height: 350px;
    }

    .banner-content {
        position: absolute;
        top: 50%;
        left: 10%;
        transform: translateY(-50%);
        z-index: 10;
        color: white;
        max-width: 500px;
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 100%);
    }

    /* Mobile FAB */
    .mobile-filter-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1050;
        border-radius: 50px;
        padding: 12px 24px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        display: none;
    }

    @media (max-width: 991.98px) {
        .mobile-filter-btn {
            display: block;
        }
    }
</style>

<div class="premium-category-page">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar (Desktop) -->
            <aside class="col-lg-3 d-none d-lg-block">
                <div class="filter-sidebar">
                    @include('school.products.partials.filter-panel')
                </div>
            </aside>

            <!-- Right Content Area -->
            <main class="col-lg-9">
                <!-- Header Section -->
                <div class="category-header mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Home</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Categories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">School Uniforms</li>
                        </ol>
                    </nav>
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <div>
                            <h1 class="fw-bold text-primary mb-2">School Uniforms</h1>
                            <p class="text-secondary">Explore our premium collection of durable and comfortable school uniforms tailored for excellence.</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">1,240 Products Found</span>
                        </div>
                    </div>

                    <!-- Toolbar -->
                    <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded-4 shadow-sm">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle btn-premium" type="button" data-bs-toggle="dropdown">
                                    Sort By: <span class="fw-medium">Featured</span>
                                </button>
                                <ul class="dropdown-menu shadow-sm border-0 rounded-3">
                                    <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                    <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                                    <li><a class="dropdown-item" href="#">Newest Arrivals</a></li>
                                    <li><a class="dropdown-item" href="#">Customer Rating</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary btn-sm rounded-start-3" title="Grid View"><i class="ti ti-grid"></i></button>
                                <button class="btn btn-outline-secondary btn-sm rounded-end-3" title="List View"><i class="ti ti-list"></i></button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small">Showing 1-20 of 1,240</span>
                        </div>
                    </div>
                </div>

                <!-- Premium Banner Slider -->
                <div id="categoryBannerCarousel" class="carousel slide premium-banner" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#categoryBannerCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#categoryBannerCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#categoryBannerCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="banner-item">
                                <div class="banner-overlay"></div>
                                <img src="https://images.unsplash.com/photo-1503917978769-5735821f397f?q=80&w=1200&h=350&auto=format&fit=crop" class="d-block w-100 h-100" style="object-fit: cover;" alt="Banner 1">
                                <div class="banner-content">
                                    <h2 class="display-5 fw-bold mb-3">Premium Blazers</h2>
                                    <p class="lead mb-4">Exquisite tailoring for a professional school appearance.</p>
                                    <a href="#" class="btn btn-primary-premium btn-premium btn-lg">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner-item">
                                <div class="banner-overlay"></div>
                                <img src="https://images.unsplash.com/photo-1523050854058-86bc92a4a51f?q=80&w=1200&h=350&auto=format&fit=crop" class="d-block w-100 h-100" style="object-fit: cover;" alt="Banner 2">
                                <div class="banner-content">
                                    <h2 class="display-5 fw-bold mb-3">Comfort First</h2>
                                    <p class="lead mb-4">Breathable fabrics designed for all-day wear and activity.</p>
                                    <a href="#" class="btn btn-primary-premium btn-premium btn-lg">Explore Collection</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner-item">
                                <div class="banner-overlay"></div>
                                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=1200&h=350&auto=format&fit=crop" class="d-block w-100 h-100" style="object-fit: cover" alt="Banner 3">
                                </div>
                                <div class="banner-content">
                                    <h2 class="display-5 fw-bold mb-3">Seasonal Offers</h2>
                                    <p class="lead mb-4">Get up to 30% off on winter uniform bundles.</p>
                                    <a href="#" class="btn btn-primary-premium btn-premium btn-lg">Grab Deal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#categoryBannerCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#categoryBannerCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <!-- Product Grid -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5" id="productGrid">
                    <!-- Product Card Start -->
                    @for ($i = 0; $i < 12; $i++)
                    <div class="col">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <span class="product-badge bg-danger text-white">Sale -20%</span>
                                <div id="carousel-{{ $i }}" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="https://images.unsplash.com/photo-1503917978769-5735821f397f?q=80&w=400&h=500&auto=format&fit=crop" alt="Product Image 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="https://images.unsplash.com/photo-1523050854058-86bc92a4a51f?q=80&w=400&h=500&auto=format&fit=crop" alt="Product Image 2">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $i }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" style="width: 20px;"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $i }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" style="width: 20px;"></span>
                                    </button>
                                </div>
                                <div class="action-overlay">
                                    <button class="btn btn-light btn-sm rounded-circle" title="Wishlist"><i class="ti ti-heart"></i></button>
                                    <button class="btn btn-light btn-sm rounded-circle" title="Quick View"><i class="ti ti-eye"></i></button>
                                    <button class="btn btn-light btn-sm rounded-circle" title="Compare"><i class="ti ti-arrows-exchange"></i></button>
                                </div>
                            </div>
                            <div class="p-3 flex-grow-1 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <span class="text-muted small fw-medium">Elite Uniforms</span>
                                    <div class="rating small">
                                        <i class="ti ti-star-filled text-warning"></i> 4.5 <span class="text-muted">(120)</span>
                                    </div>
                                </div>
                                <h6 class="fw-bold mb-1 text-truncate">Premium School Blazer - Navy Blue</h6>
                                <p class="text-secondary small mb-2 text-truncate-2">High-quality wool blend blazer with reinforced stitching.</p>
                                
                                <div class="mb-3">
                                    <div class="d-flex gap-1 mb-2">
                                        <span class="color-circle active" style="background-color: #000080;"></span>
                                        <span class="color-circle" style="background-color: #4B0082;"></span>
                                        <span class="color-circle" style="background-color: #000000;"></span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach(['S', 'M', 'L', 'XL'] as $size)
                                            <span class="badge bg-light text-dark border px-2 py-1">{{ $size }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="fs-5 fw-bold text-primary">$89.00</span>
                                        <span class="text-muted text-decoration-line-through small">$110.00</span>
                                        <span class="badge bg-danger-transparent text-danger small">-20%</span>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary btn-premium btn-sm">Add to Cart</button>
                                        <button class="btn btn-primary-premium btn-premium btn-sm">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Pagination -->
                <div class="d-flex flex-column align-items-center gap-3 mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link border-0 rounded-circle mx-1" href="#"><i class="ti ti-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link border-0 rounded-circle mx-1" href="#">1</a></li>
                            <li class="page-item"><a class="page-link border-0 rounded-circle mx-1" href="#">2</a></li>
                            <li class="page-item"><a class="page-link border-0 rounded-circle mx-1" href="#">3</a></li>
                            <li class="page-item"><a class="page-link border-0 rounded-circle mx-1" href="#"><i class="ti ti-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                    <span class="text-muted small">Showing 1 to 20 of 1,240 Products</span>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Mobile Filter Button -->
<button class="btn btn-primary-premium mobile-filter-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter">
    <i class="ti ti-filter me-2"></i> Filter
</button>

<!-- Mobile Filter Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFilter">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="offcanvasFilterLabel">Filters</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body bg-light">
        @include('school.products.partials.filter-panel')
    </div>
</div>
