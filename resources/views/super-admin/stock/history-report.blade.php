@extends('layouts.common')

@section('content')
    <div class="container-fluid pb-5">
        <div class="card">
            <div class="card-header border-bottom-0 pt-4 px-4">
                <h5 class="section-title mb-0"><i class="ti ti-history"></i> Stock History Report</h5>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap w-100" id="stock-history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Old Stock</th>
                                <th>Added Qty</th>
                                <th>New Stock</th>
                                <th>Remarks</th>
                                <th>Updated By</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#stock-history-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('stock-history.data') }}',
                columns: [
                    { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
                    { data: 'product_name', name: 'product_name', orderable: false, searchable: false },
                    { data: 'sku', name: 'sku', orderable: false, searchable: false },
                    { data: 'size', name: 'size', orderable: false, searchable: false },
                    { data: 'color', name: 'color', orderable: false, searchable: false },
                    { data: 'old_stock', name: 'old_stock', orderable: false, searchable: false },
                    { data: 'added_quantity', name: 'added_quantity', orderable: false, searchable: false },
                    { data: 'new_stock', name: 'new_stock', orderable: false, searchable: false },
                    { data: 'remarks', name: 'remarks', orderable: false, searchable: false },
                    { data: 'user_name', name: 'user_name', orderable: false, searchable: false }
                ],
                order: []
            });
        });
    </script>
@endsection
