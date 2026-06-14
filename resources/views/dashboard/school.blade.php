@if(!$school)
    <div class="alert alert-warning mt-4">
        <h5 class="fw-bold"><i class="ti ti-alert-triangle me-2"></i>School Not Found</h5>
        <p class="mb-0">Your account is not currently linked to a registered school. Please contact the administrator.</p>
    </div>
@else
    <div class="row mt-4">
        {{-- Welcome Card --}}
        <div class="col-lg-12 mb-4">
            <div class="card custom-card shadow-sm border-0 bg-primary text-white overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="fw-bold mb-1">Welcome back, {{ $school->school_name }}!</h3>
                            <p class="mb-0 text-white-50">Here's an overview of your school's current configuration and class status.</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <span class="badge bg-white text-primary rounded-pill px-4 py-2 fs-14 fw-bold shadow-sm">
                                <i class="ti ti-calendar-event me-1"></i> {{ now()->format('l, d M Y') }}
                            </span>
                        </div>
                    </div>
                    {{-- Decorative SVG --}}
                    <div class="position-absolute end-0 bottom-0 opacity-10 mb-n4 me-n4">
                        <i class="ti ti-school" style="font-size: 15rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="col-xl-4 col-md-6">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted small fw-bold text-uppercase mb-1">Total Classes</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ $totalClasses }}</h3>
                        </div>
                        <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                            <i class="ti ti-book fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted small fw-bold text-uppercase mb-1">Active Classes</p>
                            <h3 class="fw-bold mb-0 text-success">{{ $activeClasses }}</h3>
                        </div>
                        <div class="bg-success-subtle text-success p-3 rounded-circle">
                            <i class="ti ti-circle-check fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted small fw-bold text-uppercase mb-1">School Status</p>
                            <div class="mt-1">
                                <x-status-badge :value="$school->is_active" :active="true" :inactive="false" />
                            </div>
                        </div>
                        <div class="bg-info-subtle text-info p-3 rounded-circle">
                            <i class="ti ti-building-broadcast-tower fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Class Status Chart --}}
        <div class="col-xl-12 mb-4">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="ti ti-chart-bar me-2 text-primary"></i>Class Status Distribution</h6>
                </div>
                <div class="card-body">
                    <div id="class-status-chart" style="min-height: 200px;"></div>
                </div>
            </div>
        </div>

        {{-- Recent Classes --}}
        <div class="col-lg-8">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="ti ti-list-details me-2 text-primary"></i>Your Recent Classes</h6>
                    <a href="{{ route('school-class.edit', $school->school_id) }}" class="btn btn-sm btn-light text-primary fw-bold">Manage All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 border-0 small text-uppercase fw-bold text-muted">Class Name</th>
                                    <th class="border-0 small text-uppercase fw-bold text-muted">Status</th>
                                    <th class="border-0 small text-uppercase fw-bold text-muted">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentClasses as $rClass)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-semibold text-dark">{{ $rClass->class_name }}</div>
                                        </td>
                                        <td>
                                            <x-status-badge :value="$rClass->is_active" :active="true" :inactive="false" />
                                        </td>
                                        <td>
                                            <div class="small text-muted">{{ $rClass->created_at->format('M d, Y') }}</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted small italic">No classes defined yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-lg-4">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="ti ti-bolt me-2 text-warning"></i>Quick Links</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('school-class.edit', $school->school_id) }}" class="list-group-item list-group-item-action d-flex align-items-center border-0 rounded-3 mb-2 bg-light-subtle py-3">
                            <div class="bg-primary text-white p-2 rounded-circle me-3">
                                <i class="ti ti-settings-automation fs-6"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-semibold small">Manage Class List</p>
                                <small class="text-muted">Add or remove classes for your school</small>
                            </div>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center border-0 rounded-3 bg-light-subtle py-3">
                            <div class="bg-info text-white p-2 rounded-circle me-3">
                                <i class="ti ti-user-edit fs-6"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-semibold small">Update Profile</p>
                                <small class="text-muted">Change your password or email</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        initDashboardChart("#class-status-chart", "bar", 
            [{{ $activeClasses }}, {{ $inactiveClasses }}], 
            ['Active', 'Inactive'], 
            { 
                colors: ['#28a745', '#dc3545'],
                height: 250
            }
        );
    });
</script>
@endpush
