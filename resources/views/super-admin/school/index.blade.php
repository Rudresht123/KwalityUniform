@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Schools</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage All Schools From Here</p>
                    </div>
                    <div>
                        <a href="{{ route('school.create') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-plus"></i>
                            Add School
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>School Name</th>
                                <th>Principal Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schools as $school)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $school->school_name }}</td>
                                    <td>{{ $school->principal_name }}</td>
                                    <td>{{ $school->email }}</td>
                                    <td>{{ $school->phone }}</td>
                                    <td>{{ $school->city }}</td>
                                    <td>
                                        <x-status-badge :value="$school->is_active" :active="true" :inactive="false" />
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <x-show :url="route('school.show', $school->school_id)" title="View School" />
                                            <x-edit-button :url="route('school.edit', $school->school_id)" title="Edit School" />
                                            <x-delete-button :url="route('deleteRecord', [
                                                'table' => $school->getTable(),
                                                'id' => $school->school_id,
                                            ])" :id="$school->school_id" title="Delete School" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No schools found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
