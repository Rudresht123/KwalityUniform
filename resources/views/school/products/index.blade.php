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
            <div class="col-12 col-md-9" >

                @if (count($products)>0)
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4 editUrl" style="max-height:80vh;overflow:scroll">

                        @forelse($products as $product)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card editUrl"
                                    data-url="{{ route('school.products.show', $product->product_id) }}" 
                                    data-modalid="productShow" role="button">

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
                      {{ $products->links('vendor.pagination.custom-pagination') }}
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
    @include('layouts.modals.editmodal', [
        'modalId' => 'productShow',
        'title' => 'Product Details',
        'modalClass' => 'qv-modal-premium',
        'subtitle' => 'Uniform specification & availability',
        'showFooter' => false,
        'buttonText' => 'Add To Basket',
    ])


    <script>
        let currentProductId = null;

        async function handleApproveClick(productId) {
            currentProductId = productId;
            
            const result = await Swal.fire({
                title: 'Approve Product?',
                text: 'Are you sure you want to approve this product for your school?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6259ca',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve it!'
            });

            if (!result.isConfirmed) return;

            const approveBtn = document.querySelector('.btn-approve-school');
            const originalText = approveBtn.innerHTML;
            approveBtn.disabled = true;
            approveBtn.innerHTML = 'Processing…';

            try {
                const response = await fetch(`/school-products/${currentProductId}/approve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        class_ids: []
                    })
                });
                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        title: 'Approved!',
                        text: data.message || 'Product approved for your school successfully!',
                        icon: 'success',
                        confirmButtonColor: '#6259ca'
                    });

                    // Update the button in the product modal if it exists
                    if (approveBtn) {
                        approveBtn.className = 'btn-approve-school approved';
                        approveBtn.innerHTML = '<i class="ti ti-check me-2"></i> Approved for School';
                        approveBtn.onclick = null;
                    }
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Error approving product',
                        icon: 'error',
                        confirmButtonColor: '#6259ca'
                    });
                    approveBtn.disabled = false;
                    approveBtn.innerHTML = originalText;
                }
            } catch {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#6259ca'
                });
                approveBtn.disabled = false;
                approveBtn.innerHTML = originalText;
            }
        }
    </script>
@endsection


