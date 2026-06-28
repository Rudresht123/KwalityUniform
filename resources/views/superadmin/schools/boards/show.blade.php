@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-semibold">
                                <i class="ti ti-list-details me-2"></i>
                                School Board Details
                            </h4>
                            <a href="{{ route('school-boards.index') }}" class="btn btn-light btn-sm">
                                <i class="ti ti-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="text-muted d-block small text-uppercase fw-bold">Board Name</label>
                                    <div class="h5 fw-semibold">{{ $schoolBoard->name }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="text-muted d-block small text-uppercase fw-bold">Description</label>
                                    <div class="text-muted">{{ $schoolBoard->description ?: 'No description provided.' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Associated Schools</h6>
                                        <ul class="list-unstyled mb-0">
                                            @forelse($schoolBoard->schools as $school)
                                                <li class="d-flex justify-content-between align-items-center mb-2 p-2 bg-white rounded border shadow-sm">
                                                    <span>{{ $school->school_name }}</span>
                                                    <a href="{{ route('school.show', $school->school_id) }}" class="btn btn-sm btn-link p-0">View</a>
                                                </li>
                                            @empty
                                                <li class="text-muted small">No schools associated with this board.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
