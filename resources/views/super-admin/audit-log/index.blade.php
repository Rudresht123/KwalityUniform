@extends('layouts.common')

@section('content')
    {{-- Table Section --}}
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">System Audit Reports</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Comprehensive activity tracking and security logs</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table w-100" id="audit-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Module</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Table Section --}}

@push('scripts')
<script>
    $(document).ready(function() {
        initDataTable('#audit-datatable', {
            serverSide: true,
            ajax: "{{ route('audit.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'user', name: 'user'},
                {data: 'action', name: 'action', searchable: false},
                {data: 'model', name: 'model'},
                {data: 'details', name: 'details'},
                {data: 'created_at', name: 'created_at'},
                {data: 'options', name: 'options', orderable: false, searchable: false}
            ],
            order: [[5, 'desc']], 
        });
    });
</script>
@endpush
@endsection
