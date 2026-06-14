@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 fw-bold">
                                <i class="ti ti-shield-lock text-primary me-2"></i> Create New Role
                            </h4>
                            <a href="{{ route('role.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="ti ti-arrow-narrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('role.store') }}" method="POST" id="roleForm">
                            @csrf

                            <div class="p-4 border-bottom bg-light-subtle">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <label class="form-label fw-bold small text-uppercase text-muted">Role Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form-control-lg border-2" value="{{ old('name') }}" placeholder="Enter role name (e.g. Sales Manager)" required autofocus>
                                        <div class="form-text mt-1 small">The unique identifier for this role in the system.</div>
                                    </div>
                                    <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                        <div class="form-check form-switch d-inline-block p-3 border rounded bg-white shadow-sm">
                                            <input class="form-check-input ms-0 me-2" type="checkbox" id="selectAllGlobal">
                                            <label class="form-check-label fw-bold text-primary" for="selectAllGlobal">Grant All Permissions</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="m-4">
                                    <div class="alert alert-danger border-0 shadow-sm mb-0">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="ti ti-alert-triangle me-2 fs-5"></i>
                                            <h6 class="mb-0 fw-bold">Validation Errors</h6>
                                        </div>
                                        <ul class="mb-0 small">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="row g-0">
                                {{-- Sidebar --}}
                                <div class="col-lg-3 border-end bg-light-subtle">
                                    <div class="p-4 sticky-top" style="top: 0;">
                                        <h6 class="text-uppercase fw-bold text-muted small mb-3">Module Groups</h6>
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            @foreach($groupedPermissions as $group => $permissions)
                                                <button class="nav-link text-start mb-2 d-flex align-items-center justify-content-between {{ $loop->first ? 'active' : '' }}" 
                                                        id="v-pills-{{ Str::slug($group) }}-tab" 
                                                        data-bs-toggle="pill" 
                                                        data-bs-target="#group_{{ Str::slug($group) }}" 
                                                        type="button" role="tab">
                                                    <span>{{ $group }}</span>
                                                    <span class="badge rounded-pill bg-light text-dark group-count">{{ count($permissions) }}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="col-lg-9">
                                    <div class="tab-content p-4" id="v-pills-tabContent">
                                        @foreach($groupedPermissions as $group => $permissions)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                                 id="group_{{ Str::slug($group) }}" 
                                                 role="tabpanel">
                                                
                                                <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                                                    <div>
                                                        <h5 class="fw-bold mb-1">{{ $group }} Module</h5>
                                                        <p class="text-muted small mb-0">Configure specific capabilities for this module.</p>
                                                    </div>
                                                    <div class="btn-group btn-group-sm shadow-sm">
                                                        <button type="button" class="btn btn-outline-primary select-group">Select All</button>
                                                        <button type="button" class="btn btn-outline-secondary clear-group">Deselect All</button>
                                                    </div>
                                                </div>

                                                <div class="list-group list-group-flush border rounded overflow-hidden shadow-sm">
                                                    @foreach($permissions as $permission)
                                                        <label class="list-group-item d-flex align-items-center justify-content-between p-3" for="perm_{{ $permission->id }}">
                                                            <div class="d-flex align-items-center">
                                                                <div class="icon-box-sm bg-primary-subtle text-primary rounded-circle me-3">
                                                                    <i class="ti ti-check fs-6"></i>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0 fw-semibold text-dark">{{ $permission->permission_name ?: Str::headline($permission->name) }}</h6>
                                                                    <small class="text-muted">{{ $permission->name }}</small>
                                                                </div>
                                                            </div>
                                                            <div class="form-check form-switch mb-0">
                                                                <input class="form-check-input permission-checkbox" 
                                                                       type="checkbox" 
                                                                       name="permissions[]" 
                                                                       id="perm_{{ $permission->id }}" 
                                                                       value="{{ $permission->name }}">
                                                            </div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="text-muted small">
                                        <i class="ti ti-info-circle me-1"></i> Changes will take effect immediately after saving.
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('role.index') }}" class="btn btn-light px-4">Cancel</a>
                                        <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                            <i class="ti ti-device-floppy me-1"></i> Save Role
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/role-permission.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/custom/role-permission.js') }}"></script>
@endpush
