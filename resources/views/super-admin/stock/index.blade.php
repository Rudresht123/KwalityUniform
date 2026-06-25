@extends('layouts.common')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Low Stock Management</h4>
                        <p class="card-subtitle">Manage and refill stock for variants that have reached their low stock threshold.</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="stock-table" class="table table-striped table-bordered" style="width:100%">
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
            <form id="addStockForm">
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
                                <input type="number" name="quantity" id="modal_quantity" class="form-control" required min="1">
                                <small class="text-muted">Must be a positive integer.</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" id="modal_remarks" class="form-control" rows="3" placeholder="e.g. Vendor refill, inventory correction"></textarea>
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

@push('scripts')
<script>
    $(document).ready(function() {
        const table = $('#stock-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("stock.index") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_name', name: 'product.product_name' },
                { data: 'sku', name: 'sku' },
                { data: 'variant_details', name: 'variant_details', orderable: false, searchable: false },
                { data: 'stock_qty', name: 'stock_qty' },
                { data: 'low_stock_alert', name: 'low_stock_alert' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'options', name: 'options', orderable: false, searchable: false },
            ],
            order: [[4, 'asc']],
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

            $.ajax({
                url: '{{ route("stock.adjust") }}',
                type: 'POST',
                data: formData + '&_token={{ csrf_token() }}',
                success: function(response) {
                    toastr.success(response.message);
                    $('#addStockModal').modal('hide');
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
