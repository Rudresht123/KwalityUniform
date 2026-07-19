@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <!-- Filter Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Filters</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <select id="filter_school" class="form-control">
                        <option value="">All Schools</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="filter_vendor" class="form-control">
                        <option value="">All Vendors</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->vendor_id }}">{{ $vendor->business_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="button" id="btn-filter" class="btn btn-secondary">Filter</button>
                    <button type="button" id="btn-reset" class="btn btn-light">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">School Vendor Mappings</h5>
            <a href="{{ route('school-vendor-mapping.create') }}" class="btn btn-primary">Add Mapping</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="mappings-table">
                <thead>
                    <tr>
                        <th>School</th>
                        <th>Vendor</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var table = $('#mappings-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('school-vendor-mapping.index') }}",
                data: function (d) {
                    d.school_id = $('#filter_school').val();
                    d.vendor_id = $('#filter_vendor').val();
                }
            },
            columns: [
                { data: 'school_name', name: 'school.school_name' },
                { data: 'vendor_name', name: 'vendor.business_name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });

        $('#btn-filter').click(function() {
            table.draw();
        });

        $('#btn-reset').click(function() {
            $('#filter_school').val('');
            $('#filter_vendor').val('');
            table.draw();
        });
    });
</script>
@endpush
