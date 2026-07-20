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
    <main class="container-fluid py-5">

        <div class="row g-4">

            <!-- Left Sidebar: Filters (Geometric Balance styled panel with 20px corners) -->
            <div class="col-lg-3 c">
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
                        <select id="shop-school-select" class="select2">
                            <option value="">-- Select School --</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->school_id }}"
                                    {{ request('school') == $school->school_id ? 'selected' : '' }}>
                                    {{ $school->school_name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <!-- Category Filter -->
                    <div class="mb-4" id="shop-category-select-container">
                        <label for="shop-category-select" class="form-label small fw-semibold">Garment Category</label>
                        <select id="shop-category-select" class="select2">
                            <option value="all">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->parent_id }}"
                                    {{ request('parent_category') == $category->parent_id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subcategory Filter -->
                    <div class="mb-4" id="shop-subcategory-filter-container"
                        style="{{ request('parent_category') ? '' : 'display:none' }}">
                        <label for="shop-subcategory-select" class="form-label small fw-semibold">Sub-Category</label>
                        <select id="shop-subcategory-select" class="select2">
                            <option value="all">All Sub-Categories</option>
                            @foreach ($subCategories as $subCategory)
                                <option value="{{ $subCategory->category_id }}"
                                    {{ request('sub_category') == $subCategory->category_id ? 'selected' : '' }}>
                                    {{ $subCategory->category_name }}</option>
                            @endforeach
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
                        <select id="shop-sort-select" class="select2"
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
                <div class="position-relative">
                    <div id="shop-loader"
                        class="d-none position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                        style="background: rgba(255,255,255,0.7); z-index: 10; border-radius: 20px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="shop-ajax-container">
                        <div class="row g-4" id="shop-products-grid">
                            @include('website.partials.shop-products')
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schoolSelect = document.getElementById('shop-school-select');
            const classSelect = document.getElementById('shop-class-select');
            const classContainer = document.getElementById('shop-class-filter-container');
            const categorySelect = document.getElementById('shop-category-select');
            const subcategorySelect = document.getElementById('shop-subcategory-select');
            const subcategoryContainer = document.getElementById('shop-subcategory-filter-container');
            const searchInput = document.getElementById('shop-search-input');
            const ajaxContainer = document.getElementById('shop-ajax-container');
            const loader = document.getElementById('shop-loader');

            async function shopAjaxFilter() {

                const school = schoolSelect.value;
                const classVal = classSelect ? classSelect.value : 'all';
                const category = categorySelect.value;
                const subcategory = subcategorySelect ? subcategorySelect.value : 'all';
                const search = searchInput.value.trim();

                // Build URL
                const params = new URLSearchParams();
                if (school) params.append('school', school);
                if (classVal !== 'all') params.append('class', classVal);
                if (category !== 'all') params.append('parent_category', category);
                if (subcategory !== 'all') params.append('sub_category', subcategory);
                if (search) params.append('search', search);

                const url = `{{ route('website.shop') }}?${params.toString()}`;



                // Show loader
                loader.classList.remove('d-none');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const html = await response.text();

                    // Update content
                    ajaxContainer.innerHTML = html;

                    // Update URL
                    window.history.pushState({}, '', url);
                } catch (error) {
                    console.error('Filtering error:', error);
                } finally {
                    loader.classList.add('d-none');
                }
            }

            // Handle school change (removed standard population logic)
            $(document).on('change', '#shop-school-select', async function() {
                shopAjaxFilter();
            });

            // Handle category change to update subcategories
            $(document).on('change', '#shop-category-select', async function() {
                const parentCategoryId = $(this).val();

                if (parentCategoryId === 'all') {
                    subcategoryContainer.style.display = 'none';
                    if (subcategorySelect) {
                        subcategorySelect.value = 'all';
                        $(subcategorySelect).trigger('change.select2');
                    }
                } else {
                    subcategoryContainer.style.display = 'block';

                    try {
                        const url = "{{ route('website.shop.subcategories', ':parent_id') }}"
                            .replace(':parent_id', parentCategoryId);

                        const response = await fetch(url);
                        const data = await response.json();

                        if (data.success) {
                            let options = '<option value="all">All Sub-Categories</option>';
                            data.subCategories.forEach(s => {
                                options +=
                                    `<option value="${s.category_id}">${s.category_name}</option>`;
                            });
                            if (subcategorySelect) {
                                subcategorySelect.innerHTML = options;
                                $(subcategorySelect).trigger('change.select2');
                            }
                        }
                    } catch (error) {
                        console.error('Error fetching subcategories:', error);
                    }
                }
                shopAjaxFilter();
            });

            // Debounce function for search input
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Attach listeners
            $(document).on('change', '.select2', function() {
                // Avoid double calling for school select since we have a specific listener
                if (this.id !== 'shop-school-set' && this.id !== 'shop-category-select') {
                    shopAjaxFilter();
                }
            });
            searchInput?.addEventListener('input', debounce(shopAjaxFilter, 500));

            // OBSERVER FOR DYNAMIC MODAL CONTENT
            // This ensures that when the product description modal is loaded via AJAX, 
            // the variant and stock logic is initialized.
            const modalBody = document.querySelector('.modal-body');
            if (modalBody) {
                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                            const quickViewWrap = document.querySelector('.quick-view-wrap');
                            if (quickViewWrap) {
                                window.initProductDetails(quickViewWrap);
                            }
                        }
                    });
                });
                observer.observe(modalBody, { childList: true, subtree: true });
            }

            // Event delegation for pagination links

            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    const url = e.target.closest('.pagination a').href;

                    loader.classList.remove('d-none');
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            ajaxContainer.innerHTML = html;
                            window.history.pushState({}, '', url);
                        })
                        .catch(err => console.error('Pagination error:', err))
                        .finally(() => loader.classList.add('d-none'));
                }
            });
        });
    </script>



    <style>
        .quick-view-swiper {
            width: 100%;
            height: 100%;
            aspect-ratio: 1/1;
        }

        .quick-view-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .quick-view-swiper .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .quick-view-swiper .swiper-button-next,
        .quick-view-swiper .swiper-button-prev {
            color: var(--qu-primary);
        }

        .quick-view-swiper .swiper-pagination-bullet-active {
            background: var(--qu-primary);
        }
    </style>

    @include('layouts.modals.editmodal', [
        'modalId' => 'productShow',
        'title' => 'Product Details',
        'modalClass' => 'qv-modal-premium',
        'subtitle' => 'Uniform specification & availability',
        'showFooter' => false,
        'buttonText' => 'Add To Basket',
    ])

    <script src="{{ asset('assets/product-details.js') }}" defer></script>

@endsection
