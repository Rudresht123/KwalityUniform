@extends('layouts.common')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20 tasks">
                    <div class="card-body">
                        <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                            <div>
                                <div class="card-title">My Approved Products</div>
                                <p class="mb-0 fs-12 mb-3 text-muted">View products approved for your school.</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="school-products-table" class="table datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Vendor</th>
                                        <th>Category</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Product Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="preview-content">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        const table = $('#school-products-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route("school.products.index") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_image', name: 'product_image', orderable: false, searchable: false },
                { data: 'product_name', name: 'product.product_name' },
                { data: 'vendor_name', name: 'vendor_name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
        });

        window.previewProduct = function(productId) {
            $('#previewModal').modal('show');
            $('#preview-content').html('<div class="text-center"><div class="spinner-border text-primary" role="status"></div><p>Loading product details...</p></div>');

            $.ajax({
                url: '{{ route("product-preview.show", ":id") }}'.replace(':id', productId),
                type: 'GET',
                success: function(response) {
                    const p = response.product;
                    let variantsHtml = p.variants.map(v => `<li>${v.sku} - ${v.selling_price} (Stock: ${v.stock_qty})</li>`).join('');
                    
                    $('#preview-content').html(`
                        <div class="row">
                            <div class="col-md-5 text-center">
                                <img src="${p.first_image || '/assets/images/no_image.jpg'}" class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-md-7">
                                <h3>${p.product_name}</h3>
                                <p class="text-muted">${p.description || 'No description available.'}</p>
                                <hr>
                                <h5>Details</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Vendor:</strong> ${p.vendor ? p.vendor.business_name : 'N/A'}</li>
                                    <li><strong>Category:</strong> ${p.category ? p.category.category_name : 'N/A'}</li>
                                    <li><strong>Code:</strong> ${p.product_code}</li>
                                </ul>
                                <h5 class="mt-3">Variants</h5>
                                <ul class="list-group list-group-flush">
                                    ${variantsHtml || '<li>No variants available.</li>'}
                                </ul>
                            </div>
                        </div>
                    `);
                },
                error: function() {
                    $('#preview-content').html('<div class="alert alert-danger">Failed to load product details.</div>');
                }
            });
        };
    });
</script>
@endpush
@endsection
