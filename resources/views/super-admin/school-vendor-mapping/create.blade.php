@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add School Vendor Mapping</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('school-vendor-mapping.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>School</label>
                    <select name="school_id" class="form-control" required>
                        @foreach($schools as $school)
                            <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label>Vendor</label>
                    <select name="vendor_id" class="form-control" required>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->vendor_id }}">{{ $vendor->business_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save Mapping</button>
                <a href="{{ route('school-vendor-mapping.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
