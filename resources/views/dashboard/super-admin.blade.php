@php
    $breadcrumb = 'Dashboard';
    $title = 'Project Dashboard';
@endphp

<div class="row row-sm">
    <div class="col-sm-12 col-lg-12 col-xl-9">
        {{-- Row 1: Welcome Banner --}}
        <div class="row row-sm">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card custom-card overflow-hidden bg-primary">
                    <div class="card-body p-4">
                        <div class="row row-sm">
                            <div class="col-sm-12 col-lg-8 col-xl-8">
                                <div class="d-flex align-items-center text-white">
                                    <div>
                                        <h3 class="fw-bold mb-1">Welcome back, {{ auth()->user()->name }}!</h3>
                                        <p class="mb-0 text-white-50">You have managed {{ $totalSchools }} schools and {{ $totalVendors }} vendors today. The system is operating at <span class="text-warning fw-bold">100% efficiency</span>.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 col-xl-4 text-lg-end mt-3 mt-lg-0">
                                <img src="{{ asset('assets/media-79.svg') }}" alt="welcome" class="img-fluid" style="height: 120px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 2: Three Stat Cards --}}
        <div class="row row-sm">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-item">
                            <div class="card-item-title mb-2">
                                <label class="main-content-label fs-13 fw-bold mb-1 text-uppercase">Total Schools</label>
                                <span class="d-block text-muted fs-12">Registered Institutions</span>
                            </div>
                            <div class="card-item-body">
                                <div class="card-item-stat">
                                    <h4 class="fw-bold mb-0">{{ $totalSchools }}</h4>
                                    <small class="text-success"><b class="me-1">{{ $activeSchools }}</b>Active</small>
                                </div>
                                <div class="card-item-icon bg-primary-transparent">
                                    <i class="ti ti-school text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-item">
                            <div class="card-item-title mb-2">
                                <label class="main-content-label fs-13 fw-bold mb-1 text-uppercase">Total Vendors</label>
                                <span class="d-block text-muted fs-12">Partner Businesses</span>
                            </div>
                            <div class="card-item-body">
                                <div class="card-item-stat">
                                    <h4 class="fw-bold mb-0">{{ $totalVendors }}</h4>
                                    <small class="text-success"><b class="me-1">{{ $approvedVendors }}</b>Approved</small>
                                </div>
                                <div class="card-item-icon bg-info-transparent">
                                    <i class="ti ti-users text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-item">
                            <div class="card-item-title mb-2">
                                <label class="main-content-label fs-13 fw-bold mb-1 text-uppercase">System Classes</label>
                                <span class="d-block text-muted fs-12">Active Curriculum</span>
                            </div>
                            <div class="card-item-body">
                                <div class="card-item-stat">
                                    <h4 class="fw-bold mb-0">{{ $totalClasses }}</h4>
                                    <small class="text-info">Total defined classes</small>
                                </div>
                                <div class="card-item-icon bg-warning-transparent">
                                    <i class="ti ti-book text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 3: Large Trends Chart --}}
        <div class="row row-sm">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="card custom-card">
                    <div class="card-header border-bottom-0 pb-0">
                        <label class="main-content-label mb-2">Registration Trends</label>
                        <span class="d-block fs-12 text-muted mb-0">Analysis of onboarded entities over time.</span>
                    </div>
                    <div class="card-body">
                        <div id="registration-trends-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Column: Activity & Sidebar --}}
    <div class="col-sm-12 col-lg-12 col-xl-3">
        <div class="card custom-card">
            <div class="card-header border-bottom-0 pb-0">
                <label class="main-content-label mb-2">Recent Registrations</label>
                <span class="d-block fs-12 text-muted mb-3">Onboarding history on completion</span>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentSchools as $rSchool)
                        <div class="list-group-item d-flex align-items-center border-0 py-3">
                            <div class="avatar avatar-md rounded-circle bg-light me-3">
                                <i class="ti ti-school fs-20 text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-0 fs-13">{{ $rSchool->school_name }}</h6>
                                <span class="text-muted fs-11">{{ $rSchool->city }}</span>
                            </div>
                            <div class="text-end">
                                <h6 class="fw-bold mb-0 fs-13 text-success">Active</h6>
                                <span class="text-muted fs-11">{{ $rSchool->created_at->format('d M') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-3 text-center text-muted small italic">No recent activity.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="card custom-card overflow-hidden">
            <div class="card-body text-center">
                <div class="mb-3">
                    <img src="{{ asset('assets/media-79.svg') }}" alt="launch" class="img-fluid" style="height: 100px;">
                </div>
                <h6 class="main-content-label mb-1">System Health</h6>
                <p class="text-muted fs-12 mb-3">The system is running optimally</p>
                <h4 class="fw-bold mb-0 text-primary">100% Up</h4>
                <p class="text-muted fs-11 mt-1">Status: Operational</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Main Trends Chart
        initDashboardChart("#registration-trends-chart", "area", 
            [
                {
                    name: 'Schools',
                    data: @json($registrationTrends['schools'])
                },
                {
                    name: 'Vendors',
                    data: @json($registrationTrends['vendors'])
                }
            ], 
            @json($registrationTrends['months']),
            { 
                colors: ['#6259ca', '#53caed'], // Purple and Blue like in image
                height: 400
            }
        );
    });
</script>
@endpush
