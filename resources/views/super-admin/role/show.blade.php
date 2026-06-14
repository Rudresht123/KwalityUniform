@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 d-flex align-items-center">
                                <div class="icon-box bg-primary01 text-primary me-2 rounded-3 p-2">
                                    <i class="ti ti-shield-search fs-5"></i>
                                </div>
                                Role Details: <span class="text-primary ms-1">{{ ucfirst($role->name) }}</span>
                            </h4>
                            <div class="d-flex gap-2">
                                <a href="{{ route('role.index') }}" class="btn btn-light btn-wave">
                                    <i class="ti ti-arrow-narrow-left me-1"></i> Back
                                </a>
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary btn-wave shadow-sm">
                                    <i class="ti ti-edit me-1"></i> Edit Role
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 bg-light-subtle border-bottom">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center p-3 bg-white border rounded-3 shadow-sm">
                                        <div class="flex-shrink-0 bg-primary01 text-primary p-3 rounded-circle me-3">
                                            <i class="ti ti-id fs-4"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold mb-1">Role Identity</small>
                                            <h5 class="mb-0 fw-bold">{{ ucfirst($role->name) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center p-3 bg-white border rounded-3 shadow-sm">
                                        <div class="flex-shrink-0 bg-info-transparent text-info p-3 rounded-circle me-3">
                                            <i class="ti ti-server fs-4"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold mb-1">Guard Name</small>
                                            <h5 class="mb-0 fw-bold">{{ $role->guard_name }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center p-3 bg-white border rounded-3 shadow-sm">
                                        <div class="flex-shrink-0 bg-success-transparent text-success p-3 rounded-circle me-3">
                                            <i class="ti ti-lock-access fs-4"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold mb-1">Total Permissions</small>
                                            <h5 class="mb-0 fw-bold">{{ $role->permissions->count() }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">
                            <h5 class="fw-bold mb-4 d-flex align-items-center">
                                <i class="ti ti-list-check me-2 text-primary"></i>
                                Assigned Capabilities
                            </h5>

                            <div class="row g-4">
                                @forelse($role->permissions->groupBy('group_name') as $group => $permissions)
                                    <div class="col-xl-3 col-md-4">
                                        <div class="permission-group-card h-100 border rounded-3 bg-white">
                                            <div class="p-3 border-bottom bg-light d-flex align-items-center justify-content-between">
                                                <h6 class="mb-0 fw-bold">{{ ucfirst($group ?: 'General') }}</h6>
                                                <span class="badge bg-primary rounded-pill">{{ count($permissions) }}</span>
                                            </div>
                                            <div class="p-3">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($permissions as $permission)
                                                        <li class="mb-2 d-flex align-items-start">
                                                            <i class="ti ti-circle-check-filled text-success me-2 mt-1"></i>
                                                            <span class="small text-dark">{{ $permission->permission_name ?: Str::headline($permission->name) }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="text-center py-5">
                                            <div class="mb-3">
                                                <i class="ti ti-shield-off fs-1 text-muted opacity-25"></i>
                                            </div>
                                            <h5 class="text-muted">No permissions assigned to this role.</h5>
                                            <p class="text-muted small">Edit the role to grant access to system features.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-box {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bg-primary01 {
            background-color: var(--primary01);
        }
        .permission-group-card {
            transition: all 0.2s ease;
        }
        .permission-group-card:hover {
            border-color: var(--primary-color) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .bg-info-transparent {
            background-color: rgba(var(--info-rgb), 0.1);
        }
        .bg-success-transparent {
            background-color: rgba(var(--success-rgb), 0.1);
        }
    </style>
@endsection
