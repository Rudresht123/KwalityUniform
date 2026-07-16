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
                                <th>Product Name</th>
                                <th>Reason</th>
                                <th>Quantity Change</th>
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
        initializeDatatable('#stockHistoryTable', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('vendor.stock.history.report') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'product_name', name: 'product.name' },
                { data: 'reason', name: 'reason' },
                { data: 'quantity_change', name: 'quantity_change', searchable: false },
                { data: 'notes', name: 'notes', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush