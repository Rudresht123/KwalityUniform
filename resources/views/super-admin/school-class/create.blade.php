@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('school-class.store') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                        {{-- Professional Header --}}
                        <div class="card-header bg-primary py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center text-white">
                                    <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="ti ti-school fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold">Bulk Class Setup</h4>
                                        <p class="mb-0 small text-white-50">Configure multiple classes for a school in one go</p>
                                    </div>
                                </div>
                                <a href="{{ route('school-class.index') }}" class="btn btn-link text-white text-decoration-none bg-white bg-opacity-10 px-3 rounded-pill hover-elevate">
                                    <i class="ti ti-arrow-narrow-left me-1"></i> Back to List
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 shadow-sm mb-4">
                                    <div class="d-flex">
                                        <i class="ti ti-alert-circle fs-4 me-2"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Validation Errors</h6>
                                            <ul class="mb-0 small">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Section 1: School Settings --}}
                            <div class="bg-light rounded-3 p-4 mb-4 border border-dashed border-primary border-opacity-25">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <label for="school_id" class="form-label fw-bold text-dark small text-uppercase tracking-wider">
                                            Select School <span class="text-danger">*</span>
                                        </label>
                                        <select name="school_id" id="school_id" class="form-select @error('school_id') is-invalid @enderror searchable-select" required>
                                            <option value="" disabled {{ count($schools) > 1 ? 'selected' : '' }}>Which school are these for?</option>
                                            @foreach($schools as $school)
                                                <option value="{{ $school->school_id }}" 
                                                    {{ (old('school_id') == $school->school_id || count($schools) == 1) ? 'selected' : '' }}>
                                                    {{ $school->school_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5 mt-3 mt-md-0 d-flex justify-content-md-end">
                                        <div class="p-3 bg-white rounded-3 shadow-sm border border-light w-100 w-md-auto">
                                            <label class="form-label fw-bold text-muted small text-uppercase mb-2 d-block">Default Status</label>
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <input class="form-check-input me-3" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold text-primary" for="is_active">Active & Visible</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Section 2: Class Names --}}
                            <div class="mt-5">
                                <div class="d-flex justify-content-between align-items-end mb-4">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1">Define Classes</h5>
                                        <p class="text-muted small mb-0">List all classes you want to create for this school.</p>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm px-4 rounded-pill shadow-sm" id="add-class-field">
                                        <i class="ti ti-plus me-1"></i> Add Another Class
                                    </button>
                                </div>

                                <div id="class-fields-container" class="pe-2" style="max-height: 500px; overflow-y: auto;">
                                    @php
                                        $oldClasses = old('class_names', ['']);
                                    @endphp
                                    @foreach($oldClasses as $index => $oldValue)
                                        <div class="row class-input-row mb-3 gx-3 align-items-center p-3 bg-white rounded-3 border border-light shadow-sm mx-0">
                                            <div class="col-auto">
                                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <span class="fw-bold row-number">{{ $index + 1 }}</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group input-group-merge border rounded-pill overflow-hidden shadow-none border-2">
                                                    <span class="input-group-text bg-transparent border-0 ps-3">
                                                        <i class="ti ti-edit text-muted"></i>
                                                    </span>
                                                    <input type="text" name="class_names[]" class="form-control border-0 py-2 ps-1" placeholder="e.g. Class 1A, Senior KG..." value="{{ $oldValue }}" required>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-light-danger btn-icon rounded-circle remove-class-field" {{ count($oldClasses) <= 1 ? 'disabled' : '' }} title="Remove">
                                                    <i class="ti ti-x fs-5"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light p-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    <i class="ti ti-info-circle text-primary me-1"></i>
                                    All added classes will inherit the school and status settings above.
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('school-class.index') }}" class="btn btn-link text-muted text-decoration-none px-4 fw-semibold">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-5 py-2 shadow rounded-pill fw-bold">
                                        <i class="ti ti-cloud-upload me-2"></i> Confirm & Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/school-class.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/custom/school-class.js') }}"></script>
@endpush
