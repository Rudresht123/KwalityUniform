@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Parent Category Management</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage top-level categories like Uniform, Stationery, etc.</p>
                    </div>
                    <div>
                        @can('category.create')
                            <a href="{{ route('parent-category.create') }}" class="btn btn-primary rounded-pill px-3">
                                <i class="ti ti-plus me-1"></i> Add Parent Category
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table w-100" id="parent-category-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
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
        initDataTable('#parent-category-datatable', {
            serverSide: true,
            ajax: "{{ route('parent-category.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'is_active'},
                {data: 'options', name: 'options', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush
@endsection
