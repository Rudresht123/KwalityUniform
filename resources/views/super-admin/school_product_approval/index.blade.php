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
                                <div class="card-title">School Product Approval</div>
                                <p class="mb-0 fs-12 mb-3 text-muted">Review and approve products for your school inventory.</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="school-approval-table" class="table datatable" style="width:100%">
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

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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
                <div class="modal-footer">
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
        const table = $('#school-approval-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route("school-product-approval.index") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_image', name: 'product_image', orderable: false, searchable: false },
                { data: 'product_name', name: 'product.product_name' },
                { data: 'vendor_name', name: 'vendor_name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'product_code', name: 'product_code' },
                { data: 'approved_date', name: 'approved_date' },
                { data: 'school_approval_status', name: 'school_approval_status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
        });



        // Preview
        $(document).on('click', '.btn-preview', function() {
            const productId = $(this).data('id');
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
        });

        // Approve
        $(document).on('click', '.btn-approve', function() {
            const productId = $(this).data('id');
            if (confirm('Are you sure you want to approve this product for the school?')) {
                $.ajax({
                    url: '{{ route("school-product-approval.approve") }}',
                    type: 'POST',
                    data: { product_id: productId, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        toastr.success(response.message);
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Something went wrong');
                    }
                });
            }
        });

        // Reject
        $(document).on('click', '.btn-reject', function() {
            const productId = $(this).data('id');
            $('#reject_product_id').val(productId);
            $('#reject_reason').val('');
            $('#rejectModal').modal('show');
        });

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
                    table.ajax.reload();
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message || 'Something went wrong');
                }
            });
        });
    });
</script>
@endpush
@endsection
