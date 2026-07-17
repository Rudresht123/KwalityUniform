@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h4 class="card-title">Stock Adjustment History</h4>
                </div>
                <div class="card-body">
                    <table id="stockHistoryTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Old Stock</th>
                                <th>Added Qty</th>
                                <th>New Stock</th>
                                <th>Reason</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initDataTable('#stockHistoryTable', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('vendor.stock.history.report') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'product_name', name: 'product_name', orderable: false, searchable: false },
                { data: 'sku', name: 'sku', orderable: false, searchable: false },
                { data: 'size', name: 'size', orderable: false, searchable: false },
                { data: 'color', name: 'color', orderable: false, searchable: false },
                { data: 'old_stock', name: 'old_stock', orderable: false, searchable: false },
                { data: 'added_quantity', name: 'added_quantity', orderable: false, searchable: false },
                { data: 'new_stock', name: 'new_stock', orderable: false, searchable: false },
                { data: 'reason', name: 'reason', orderable: false, searchable: false },
                { data: 'remarks', name: 'remarks', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush