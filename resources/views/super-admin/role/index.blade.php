@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">

                                <div class="icon-box bg-primary01 text-primary rounded-3 p-3 me-3">
                                    <i class="ti ti-shield-lock fs-4"></i>
                                </div>

                                <div>
                                    <h4 class="mb-0 fw-bold">
                                        Role Management
                                    </h4>

                                    <span class="text-muted small">
                                        Define and manage system roles and permissions
                                    </span>
                                </div>

                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('role.create') }}" class="btn btn-primary btn-wave shadow-sm">
                                    <i class="ti-plus me-1"></i> Add New Role
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 datatable">
                                <thead class="bg-light text-muted text-uppercase small">
                                    <tr>
                                        <th class="ps-4" width="80">#</th>
                                        <th>Role Details</th>
                                        <th>Guard</th>
                                        <th>Capabilities</th>
                                        <th class="pe-4 text-end" width="180">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-bold text-muted">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar avatar-sm bg-primary01 text-primary rounded-circle me-3">
                                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ ucfirst($role->name) }}</h6>
                                                        <small class="text-muted">Standard Role</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">{{ $role->guard_name }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge bg-primary01 text-primary px-3 py-2 rounded-pill me-2">
                                                        {{ $role->permissions_count ?? $role->permissions()->count() }}
                                                        Permissions
                                                    </span>
                                                    @if (($role->permissions_count ?? $role->permissions()->count()) > 0)
                                                        <div class="progress progress-xs w-50px"
                                                            style="height: 4px; width: 60px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 100%"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="pe-4 text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <x-show :url="route('role.show', $role->id)" title="View Details" />
                                                    <x-edit-button :url="route('role.edit', $role->id)" title="Edit Role" />
                                                    <x-delete-button :url="route('deleteRecord', [
                                                        'table' => $role->getTable(),
                                                        'id' => $role->id,
                                                    ])" :id="$role->id"
                                                        title="Delete Role" />
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="mb-3">
                                                    <i class="ti ti-shield-off fs-1 text-muted opacity-25"></i>
                                                </div>
                                                <h5 class="text-muted">No roles found in the system.</h5>
                                                <p class="text-muted small mb-0">Start by creating a new role to manage user
                                                    access.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

        .avatar-sm {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.5rem;
        }
    </style>
@endsection
