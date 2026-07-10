<header class="app-header"> <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid"> <!-- Start::header-content-left -->
        <div class="header-content-left"> <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="{{ route('dashboard') }}" class="header-logo">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="logo-fixed-header">
                    </a>
                </div>

                <style>
                    .logo-fixed-header {
                        display: block !important;
                        max-height: 35px;
                        width: auto;
                        visibility: visible !important;
                        opacity: 1 !important;
                        object-fit: contain;
                        /* White background effect */
                        background-color: #ffffff;
                        padding: 4px 10px;
                        border-radius: 6px;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
                    }
                    .header-logo {
                        display: flex !important;
                        align-items: center;
                    }
                </style>
            </div> <!-- End::header-element --> <!-- Start::header-element -->
            <div class="header-element"> <!-- Start::header-link --> <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a> <!-- End::header-link -->
            </div>
            <!-- End::header-element -->
        </div> <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right"> <!-- Start::header-element -->
            <div class="header-element header-theme-mode"> <!-- Start::header-link|layout-setting --> <a
                    href="javascript:void(0);" class="header-link layout-setting"> <span class="light-layout">
                        <!-- Start::header-link-icon --> <i class="fe fe-moon header-link-icon lh-2"></i>
                        <!-- End::header-link-icon --> </span> <span class="dark-layout">
                        <!-- Start::header-link-icon --> <i class="fe fe-sun header-link-icon lh-2"></i>
                        <!-- End::header-link-icon --> </span> </a> <!-- End::header-link|layout-setting --> </div>
            <!-- End::header-element --> <!-- Start::header-element -->
            <!-- End::header-element --> <!-- Start::header-element -->
            <div class="header-element header-fullscreen  d-xl-flex d-none"> <!-- Start::header-link --> <a
                    onclick="openFullscreen();" href="javascript:void(0);" class="header-link"> <i
                        class="fe fe-maximize full-screen-open header-link-icon"></i> <i
                        class="fe fe-minimize full-screen-close header-link-icon d-none"></i> </a>
                <!-- End::header-link --> </div> <!-- End::header-element --> <!-- Start::header-element -->
            <div class="header-element notifications-dropdown">

                <!-- Bell Icon -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" id="messageDropdown">

                    <i class="fe fe-bell header-link-icon"></i>

                    <span
                        class="badge bg-secondary header-icon-badge pulse pulse-secondary {{ auth()->user()?->unreadNotifications()->count() ? '' : 'd-none' }}"
                        id="notification-icon-badge">

                        {{ auth()->user()?->unreadNotifications()->count() ?? 0 }}

                    </span>

                </a>

                <!-- Notification Dropdown -->
                <div class="main-header-dropdown dropdown-menu dropdown-menu-end">

                    <!-- Header -->
                    <div class="p-3">
                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <h6 class="mb-0 fw-semibold">
                                    Notifications
                                </h6>

                                <small class="text-muted">
                                    Latest updates
                                </small>
                            </div>

                            <span class="badge bg-secondary rounded-pill" id="notifiation-data">

                                {{ auth()->user()?->unreadNotifications()->count() ?? 0 }}
                                Unread

                            </span>

                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <!-- Notification List -->
                    <ul class="list-unstyled mb-0" id="header-notification-scroll" data-simplebar
                        style="max-height:350px;">

                        @forelse(auth()->user()?->unreadNotifications()
                    ->latest()
                    ->take(5)
                    ->get()
                as $notification)
                            <li class="dropdown-item border-bottom py-3 notification-item"
                                id="notification-{{ $notification->id }}">

                                <div class="d-flex align-items-start">

                                    <div class="pe-3">
                                        <span class="avatar avatar-md bg-primary-transparent br-5">
                                            <i class="ti ti-bell fs-18 text-primary"></i>
                                        </span>
                                    </div>

                                    <div class="flex-grow-1">

                                        <p class="mb-1">
                                            <a href="javascript:void(0);"
                                                onclick="markNotificationAsRead(
                                                        '{{ $notification->id }}',
                                                        '{{ $notification->data['url'] ?? '#' }}'
                                                    )"
                                                class="text-dark text-decoration-none fw-semibold">

                                                {{ $notification->data['message'] ?? 'New Notification' }}

                                            </a>
                                        </p>

                                        <small class="text-muted">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>

                                    </div>

                                    <div>
                                        <a href="javascript:void(0);"
                                            onclick="hideNotification('{{ $notification->id }}')" class="text-muted">

                                            <i class="ti ti-x fs-16"></i>

                                        </a>
                                    </div>

                                </div>

                            </li>

                        @empty

                            <div class="p-5 text-center">

                                <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">

                                    <i class="ri-notification-off-line fs-2"></i>

                                </span>

                                <h6 class="fw-semibold mt-3">
                                    No New Notifications
                                </h6>

                                <p class="text-muted mb-0">
                                    You're all caught up.
                                </p>

                            </div>
                        @endforelse

                    </ul>

                    <!-- Footer -->
                    <div class="p-3 border-top">

                        <div class="d-grid">

                            <a href="{{ route('notifications.index') }}" class="btn btn-primary">

                                View All Notifications

                            </a>

                        </div>

                    </div>

                </div>

            </div> <!-- End::header-element --> <!-- Start::header-element -->
            <div class="header-element"> <!-- Start::header-link|dropdown-toggle --> <a href="javascript:void(0);"
                    class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="header-link-icon">
<img src="{{ auth()->user()?->userLogo() ?: asset('assets/images/no_image.jpg') }}"
     alt="User"
     width="32"
     height="32"
     class="rounded-circle border">
                        </div>
                        <div class="d-none">
                            <p class="fw-semibold mb-0">{{ auth()->user()?->name ?? 'Guest' }}</p>
                        </div>
                    </div>
                </a> <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <li>
                        <div class="header-navheading border-bottom">
                            <h6 class="main-notification-title text-dark">{{ auth()->user()?->name ?? 'Guest' }}</h6>
                            <p class="main-notification-text mb-0 text-muted small">{{ auth()->user()?->email ?? 'Guest' }}
                            </p>
                        </div>
                    </li>
                    <li><a class="dropdown-item d-flex border-bottom" href="{{ route('profile.edit') }}"><i
                                class="ti ti-user fs-16 align-middle me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item d-flex border-bottom" href="{{ route('website.orders.index') }}"><i
                                class="ti ti-package fs-16 align-middle me-2"></i>My Orders</a></li>
                    <li><a class="dropdown-item d-flex border-bottom" href="{{ route('website.orders.index') }}"><i
                                class="ti ti-truck-delivery fs-16 align-middle me-2"></i>Track Order</a></li>
                    <li><a class="dropdown-item d-flex border-bottom" href="{{ route('lockscreen.lock') }}"><i
                                class="fe fe-lock fs-16 align-middle me-2"></i>Lock Screen</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-header-form">
                            @csrf
                            <a class="dropdown-item d-flex" href="javascript:void(0);" onclick="confirmLogout();"
                                style="cursor: pointer !important;">
                                <i class="fe fe-power fs-16 align-middle me-2"></i>Log Out
                            </a>
                        </form>
                    </li>
                </ul>
            </div> <!-- End::header-element --> <!-- Start::header-element -->

            <!-- End::header-element --> <!-- Start::header-element -->
            <div class="header-element"> <!-- Start::header-link|switcher-icon --> <a href="javascript:void(0);"
                    class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                    <i class="fe fe-settings header-link-icon"></i> </a> <!-- End::header-link|switcher-icon -->
            </div>
            <!-- End::header-element -->
        </div> <!-- End::header-content-right -->
    </div> <!-- End::main-header-container -->
</header>

<script>
    function markNotificationAsRead(id, redirectUrl = null) {
        fetch('{{ route('notifications.markAsRead') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    } else {
                        location.reload();
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out of your session!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6B62DD',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Log Out!',
            cancelButtonText: 'Stay Logged In',
            customClass: {
                confirmButton: 'btn btn-primary rounded-pill px-4',
                cancelButton: 'btn btn-light rounded-pill px-4 ms-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-header-form').submit();
            }
        })
    }
</script>
<script>
    window.userId = {{ auth()->id() ?? 'null' }};
</script>
