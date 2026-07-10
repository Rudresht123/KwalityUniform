@extends('layouts.common')

@section('content')
<div class="page-content">
    <div class="container-fluid">
  

        <div class="row mb-4">
            <div class="col-lg-12">
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('school-product-approval.index') }}">
                            <i class="ti ti-clock"></i> Pending Approvals
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('school-product-approval.approved') }}">
                            <i class="ti ti-check"></i> Approved Products
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">

            @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card product-card h-100 shadow-sm border-0 overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ $product->firstImage() }}" class="card-img-top product-img" alt="{{ $product->product_name }}">
                            <div class="product-badge">
                                @php
                                    $approval = $product->schoolApprovals->where('school_id', $schoolId)->first();
                                @endphp
                                @if(!$approval)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($approval->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="text-muted fs-11">{{ $product->category->category_name ?? 'Uncategorized' }}</span>
                                <h5 class="card-title mb-1 text-truncate">{{ $product->product_name }}</h5>
                                <p class="text-muted fs-12 mb-2">Vendor: {{ $product->vendor->business_name ?? 'N/A' }}</p>
                            </div>
                            <div class="mt-auto d-flex gap-2">
                                <button class="btn btn-sm btn-primary w-100 btn-preview" data-id="{{ $product->product_id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
         @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            <div class="pagination-style-1">
                @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $products->appends(request()->query())->links() }}
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .product-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        cursor: pointer;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .product-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .product-card:hover .product-img {
        transform: scale(1.05);
    }
    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1;
    }
    .product-card .card-title {
        font-weight: 600;
        color: #333;
    }
    /* Fix for button hover background color */
    .btn-preview:hover {
        background-color: #0056b3 !important; 
        color: #fff !important;
    }
    /* Fix for modal buttons hover */
    #previewModal .btn-success:hover {
        background-color: #198754 !important;
        border-color: #198754 !important;
        color: #fff !important;
    }
    #previewModal .btn-outline-danger:hover {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        color: #fff !important;
    }
</style>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="previewModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="preview-content">
                    <!-- Content loaded via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="rejectModalLabel">Reject Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectProductForm">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="reject_product_id">
                    <div class="form-group">
                        <label class="form-label">Reason for Rejection</label>
                        <textarea name="reason" id="reject_reason" class="form-control" rows="4" required placeholder="Explain why this product is not approved for the school..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Preview
        $(document).on('click', '.btn-preview, .product-card', function(e) {
            if (!$(e.target).closest('.btn-preview').length && !$(e.target).closest('.product-card').length) return;
            
            // Prevent double trigger if clicking btn-preview inside product-card
            const productId = $(this).data('id') || $(this).closest('.product-card').data('id');
            
            // Fix for event propagation and finding the correct ID
            let id = $(this).data('id');
            if(!id) {
                id = $(this).find('.btn-preview').data('id');
            }

            $('#previewModal').modal('show');
            $('#preview-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading product details...</p></div>');

            $.ajax({
                url: '{{ route("product-preview.show", ":id") }}'.replace(':id', id),
                type: 'GET',
                success: function(response) {
                    const p = response.product;
                    
                    // Format currency
                    const formatPrice = (val) => '₹' + parseFloat(val).toLocaleString('en-IN');

                    // Extract unique sizes and colors from variants
                    const sizes = [...new Set(p.variants.map(v => v.size?.size_name || 'N/A'))];
                    const colors = [...new Set(p.variants.map(v => v.color?.color_name || 'N/A'))];

                    let variantsHtml = p.variants.map(v => `
                        <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                            <div>
                                <span class="fw-bold">${v.sku}</span>
                                <span class="text-muted ms-2 fs-12">${v.stock_qty} in stock</span>
                            </div>
                            <span class="fw-bold text-primary">${formatPrice(v.selling_price)}</span>
                        </div>
                    `).join('');
                    
                    $('#preview-content').html(`
                        <div class="row g-0">
                            <div class="col-md-6 bg-light text-center p-4">
                                <img src="${p.first_image || '/assets/images/no_image.jpg'}" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: contain;">
                            </div>
                            <div class="col-md-6 p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="mb-1">${p.product_name}</h4>
                                        <span class="badge bg-info text-dark">${p.category ? p.category.category_name : 'Uncategorized'}</span>
                                    </div>
                                </div>
                                
                                <p class="text-muted mb-4">${p.description || 'No description available.'}</p>
                                
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="text-muted fs-12 mb-0">Vendor</div>
                                        <div class="fw-bold">${p.vendor ? p.vendor.business_name : 'N/A'}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted fs-12 mb-0">Product Code</div>
                                        <div class="fw-bold">${p.product_code}</div>
                                    </div>
                                </div>

                                <h5 class="mb-3">Select Configuration</h5>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold">Size</label>
                                        <select id="preview-size" class="form-select form-select-sm">
                                            <option value="">Select Size</option>
                                            ${sizes.map(s => `<option value="${s}">${s}</option>`).join('')}
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold">Color</label>
                                        <select id="preview-color" class="form-select form-select-sm">
                                            <option value="">Select Color</option>
                                            ${colors.map(c => `<option value="${c}">${c}</option>`).join('')}
                                        </select>
                                    </div>
                                </div>

                                <div class="bg-light p-3 rounded text-center mb-4">
                                    <div class="text-muted small mb-1">Estimated Price</div>
                                    <div id="preview-dynamic-price" class="h4 fw-bold text-primary mb-0">₹0.00</div>
                                    <div class="text-muted" style="font-size: 10px;">Inclusive of all taxes</div>
                                </div>

                                <h5 class="mb-3">All Variants</h5>
                                <div class="border rounded overflow-hidden mb-4">
                                    ${variantsHtml || '<div class="p-3 text-center text-muted">No variants available.</div>'}
                                </div>

                                <div class="d-flex gap-2 mt-auto">
                                    <button id="btn-approve-product" class="btn btn-success flex-grow-1 py-2 fw-bold" data-id="${p.product_id}">
                                        Approve Product
                                    </button>
                                    <button id="btn-reject-product" class="btn btn-outline-danger py-2" data-id="${p.product_id}">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);

                    // Dynamic Price Logic
                    const updatePrice = () => {
                        const selectedSize = $('#preview-size').val();
                        const selectedColor = $('#preview-color').val();
                        
                        // Try to find the most specific variant match
                        let variant = p.variants.find(v => 
                            (selectedSize && v.size?.size_name === selectedSize) && 
                            (selectedColor && v.color?.color_name === selectedColor)
                        );

                        // Fallback to size only match
                        if (!variant && selectedSize) {
                            variant = p.variants.find(v => v.size?.size_name === selectedSize);
                        }

                        // Fallback to color only match
                        if (!variant && selectedColor) {
                            variant = p.variants.find(v => v.color?.color_name === selectedColor);
                        }

                        // Fallback to first variant if nothing selected or no match
                        if (!variant && p.variants.length > 0) {
                            variant = p.variants[0];
                        }

                        if (variant) {
                            $('#preview-dynamic-price').text(formatPrice(variant.selling_price));
                        } else {
                            $('#preview-dynamic-price').text('₹0.00');
                        }
                    };

                    $('#preview-size, #preview-color').on('change', updatePrice);
                    updatePrice(); // Initial call to show first variant price

                    // Attach events to new buttons
                    $('#btn-approve-product').on('click', function() {
                        const productId = $(this).data('id');
                        approveProduct(productId);
                    });

                    $('#btn-reject-product').on('click', function() {
                        const productId = $(this).data('id');
                        $('#reject_product_id').val(productId);
                        $('#reject_reason').val('');
                        $('#rejectModal').modal('show');
                        $('#previewModal').modal('hide');
                    });
                },
                error: function() {
                    $('#preview-content').html('<div class="alert alert-danger m-3">Failed to load product details.</div>');
                }
            });
        }, '.btn-preview, .product-card');

        function approveProduct(productId) {
            if (confirm('Are you sure you want to approve this product for the school?')) {
                $.ajax({
                    url: '{{ route("school-product-approval.approve") }}',
                    type: 'POST',
                    data: { product_id: productId, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Something went wrong');
                    }
                });
            }
        }

        $('#rejectProductForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: '{{ route("school-product-approval.reject") }}',
                type: 'POST',
                data: formData + '&_token={{ csrf_token() }}',
                success: function(response) {
                    toastr.success(response.message);
                    $('#rejectModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    toastr.error(response.message || 'Something went wrong');
                }
            });
        });
    });
</script>
@endpush
@endsection
