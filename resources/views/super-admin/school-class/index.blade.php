@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">School Classes Overview</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage class mappings by school</p>
                    </div>
                    <div>
                        <a href="{{ route('school-class.create') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                            <i class="ti ti-plus me-1"></i>
                            Bulk Add Classes
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table datatable align-middle">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>School Name</th>
                                <th>Location</th>
                                <th class="text-center">Total Classes</th>
                                <th>Status</th>
                                <th width="150" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schools as $school)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $school->school_name }}</div>
                                        <small class="text-muted">{{ $school->email }}</small>
                                    </td>
                                    <td>{{ $school->city }}, {{ $school->state }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary fs-13 rounded-pill px-3">
                                            {{ $school->classes_count }} Classes
                                        </span>
                                    </td>
                                    <td>
                                        <x-status-badge :value="$school->is_active" :active="true" :inactive="false" />
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-list justify-content-center">
                                            <a href="{{ route('school-class.edit', $school->school_id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-none">
                                                <i class="ti ti-edit me-1"></i> Manage Classes
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No schools found to manage classes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
