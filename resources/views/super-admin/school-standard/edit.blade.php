@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('school-standard.update', $school->school_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                        {{-- Professional Header --}}
                        <div class="card-header bg-primary py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center text-white">
                                    <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3">
                                        <i class="ti ti-edit fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold">Manage Standards: {{ $school->school_name }}</h4>
                                        <p class="mb-0 small text-white-50">Update or refine the standard structure for this school</p>
                                    </div>
                                </div>
                                <a href="{{ route('school-standard.index') }}" class="btn btn-link text-white text-decoration-none bg-white bg-opacity-10 px-3 rounded-pill hover-elevate">
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

                            {{-- Section 1: School Info (Read Only) --}}
                            <div class="bg-light rounded-3 p-4 mb-4 border border-dashed border-primary border-opacity-25">
                                <div class="row align-items-center text-dark">
                                    <div class="col-md-7">
                                        <label class="form-label fw-bold text-muted small text-uppercase tracking-wider mb-1">Target School</label>
                                        <h5 class="fw-bold mb-0">{{ $school->school_name }}</h5>
                                        <div class="small text-muted mt-1">
                                            <i class="ti ti-map-pin me-1"></i> {{ $school->city }}, {{ $school->state }}
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-3 mt-md-0 d-flex justify-content-md-end text-end">
                                        <div>
                                            <label class="form-label fw-bold text-muted small text-uppercase mb-1 d-block">Current Status</label>
                                            <x-status-badge :value="$school->is_active" :active="true" :inactive="false" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Section 2: Manage Classes --}}
                            <div class="mt-5">
                                <div class="d-flex justify-content-between align-items-end mb-4">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1">Standard Configuration</h5>
                                        <p class="text-muted small mb-0">Add, remove, or rename standards below. Removing a row will delete that standard from the system.</p>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm px-4 rounded-pill shadow-sm" id="add-standard-field">
                                        <i class="ti ti-plus me-1"></i> Add Another Standard
                                    </button>
                                </div>

                                <div id="class-fields-container" class="pe-2" style="max-height: 500px; overflow-y: auto;">
                                    @php
                                        // Use old values if they exist (after validation error), otherwise use DB classes
                                        $currentClasses = old('standard_name');
                                        if (is_null($currentClasses)) {
                                            $currentClasses = $classes->pluck('standard_name')->toArray();
                                            if (empty($currentClasses)) $currentClasses = ['']; // At least one empty row if none exist
                                        }
                                     
                                    @endphp
                                    
                                    @foreach($currentClasses as $index => $oldValue)
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
                                                    <input type="text" name="standard_names[]" class="form-control border-0 py-2 ps-1" placeholder="e.g. Grade 10, Senior KG..." value="{{ $oldValue }}" required>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-light-danger btn-icon rounded-circle remove-class-field" {{ count($currentClasses) <= 1 ? 'disabled' : '' }} title="Remove">
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
                                    <i class="ti ti-alert-triangle text-warning me-1"></i>
                                    Note: Removing a standard here will permanently delete it from this school.
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('school-standard.index') }}" class="btn btn-link text-muted text-decoration-none px-4 fw-semibold">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-5 py-2 shadow rounded-pill fw-bold">
                                        <i class="ti ti-device-floppy me-2"></i> Update Standards
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
