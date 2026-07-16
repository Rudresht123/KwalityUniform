@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase mb-1">Total Parents</h6>
                            <h2 class="fw-bold mb-0">{{ $stats['total_parents'] }}</h2>
                        </div>
                        <div class="avatar-lg bg-white-transparent rounded-circle p-3">
                            <i class="ti ti-users fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase mb-1">Active Parents</h6>
                            <h2 class="fw-bold mb-0">{{ $stats['active_parents'] }}</h2>
                        </div>
                        <div class="avatar-lg bg-white-transparent rounded-circle p-3">
                            <i class="ti ti-user-check fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-uppercase mb-1">New This Month</h6>
                            <h2 class="fw-bold mb-0">{{ $stats['new_this_month'] }}</h2>
                        </div>
                        <div class="avatar-lg bg-white-transparent rounded-circle p-3">
                            <i class="ti ti-calendar-event fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Table -->
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Parent User Detailed Report</h4>
                    <button class="btn btn-light btn-sm" onclick="window.print()">
                        <i class="ti ti-printer"></i> Print Report
                    </button>
                </div>
                <div class="card-body">
                    <table id="parentReportTable" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Parent Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Registered Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>

    $(document).ready(function() {
        initializeDatatable('#parentReportTable',{
            processing: true,
            serverSide: true,
            ajax: "{{ route('parent-user.report') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'username', name: 'username' },
                { data: 'registration_date', name: 'created_at' },
                { data: 'status', name: 'status', searchable: false },
                { data: 'options', name: 'options', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
@endsection
