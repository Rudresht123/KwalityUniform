@extends('layouts.common')

@section('content')
<div class="page-content">
    <div class="container-fluid">
   

        <div class="row mb-4">
            <div class="col-lg-12">
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('school-product-approval.index') }}">
                            <i class="ti ti-clock"></i> Pending Approvals
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('school-product-approval.approved') }}">
                            <i class="ti ti-check"></i> Approved Products
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="approved-products-table" class="table datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Vendor</th>
                                        <th>Category</th>
                                        <th>Product Code</th>
                                        <th>Approved Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

@push('scripts')
<script>
    $(document).ready(function() {
        const table = initializeDatatable('#approved-products-table',{
            processing: true,
            serverSide: true,
            ajax: '{{ route("school-product-approval.approved") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_image', name: 'product_image', orderable: false, searchable: false },
                { data: 'product_name', name: 'product_name' },
                { data: 'vendor_name', name: 'vendor_name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'product_code', name: 'product_code' },
                { data: 'approved_date', name: 'approved_date' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
        });

        $(document).on('click', '.btn-preview', function() {
            const productId = $(this).data('id');
            $('#previewModal').modal('show');
            $('#preview-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading product details...</p></div>');

            $.ajax({
                url: '{{ route("product-preview.show", ":id") }}'.replace(':id', productId),
                type: 'GET',
                success: function(response) {
                    const p = response.product;
                    const formatPrice = (val) => '₹' + parseFloat(val).toLocaleString('en-IN');

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
                                <h5 class="mb-3">Pricing & Variants</h5>
                                <div class="border rounded overflow-hidden mb-4">
                                    ${variantsHtml || '<div class="p-3 text-center text-muted">No variants available.</div>'}
                                </div>
                            </div>
                        </div>
                    `);
                },
                error: function() {
                    $('#preview-content').html('<div class="alert alert-danger m-3">Failed to load product details.</div>');
                }
            });
        }, '.btn-preview');
    });
</script>
@endpush
@endsection
