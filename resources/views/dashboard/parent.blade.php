<div class="row mt-4">
    {{-- Welcome Card --}}
    <div class="col-lg-12 mb-4">
        <div class="card custom-card shadow-sm border-0 bg-primary text-white overflow-hidden">
            <div class="card-body p-4 position-relative">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-1">Hello, {{ auth()->user()?->name ?? 'User' }}!</h3>
                        <p class="mb-0 text-white-50">Welcome to your Kwality Uniform parent portal. Manage your children's school uniforms with ease.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fs-14 fw-bold shadow-sm">
                            <i class="ti ti-calendar-event me-1"></i> {{ now()->format('l, d M Y') }}
                        </span>
                    </div>
                </div>
                {{-- Decorative SVG --}}
                <div class="position-absolute end-0 bottom-0 opacity-10 mb-n4 me-n4">
                    <i class="ti ti-users" style="font-size: 15rem;"></i>
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
                        <p class="text-muted small fw-bold text-uppercase mb-1">My Orders</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $ordersCount ?? 0 }}</h3>
                    </div>
                    <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                        <i class="ti ti-shopping-cart fs-3"></i>
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
                        <p class="text-muted small fw-bold text-uppercase mb-1">Active Requests</p>
                        <h3 class="fw-bold mb-0 text-success">{{ $activeSubscriptions ?? 0 }}</h3>
                    </div>
                    <div class="bg-success-subtle text-success p-3 rounded-circle">
                        <i class="ti ti-bell-ringing fs-3"></i>
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
                        <p class="text-muted small fw-bold text-uppercase mb-1">Unread Alerts</p>
                        <h3 class="fw-bold mb-0 text-warning">{{ $notificationsCount ?? 0 }}</h3>
                    </div>
                    <div class="bg-warning-subtle text-warning p-3 rounded-circle">
                        <i class="ti ti-message-report fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card custom-card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold"><i class="ti ti-user-plus me-2 text-primary"></i>My Children</h6>
            </div>
            <div class="card-body">
                <div class="text-center py-5">
                    <div class="bg-light-subtle p-4 rounded-circle d-inline-block mb-3">
                        <i class="ti ti-user-search fs-1 text-muted"></i>
                    </div>
                    <h5 class="fw-bold">No children linked yet</h5>
                    <p class="text-muted small mb-4">Add your children's details and school affiliation to start ordering uniforms.</p>
                    <button class="btn btn-primary px-4 py-2 fw-bold">
                        <i class="ti ti-plus me-1"></i> Add Child Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card custom-card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold"><i class="ti ti-help-circle me-2 text-info"></i>Need Help?</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center border-0 rounded-3 mb-2 bg-light-subtle py-3">
                        <div class="bg-info text-white p-2 rounded-circle me-3">
                            <i class="ti ti-book fs-6"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-semibold small">How to Order?</p>
                            <small class="text-muted">A quick guide for new parents</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center border-0 rounded-3 bg-light-subtle py-3">
                        <div class="bg-warning text-white p-2 rounded-circle me-3">
                            <i class="ti ti-headset fs-6"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-semibold small">Support Center</p>
                            <small class="text-muted">Contact us for any assistance</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
