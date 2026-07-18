@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">School Vendor Mappings</h5>
            <a href="{{ route('school-vendor-mapping.create') }}" class="btn btn-primary">Add Mapping</a>
        </div>
        <div class="card-body">
            <form action="{{ route('school-vendor-mapping.index') }}" method="GET" class="row mb-3">
                <div class="col-md-4">
                    <select name="school_id" class="form-control">
                        <option value="">All Schools</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->school_id }}" {{ request('school_id') == $school->school_id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="vendor_id" class="form-control">
                        <option value="">All Vendors</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->vendor_id }}" {{ request('vendor_id') == $vendor->vendor_id ? 'selected' : '' }}>{{ $vendor->business_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                    <a href="{{ route('school-vendor-mapping.index') }}" class="btn btn-light">Reset</a>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>School</th>
                        <th>Vendor</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mappings as $mapping)
                        <tr>
                            <td>{{ $mapping->school->school_name }}</td>
                            <td>{{ $mapping->vendor->business_name }}</td>
                            <td>
                                <form action="{{ route('school-vendor-mapping.destroy', $mapping->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mappings->links() }}
        </div>
    </div>
</div>
@endsection
