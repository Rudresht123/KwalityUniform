@extends('layouts.common')

@section('content')
                    <div class="col-12">
                    <div class="card custom-card">
                       
                        <div class="card-body">
                              <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                            <div>
                                <div class="card-title">Low Stock Management</div>
                                <p class="mb-0 fs-12 mb-3 text-muted">Manage and refill stock for variants that have reached their low
                                    stock threshold.</p>
                            </div>
                        </div>
                            <div class="table-responsive">
                                <table id="stock-table" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Variant</th>
                                            <th>Current Stock</th>
                                            <th>Alert Level</th>
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

    <!-- Add Stock Modal -->
    <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalLabel">Add Stock to Variant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addStockForm" class="no-loader">
                    <div class="modal-body">
                        <input type="hidden" name="variant_id" id="modal_variant_id">

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Variant SKU</label>
                                    <input type="text" id="modal_sku" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Current Stock</label>
                                    <input type="number" id="modal_current_stock" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Quantity to Add</label>
                                    <input type="number" name="quantity" id="modal_quantity" class="form-control" required
                                        min="1">
                                    <small class="text-muted">Must be a positive integer.</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <textarea name="remarks" id="modal_remarks" class="form-control" rows="3"
                                        placeholder="e.g. Vendor refill, inventory correction"></textarea>
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


        <script>
            $(document).ready(function() {

                initDataTable('#stock-table', {
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('stock.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'product_name',
                            name: 'product_name'
                        },
                        {
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'variant_details',
                            name: 'variant_details',
                            searchable: false
                        },
                        {
                            data: 'stock_qty',
                            name: 'stock_qty'
                        },
                        {
                            data: 'low_stock_alert',
                            name: 'low_stock_alert'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            searchable: false
                        },
                        {
                            data: 'options',
                            name: 'options',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

            // Open Add Stock Modal
            $(document).on('click', '.btn-add-stock', function() {
                const variantId = $(this).data('id');
                const row = $(this).closest('tr');

                const sku = row.find('td:eq(2)').text();
                const currentStock = row.find('td:eq(4)').text();

                $('#modal_variant_id').val(variantId);
                $('#modal_sku').val(sku);
                $('#modal_current_stock').val(currentStock);
                $('#modal_quantity').val('');
                $('#modal_remarks').val('');

                $('#addStockModal').modal('show');
            });

            // Submit Add Stock Form
            $('#addStockForm').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                const submitBtn = $(this).find('button[type="submit"]');
                const originalBtnText = submitBtn.html();

                // Show loader
                submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');

                $.ajax({
                    url: '{{ route('stock-adjustment.adjust') }}',
                    type: 'POST',
                    data: formData + '&_token={{ csrf_token() }}',
                    success: function(response) {
                        toastr.success(response.message);
                        $('#addStockModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                    },
                    complete: function() {
                        // Hide loader
                        submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });
            
        </script>

@endsection
