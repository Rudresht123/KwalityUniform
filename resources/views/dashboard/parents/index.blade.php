@extends('layouts.common')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    

        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="parents-table-index" class="table " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
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

@push('scripts')
<script>
    $(document).ready(function() {
        const table = initDataTable('#parents-table-index',{
                        processing: true,
            serverSide: true,
            ajax: '{{ route("parents.index") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'user_name', name: 'user.name' },
                { data: 'user_email', name: 'user.email' },
                { data: 'user_phone', name: 'user.phone' },
                { data: 'city', name: 'city' },
                { data: 'status_badge', name: 'user.is_active', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
        });
    });
</script>
@endpush
@endsection
