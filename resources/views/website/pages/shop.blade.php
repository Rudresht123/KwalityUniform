@extends('website.components.common')


@section('content')
    <!-- Page Header (Full Width Banner with Background Image) -->
    <div class="geo-page-header"
        style="background-image: url('https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&q=80&w=1200');">
        <div class="container">
            <h1 class="display-6 fw-extrabold text-white mb-2">Uniform Catalogue</h1>
            <ul class="geo-breadcrumb mb-0">
                <li><a href="index.html">Home</a></li>
                <li>&bull;</li>
                <li class="active-item">Uniform Catalogue</li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container py-5">

        <div class="row g-4">

            <!-- Left Sidebar: Filters (Geometric Balance styled panel with 20px corners) -->
            <div class="col-lg-3">
                <div class="card-geo p-4" style="position: sticky; top: 100px;">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <h5 class="fw-bold mb-0" style="font-size: 16px;">Filter Garments</h5>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                    </div>

                    <!-- Keyword Search -->
                    <div class="mb-4">
                        <label for="shop-search-input" class="form-label small fw-semibold">Search Catalogue</label>
                        <input type="text" id="shop-search-input" class="form-control"
                            placeholder="Blazers, trousers, ties..." />
                    </div>

                    <!-- School Portal Filter -->
                    <div class="mb-4">
                        <label for="shop-school-select" class="form-label small fw-semibold">School Portal</label>
                        <select id="shop-school-select" class="form-select">
                            <option value="all">All Partner Schools</option>
                            <option value="st-marys">Delhi Public School (DPS)</option>
                            <option value="oakwood">St. Xavier's High School</option>
                            <option value="crestview">DAV Public School</option>
                            <option value="pinecrest">Army Public School (APS)</option>
                            <option value="generic">Essential Wear (No School Crest)</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label for="shop-category-select" class="form-label small fw-semibold">Garment Category</label>
                        <select id="shop-category-select" class="form-select">
                            <option value="all">All Categories</option>
                            <option value="blazers">Blazers & Jackets</option>
                            <option value="shirts">Shirts & Blouses</option>
                            <option value="polo">Polo Shirts</option>
                            <option value="trousers">Trousers & Chinos</option>
                            <option value="skirts">Skirts & Kilts</option>
                            <option value="sweaters">Sweaters & Cardigans</option>
                            <option value="sportswear">Physical Education Set</option>
                            <option value="ties">Official Ties</option>
                            <option value="bags">Backpacks & Gear</option>
                        </select>
                    </div>

                    <!-- Bundle Deal Toggle -->
                    <div class="mb-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="shop-bundle-switch">
                            <label class="form-check-label small fw-semibold" for="shop-bundle-switch">Complete Starter
                                Kits</label>
                        </div>
                        <span class="text-muted" style="font-size: 11px; display: block; margin-top: 4px;">Shows bundles
                            featuring crests, pants, and shirts (Save 15%)</span>
                    </div>
                </div>
            </div>

            <!-- Right Content: Products Grid -->
            <div class="col-lg-9">

                <!-- Grid Header (Sorters and info counts) -->
                <div class="card-geo p-3 mb-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="small fw-semibold text-secondary">
                        Showing <span id="shop-results-count" class="text-dark">0</span> garments matching criteria
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-muted" style="white-space: nowrap;">Sort by:</span>
                        <select id="shop-sort-select" class="form-select form-select-sm"
                            style="width: 180px; padding: 6px 12px; font-size: 12px;">
                            <option value="relevance">Relevance / Popular</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="rating">Highest Rated</option>
                        </select>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="shop-empty-state" class="text-center py-5 card-geo" style="display: none;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#6B7280"
                        stroke-width="1.5" class="mb-3">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <h4 class="fw-bold">No garments found</h4>
                    <p class="text-muted small">Try relaxing your search terms or picking another school portal.</p>
                </div>

                <!-- Products Listing Grid -->
                <div class="row g-4" id="shop-products-grid">
                    <!-- Dynamically populated via assets/js/app.js -->
                </div>

            </div>

        </div>

    </main>
@endsection
