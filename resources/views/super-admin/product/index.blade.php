@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Product Management</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage marketplace products, codes and approval status</p>
                    </div>
                    <div>
                        @can('product.create')
                            <a href="{{ route('product.create') }}" class="btn btn-primary rounded-pill px-3">
                                <i class="ti ti-plus me-1"></i> Add Product
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table w-100" id="product-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Product Name</th>
                                @if(!auth()->user()->hasRole('vendor'))
                                <th>Vendor</th>
                                @endif
                                <th>Category</th>
                                <th>Approval</th>
                                <th>Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function() {
        initDataTable('#product-datatable', {
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'product_code', name: 'product_code'},
                {data: 'product_name', name: 'product_name'},
                @if(!auth()->user()->hasRole('vendor'))
                {data: 'vendor_name', name: 'vendor_name'},
                @endif
                {data: 'category_name', name: 'category_name'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'status', name: 'is_active'},
                {data: 'options', name: 'options', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush
@endsection
