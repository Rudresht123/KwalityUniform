@extends('layouts.common')

@section('content')
    <div class="container-xxl py-4">

        {{-- Page Header --}}


        <div class="row g-4">

            {{-- ── Filters Sidebar ── --}}
            <div class="col-12 col-md-3">
                <form action="{{ route('school.products.index') }}" method="GET"
                    class="card border-0 shadow-sm rounded-3 p-4 sticky-top" style="top:80px">
                    <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-filter text-primary"></i> Filters
                    </h6>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Category</label>
                        <select name="category_id" class="form-select form-select-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-secondary">Gender</label>
                        <select name="gender_type" class="form-select form-select-sm">
                            <option value="">All Genders</option>
                            <option value="boys" {{ request('gender_type') == 'boys' ? 'selected' : '' }}>Boys</option>
                            <option value="girls" {{ request('gender_type') == 'girls' ? 'selected' : '' }}>Girls</option>
                            <option value="unisex" {{ request('gender_type') == 'unisex' ? 'selected' : '' }}>Unisex
                            </option>
                        </select>
                    </div>

                    <button type="submit"
                        class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                        <i class="ti ti-search"></i> Apply Filters
                    </button>
                    <a href="{{ route('school.products.index') }}"
                        class="btn btn-link btn-sm w-100 text-muted text-decoration-none mt-2">
                        Clear Filters
                    </a>
                </form>
            </div>

            {{-- ── Product Grid ── --}}
            <div class="col-12 col-md-9">

                @if (request()->has(['category_id', 'gender_type']))
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4">

                        @forelse($products as $product)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card"
                                    role="button" onclick="openProductDetails('{{ $product->product_id }}')">

                                    {{-- Image --}}
                                    <div class="position-relative overflow-hidden" style="height:220px">
                                        <img src="{{ $product->firstImage() }}" alt="{{ $product->product_name }}"
                                            class="w-100 h-100 object-fit-cover product-thumb">

                                        <div class="position-absolute top-0 end-0 p-2 d-flex flex-column gap-1">
                                            <span class="badge bg-white text-primary shadow-sm small fw-semibold">
                                                {{ $product->category->category_name ?? 'General' }}
                                            </span>
                                            @if ($product->is_school_approved)
                                                <span class="badge bg-success d-flex align-items-center gap-1">
                                                    <i class="ti ti-check" style="font-size:.7rem"></i> Approved
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="card-body d-flex flex-column p-3">
                                        <h6 class="card-title fw-semibold text-dark mb-1 text-truncate">
                                            {{ $product->product_name }}
                                        </h6>
                                        <p class="card-text text-muted small mb-3 flex-grow-1"
                                            style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                            {{ $product->description }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted" style="font-size:.72rem">
                                                <i
                                                    class="ti ti-building-store me-1"></i>{{ $product->vendor->business_name ?? 'N/A' }}
                                            </span>
                                            <span class="text-primary small fw-semibold view-link">
                                                View &rarr;
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5 border border-dashed rounded-3 bg-white">
                                    <i class="ti ti-package-off fs-1 text-muted d-block mb-2"></i>
                                    <p class="text-muted mb-0">No products match your filters.</p>
                                </div>
                            </div>
                        @endforelse

                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    {{-- Empty state --}}
                    <div class="d-flex flex-column align-items-center justify-content-center text-center bg-white border border-2 border-dashed rounded-3 py-5"
                        style="min-height:420px">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-3">
                            <i class="ti ti-search fs-2 text-primary"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Ready to find products?</h5>
                        <p class="text-muted small mb-0" style="max-width:320px">
                            Select a category or gender from the filters to explore available products.
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>


    {{-- ─── Product Detail Modal ─────────────────────────────────────── --}}
    <div class="modal fade" id="product-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <div class="modal-body p-0">
                    <div class="row g-0">

                        {{-- Left — Image Slider --}}
                        <div class="col-12 col-lg-5 bg-light p-4 d-flex flex-column gap-3">
                            <div class="position-relative rounded-3 overflow-hidden bg-white d-flex align-items-center justify-content-center"
                                style="aspect-ratio:1/1">
                                <img id="modal-main-image" src="" alt="Product"
                                    class="img-fluid object-fit-contain w-100 h-100"
                                    style="object-fit:contain;max-height:380px">

                                <button onclick="prevImage()" id="prev-btn"
                                    class="btn btn-light btn-sm rounded-circle position-absolute start-0 top-50 translate-middle-y ms-2 shadow-sm d-none">
                                    <i class="ti ti-chevron-left"></i>
                                </button>
                                <button onclick="nextImage()" id="next-btn"
                                    class="btn btn-light btn-sm rounded-circle position-absolute end-0 top-50 translate-middle-y me-2 shadow-sm d-none">
                                    <i class="ti ti-chevron-right"></i>
                                </button>
                            </div>

                            {{-- Thumbnails --}}
                            <div id="modal-thumbnails" class="d-flex gap-2 overflow-auto pb-1"></div>
                        </div>

                        {{-- Right — Details --}}
                        <div class="col-12 col-lg-7 p-4 p-lg-5 d-flex flex-column justify-content-center">

                            <span id="modal-category"
                                class="badge bg-primary bg-opacity-10 text-primary fw-semibold mb-2 align-self-start"></span>

                            <h3 id="modal-name" class="fw-bold text-dark mb-1"></h3>
                            <p id="modal-vendor" class="text-muted fst-italic mb-4 small"></p>

                            <div class="border-top border-bottom py-3 mb-4">
                                <p class="text-secondary small fw-semibold text-uppercase mb-1">Description</p>
                                <p id="modal-description" class="text-secondary mb-0 lh-lg"></p>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <span class="d-block text-muted"
                                            style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em">Gender</span>
                                        <span id="modal-gender" class="fw-semibold text-dark small"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <span class="d-block text-muted"
                                            style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em">Fabric</span>
                                        <span id="modal-fabric" class="fw-semibold text-dark small"></span>
                                    </div>
                                </div>
                            </div>

                            <button id="approve-btn" onclick="approveProduct()"
                                class="btn btn-primary w-100 py-2 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-check"></i>
                                <span id="approve-btn-text">Approve for my School</span>
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <style>
        .product-card {
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .1) !important;
        }

        .product-thumb {
            transition: transform .4s;
        }

        .product-card:hover .product-thumb {
            transform: scale(1.05);
        }

        .view-link {
            transition: letter-spacing .2s;
        }

        .product-card:hover .view-link {
            letter-spacing: .02em;
        }
    </style>


    <script>
        let currentImages = [];
        let currentImageIndex = 0;
        let currentProductId = null;
        let productModal = null;

        document.addEventListener('DOMContentLoaded', () => {
            productModal = new bootstrap.Modal(document.getElementById('product-modal'));
        });

        async function openProductDetails(productId) {
            currentProductId = productId;
            productModal.show();

            try {
                const response = await fetch(`/school-products/${productId}`);
                const data = await response.json();

                if (data.success) {
                    const p = data.product;
                    currentImages = data.images;
                    currentImageIndex = 0;

                    document.getElementById('modal-name').innerText = p.product_name;
                    document.getElementById('modal-category').innerText = p.category?.category_name || 'General';
                    document.getElementById('modal-vendor').innerText = 'By ' + (p.vendor?.business_name ||
                        'Unknown Vendor');
                    document.getElementById('modal-description').innerText = p.description ||
                        'No description available.';
                    document.getElementById('modal-gender').innerText = p.gender_type;
                    document.getElementById('modal-fabric').innerText = p.fabric_composition || 'Not specified';

                    const approveBtn = document.getElementById('approve-btn');
                    const approveBtnText = document.getElementById('approve-btn-text');

                    if (data.is_school_approved) {
                        approveBtn.className =
                            'btn btn-success w-100 py-2 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2';
                        approveBtnText.innerText = 'Approved for School';
                        approveBtn.onclick = null;
                    } else {
                        approveBtn.className =
                            'btn btn-primary w-100 py-2 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2';
                        approveBtnText.innerText = 'Approve for my School';
                        approveBtn.onclick = approveProduct;
                    }

                    updateSlider();

                    const thumbContainer = document.getElementById('modal-thumbnails');
                    thumbContainer.innerHTML = '';
                    currentImages.forEach((img, idx) => {
                        const thumb = document.createElement('img');
                        thumb.src = img;
                        thumb.className =
                            `rounded-2 border border-2 object-fit-cover flex-shrink-0 ${idx === 0 ? 'border-primary' : 'border-transparent'}`;
                        thumb.style.cssText = 'width:56px;height:56px;cursor:pointer;object-fit:cover';
                        thumb.onclick = () => setIndex(idx);
                        thumbContainer.appendChild(thumb);
                    });

                    document.getElementById('prev-btn').classList.toggle('d-none', currentImages.length <= 1);
                    document.getElementById('next-btn').classList.toggle('d-none', currentImages.length <= 1);
                }
            } catch (error) {
                console.error('Error fetching product details:', error);
            }
        }

        async function approveProduct() {
            if (!currentProductId) return;
            
            const result = await Swal.fire({
                title: 'Approve Product?',
                text: 'Do you want to approve this product for your school catalogue?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6259ca',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve it!'
            });

            if (!result.isConfirmed) return;

            const btn = document.getElementById('approve-btn');
            const btnText = document.getElementById('approve-btn-text');

            btn.disabled = true;
            btnText.innerText = 'Processing…';

            try {
                const response = await fetch(`/school-products/${currentProductId}/approve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        title: 'Approved!',
                        text: data.message || 'Product approved for your school successfully!',
                        icon: 'success',
                        confirmButtonColor: '#6259ca'
                    });

                    btn.className =
                        'btn btn-success w-100 py-2 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2';
                    btnText.innerText = 'Approved for School';
                    btn.onclick = null;
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Error approving product',
                        icon: 'error',
                        confirmButtonColor: '#6259ca'
                    });
                }
            } catch {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#6259ca'
                });
            } finally {
                btn.disabled = false;
            }
        }

        function setIndex(index) {
            currentImageIndex = index;
            updateSlider();
            const thumbs = document.getElementById('modal-thumbnails').children;
            for (let i = 0; i < thumbs.length; i++) {
                thumbs[i].className =
                    `rounded-2 border border-2 object-fit-cover flex-shrink-0 ${i === currentImageIndex ? 'border-primary' : 'border-light'}`;
            }
        }

        function updateSlider() {
            document.getElementById('modal-main-image').src = currentImages[currentImageIndex] || '';
        }

        function prevImage() {
            if (currentImageIndex > 0) setIndex(currentImageIndex - 1);
        }

        function nextImage() {
            if (currentImageIndex < currentImages.length - 1) setIndex(currentImageIndex + 1);
        }
    </script>
@endsection
