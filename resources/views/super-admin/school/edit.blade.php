@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="ti ti-building me-2"></i>
                            Edit School: {{ $school->school_name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('school.update', $school->school_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <fieldset class="form-section mb-4">
                                <legend class="h5 mb-3">Basic Information</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">School Name <span class="text-danger">*</span></label>
                                        <input type="text" name="school_name" class="form-control" value="{{ old('school_name', $school->school_name) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Principal Name <span class="text-danger">*</span></label>
                                        <input type="text" name="principal_name" class="form-control" value="{{ old('principal_name', $school->principal_name) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $school->email) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $school->phone) }}" required>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-section mb-4">
                                <legend class="h5 mb-3">Address & Affiliation</legend>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control" rows="2" required>{{ old('address', $school->address) }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control" value="{{ old('city', $school->city) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">State <span class="text-danger">*</span></label>
                                        <input type="text" name="state" class="form-control" value="{{ old('state', $school->state) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                        <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $school->pincode) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Affiliation No.</label>
                                        <input type="text" name="affiliation_no" class="form-control" value="{{ old('affiliation_no', $school->affiliation_no) }}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-section mb-4">
                                <legend class="h5 mb-3">Status & Branding</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">School Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                          <small class="text-muted  mb-2">
                                    Accepted formats: JPG, JPEG, PNG, WEBP (Max 2 MB)
                                </small>
                                          @if($school->logo_url)
                                            <div >
                                                <img src="{{ getFileUrl($school->logo_url) }}" alt="Logo" style="height: 50px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="is_active" class="form-select" required>
                                            <option value="1" {{ old('is_active', $school->is_active) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('is_active', $school->is_active) ? '' : 'selected' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="text-end">
                                <a href="{{ route('school.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update School</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
