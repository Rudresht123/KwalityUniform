@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Sections for {{ $schoolStandard->standard_name }}</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage sections assigned to this standard</p>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form action="{{ route('school-section.store') }}" method="POST" class="row g-3 align-items-end">
                            @csrf
                            <input type="hidden" name="standard_id" value="{{ $schoolStandard->id }}">
                            <input type="hidden" name="school_id" value="{{ $schoolStandard->school_id }}">
                            
                            <div class="col-md-8">
                                <label class="form-label fs-12">Section Name</label>
                                <input type="text" name="section_name" class="form-control" placeholder="e.g. Section A" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">
                                    <i class="ti ti-plus me-1"></i> Add Section
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datatable align-middle">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Section Name</th>
                                <th class="text-center">Status</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sections as $section)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $section->section_name }}</td>
                                    <td class="text-center">
                                        <x-status-badge :value="$section->is_active" :active="true" :inactive="false" />
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('school-section.delete', $section->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Are you sure you want to delete this section?')">
                                                <i class="ti ti-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No sections found for this standard.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
