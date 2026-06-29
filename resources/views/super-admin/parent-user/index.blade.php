@extends('layouts.common')

@section('content')


  <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Parent User Management</h4>
                    <a href="{{ route('parent-user.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Create Parent User
                    </a>
                </div>
                <div class="card-body">
                    <table id="parentTable" class="table datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

@push('scripts')
<script>
    $(document).ready(function() {
        initializeDatatable('#parentTable',{
            processing: true,
            serverSide: true,
            ajax: "{{ route('parent-user.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status', searchable: false },
                { data: 'options', name: 'options', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
@endsection
