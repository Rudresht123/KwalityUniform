@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Category Management</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage product categories, types and size requirements</p>
                    </div>
                    <div>
                        @can('category.create')
                            <a href="{{ route('category.create') }}" class="btn btn-primary rounded-pill px-3">
                                <i class="ti ti-plus me-1"></i> Add Category
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table w-100" id="category-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Type</th>
                                <th>Size Required</th>
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
        initDataTable('#category-datatable', {
            serverSide: true,
            ajax: "{{ route('category.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'category_name', name: 'category_name'},
                {data: 'action_type', name: 'category_type'},
                {data: 'size_status', name: 'requires_size'},
                {data: 'status', name: 'is_active'},
                {data: 'options', name: 'options', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush
@endsection
