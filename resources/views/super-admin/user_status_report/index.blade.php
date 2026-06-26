@extends('layouts.common')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="card custom-card">
               <div class="card-body">
                 <div class="rowand why ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">User Type</label>
                                    <select id="filter-type" class="form-select">
                                        <option value="">All Types</option>
                                        <option value="vendor">Vendor</option>
                                        <option value="school">School</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select id="filter-status" class="form-select">
                                        <option value="">All Statuses</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive/Suspended</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-center pt-2">
                                <button id="filter-btn" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
               </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20 tasks">
                    <div class="card-body">
                        <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                            <div>
                                <div class="card-title">User Status Report</div>
                                <p class="mb-0 fs-12 mb-3 text-muted">Monitor and manage inactive or suspended users across vendors and schools.</p>
                            </div>
                        </div>
                    
                        <div class="table-responsive">
                            <table id="user-status-table" class="table datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Entity Name</th>
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
        const table = $('#user-status-table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("user-status-report.index") }}',
                data: function (d) {
                    d.type = $('#filter-type').val();
                    d.status = $('#filter-status').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'user_type', name: 'user_type' },
                { data: 'entity_name', name: 'entity_name' },
                { data: 'status_badge', name: 'status_badge', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
        });


        $('#filter-btn').on('click', function() {
            table.ajax.reload();
        });

        $(document).on('click', '.btn-toggle-status', function() {
            const userId = $(this).data('id');
            const btn = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change this user's active status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change status!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("user-status-report.toggle") }}',
                        type: 'POST',
                        data: { user_id: userId, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            );
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message || 'Something went wrong',
                                'error'
                            );
                        }
                    });
                }
            });
        });

    });
</script>
@endpush
@endsection
