<div class="row mt-4">
    {{-- Welcome Card --}}
    <div class="col-lg-12 mb-4">
        <div class="card custom-card shadow-sm border-0 bg-primary text-white overflow-hidden">
            <div class="card-body p-4 position-relative">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-1">Welcome, {{ $vendor->business_name ?? auth()->user()->name }}!</h3>
                        <p class="mb-0 text-white-50">Manage your business profile and monitor your partnership status.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fs-14 fw-bold shadow-sm">
                            <i class="ti ti-calendar-event me-1"></i> {{ now()->format('l, d M Y') }}
                        </span>
                    </div>
                </div>
                {{-- Decorative SVG --}}
                <div class="position-absolute end-0 bottom-0 opacity-10 mb-n4 me-n4">
                    <i class="ti ti-building-store" style="font-size: 15rem;"></i>
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
                        <p class="text-muted small fw-bold text-uppercase mb-1">Business Status</p>
                        <div class="mt-1">
                            @if($vendor && $vendor->status === 'approved')
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">
                                    <i class="ti ti-circle-check-filled me-1"></i>Approved
                                </span>
                            @elseif($vendor && $vendor->status === 'pending')
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-bold">
                                    <i class="ti ti-clock-filled me-1"></i>Pending Review
                                </span>
                            @elseif($vendor)
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold">
                                    <i class="ti ti-circle-x-filled me-1"></i>{{ ucfirst($vendor->status) }}
                                </span>
                            @else
                                 <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-bold">
                                    <i class="ti ti-alert-triangle-filled me-1"></i>Not Linked
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                        <i class="ti ti-shield-check fs-3"></i>
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
                        <p class="text-muted small fw-bold text-uppercase mb-1">Commission Rate</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $vendor->commission_rate ?? '0.00' }}%</h3>
                    </div>
                    <div class="bg-info-subtle text-info p-3 rounded-circle">
                        <i class="ti ti-percentage fs-3"></i>
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
                        <p class="text-muted small fw-bold text-uppercase mb-1">Visibility</p>
                        <div class="mt-1">
                            <x-status-badge :value="$vendor->is_active ?? false" :active="true" :inactive="false" />
                        </div>
                    </div>
                    <div class="bg-success-subtle text-success p-3 rounded-circle">
                        <i class="ti ti-eye fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card custom-card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold"><i class="ti ti-info-circle me-2 text-primary"></i>Next Steps</h6>
            </div>
            <div class="card-body">
                @if(!$vendor)
                     <div class="alert alert-warning border-0 shadow-none mb-0">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-alert-triangle fs-2 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Account Configuration Incomplete</h6>
                                <p class="mb-0 small">Your user account is not yet linked to a vendor profile. Please contact the system administrator to complete your onboarding.</p>
                            </div>
                        </div>
                    </div>
                @elseif($vendor->status === 'pending')
                    <div class="alert alert-info border-0 shadow-none mb-0">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-loader ti-spin fs-2 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Your application is being reviewed</h6>
                                <p class="mb-0 small">Our administrators are currently verifying your business details. You will receive an email once your account is approved.</p>
                            </div>
                        </div>
                    </div>
                @elseif($vendor->status === 'approved')
                    <div class="d-flex align-items-center">
                        <i class="ti ti-confetti fs-2 text-success me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">You are all set!</h6>
                            <p class="mb-0 small text-muted">Congratulations! Your business is verified. You can now start managing your inventory and school partnerships within the system.</p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger border-0 shadow-none mb-0">
                         <div class="d-flex align-items-center">
                            <i class="ti ti-circle-x fs-2 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Account Restricted</h6>
                                <p class="mb-0 small">Your account status is currently: <strong>{{ ucfirst($vendor->status) }}</strong>. Please contact support for assistance.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
