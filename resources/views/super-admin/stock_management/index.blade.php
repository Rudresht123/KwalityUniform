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
                                <div class="card-title">Stock Management</div>
                                <p class="mb-0 fs-12 mb-3 text-muted">Comprehensive view of product variants and their stock levels.</p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="stock-mgmt-table" class="table datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Vendor</th>
                                        <th>Category</th>
                                        <th>Stock Info</th>
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


<!-- Adjust Stock Modal -->
<div class="modal fade" id="adjustStockModal" tabindex="-1" aria-labelledby="adjustStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adjustStockModalLabel">Adjust Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="adjustStockForm">
                <div class="modal-body">
                    <input type="hidden" name="variant_id" id="modal_variant_id">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Adjustment Quantity</label>
                                <input type="number" name="quantity" id="modal_quantity" class="form-control" required placeholder="e.g. 10 to add, -10 to remove">
                                <small class="text-muted">Use positive numbers to add and negative numbers to subtract stock.</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" id="modal_remarks" class="form-control" rows="3" placeholder="Reason for adjustment..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Stock History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel">Stock Adjustment History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Old Stock</th>
                                <th>Adjustment</th>
                                <th>New Stock</th>
                                <th>User</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        const table = $('#stock-mgmt-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route("stock-management.index") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_image', name: 'product_image', orderable: false, searchable: false },
                { data: 'product_name', name: 'product.product_name' },
                { data: 'sku', name: 'sku' },
                { data: 'vendor', name: 'product.vendor.business_name' },
                { data: 'category', name: 'product.category.category_name' },
                { data: 'stock_info', name: 'stock_info', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'options', name: 'options', orderable: false, searchable: false },
            ],
        });


        // Adjust Stock
        $(document).on('click', '.btn-success-light', function() {
            const variantId = $(this).attr('onclick').match(/'([^']+)'/)[1];
            $('#modal_variant_id').val(variantId);
            $('#modal_quantity').val('');
            $('#modal_remarks').val('');
            $('#adjustStockModal').modal('show');
        });

        $('#adjustStockForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: '{{ route("stock-adjustment.adjust") }}',
                type: 'POST',
                data: formData + '&_token={{ csrf_token() }}',
                success: function(response) {
                    toastr.success(response.message);
                    $('#adjustStockModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message || 'Something went wrong');
                }
            });
        });

        // View History
        $(document).on('click', '.btn-primary-light', function() {
            const variantId = $(this).attr('onclick').match(/'([^']+)'/)[1];
            $('#historyModal').modal('show');
            
            const historyBody = $('#history-table tbody');
            historyBody.empty();

            $.ajax({
                url: '{{ route("stock-adjustment.history") }}',
                type: 'GET',
                data: { variant_id: variantId },
                success: function(response) {
                    if (response.success) {
                        response.data.forEach(item => {
                            historyBody.append(`
                                <tr>
                                    <td>${item.created_at}</td>
                                    <td>${item.old_stock}</td>
                                    <td>${item.added_quantity}</td>
                                    <td>${item.new_stock}</td>
                                    <td>${item.creator ? item.creator.name : 'N/A'}</td>
                                    <td>${item.remarks || '-'}</td>
                                </tr>
                            `);
                        });
                    }
                },
                error: function() {
                    toastr.error('Failed to load history');
                }
            });
        });
    });
</script>
@endpush
@endsection
