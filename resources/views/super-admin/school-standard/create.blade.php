@extends('layouts.common')

@section('content')
<div class="container-fluid">
<form action="{{ route('school-standard.store') }}" method="POST" id="bulk-class-form">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bcs-icon">
                        <i class="ti ti-school"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-semibold text-dark">Bulk class setup</h4>
                        <p class="mb-0 text-muted small">Configure multiple classes for a school in one go</p>
                    </div>
                </div>
                <a href="{{ route('school-standard.index') }}" class="bcs-back-btn">
                    <i class="ti ti-arrow-left"></i> Back to list
                </a>
            </div>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="bcs-error-box mb-3">
                    <i class="ti ti-alert-circle"></i>
                    <div>
                        <div class="bcs-error-title">Fix these errors before saving</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Section 1: School settings --}}
            <div class="bcs-section mb-3">
                <div class="bcs-sec-label">School settings</div>
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="school_id" class="bcs-field-label">
                            Select school <span class="text-danger">*</span>
                        </label>
                        <select name="school_id" id="school_id"
                                class="bcs-select select2 @error('school_id') bcs-select-error @enderror"
                                required>
                            <option value="" disabled {{ count($schools) > 1 ? 'selected' : '' }}>
                                Which school are these for?
                            </option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->school_id }}"
                                    {{ old('school_id') == $school->school_id || count($schools) == 1 ? 'selected' : '' }}>
                                    {{ $school->school_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="bcs-toggle-box">
                            <div>
                                <div class="bcs-toggle-label">Default status</div>
                                <div class="bcs-toggle-status" id="toggle-status-label">Active</div>
                            </div>
                            <label class="bcs-toggle" aria-label="Toggle active status">
                                <input type="checkbox" name="is_active" value="1" id="is_active"
                                       {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                <span class="bcs-toggle-track"><span class="bcs-toggle-thumb"></span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Class fields --}}
            <div class="bcs-section mb-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark d-flex align-items-center gap-2">
                            Define standards
                            <span class="bcs-count-pill" id="class-count-pill">
                                <i class="ti ti-list" style="font-size:11px"></i>
                                <span id="class-count-num">1</span> class
                            </span>
                        </h5>
                        <p class="text-muted small mb-0 mt-1">List all classes to create for this school.</p>
                    </div>
                    <button type="button" class="bcs-add-btn" id="add-class-btn">
                        <i class="ti ti-plus"></i> Add class
                    </button>
                </div>

                <div id="class-fields-container">
                    @php $oldClasses = old('standard_names', ['']); @endphp
                    @foreach ($oldClasses as $index => $oldValue)
                        <div class="bcs-row">
                            <div class="bcs-row-num">{{ $index + 1 }}</div>
                            <input type="text"
                                   name="standard_names[]"
                                   class="bcs-row-input"
                                   placeholder="Primary, Secondary"
                                   value="{{ $oldValue }}"
                                   aria-label="Class name {{ $index + 1 }}"
                                   required>
                            <button type="button"
                                    class="bcs-del-btn remove-row"
                                    aria-label="Remove class {{ $index + 1 }}"
                                    {{ count($oldClasses) <= 1 ? 'disabled' : '' }}>
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Footer --}}
            <div class="bcs-footer">
                <div class="bcs-footer-hint">
                    <i class="ti ti-info-circle"></i>
                    All classes inherit the school and status above.
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('school-standard.index') }}" class="bcs-cancel-btn">Cancel</a>
                    <button type="submit" class="bcs-save-btn">
                        <i class="ti ti-cloud-upload"></i> Save classes
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>
</div>
@endsection


@push('scripts')
@include("super-admin.school-standard.school-standard-js")
@endpush