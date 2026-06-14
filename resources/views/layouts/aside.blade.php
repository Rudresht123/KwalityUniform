<aside class="app-sidebar sticky" id="sidebar"> <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header"> 
        <a href="{{ route('dashboard') }}" class="header-logo"> 
            <img src="{{ asset('assets/icons/icon.png') }}" class="desktop-white logo-interactive" alt="logo"> 
            <img src="{{ asset('assets/icons/icon.png') }}" class="toggle-white logo-interactive" alt="logo"> 
            <img src="{{ asset('assets/icons/icon.png') }}" class="desktop-logo logo-interactive" alt="logo"> 
            <img src="{{ asset('assets/icons/icon.png') }}" class="toggle-dark logo-interactive" alt="logo"> 
            <img src="{{ asset('assets/icons/icon.png') }}" class="toggle-logo logo-interactive" alt="logo"> 
            <img src="{{ asset('assets/icons/icon.png') }}" class="desktop-dark logo-interactive" alt="logo"> 
        </a> 
    </div>

    <style>
        .header-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 10px;
        }

        .logo-interactive {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: drop-shadow(0 0 0 rgba(0,0,0,0));
        }

        .header-logo:hover .logo-interactive {
            transform: scale(1.1) rotate(2deg);
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15)) brightness(1.1);
        }

        .header-logo:active .logo-interactive {
            transform: scale(0.95);
        }

        /* Responsive Logo Sizing */
        [data-toggled="close"] .desktop-logo,
        [data-toggled="close"] .desktop-white,
        [data-toggled="close"] .desktop-dark {
            max-height: 40px;
            width: auto;
        }

        [data-toggled="open"] .toggle-logo,
        [data-toggled="open"] .toggle-white,
        [data-toggled="open"] .toggle-dark {
            max-height: 35px;
            width: auto;
        }

        @media (max-width: 991.98px) {
            .main-sidebar-header {
                padding: 15px;
            }
            .logo-interactive {
                max-height: 32px !important;
            }
        }
    </style>
    <!-- End::main-sidebar-header --> <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -14.4px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 14.4px 0px 80px;"> <!-- Start::nav -->
                            <nav class="main-menu-container nav nav-pills flex-column sub-open active">
                                <div class="slide-left active d-none" id="slide-left"> <svg
                                        xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                    </svg> </div>
                                <ul class="main-menu active" style="margin-left: 0px; margin-right: 0px;">
                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">Dashboard</span></li>
                                    <!-- End::slide__category --> <!-- Start::slide -->
                                    <li class="slide active"> <a href="{{ route("dashboard") }}" class="side-menu__item active"> <span
                                                class="shape1"></span> <span class="shape2"></span> <i
                                                class="ti-home side-menu__icon"></i> <span
                                                class="side-menu__label">Dashboard</span> </a> </li> <!-- End::slide -->
                                    <!-- Start::slide -->
                                    @canany(['vendor-create', 'vendor-list'])

                                        <li class="slide has-sub">

                                            <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ti-wallet side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    Vendor Management
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>

                                            <ul class="slide-menu child1">

                                                @can('vendor-create')
                                                    <li class="slide">
                                                        <a href="{{ route('vendor.create') }}" class="side-menu__item">
                                                            Create
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('vendor-list')
                                                    <li class="slide">
                                                        <a href="{{ route('vendor.index') }}" class="side-menu__item">
                                                            Vendors
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany <!-- End::slide --> <!-- Start::slide -->
                                    @canany(['school_view', 'school_create'])

                                        <li class="slide has-sub">

                                            <a href="javascript:void(0);" class="side-menu__item">

                                                <span class="shape1"></span>
                                                <span class="shape2"></span>

                                                <i class="ti ti-school side-menu__icon"></i>

                                                <span class="side-menu__label">
                                                    School Management
                                                </span>

                                                <i class="fe fe-chevron-right side-menu__angle"></i>

                                            </a>

                                            <ul class="slide-menu child1">

                                                @can('school_create')
                                                    <li class="slide">
                                                        <a href="{{ route('school.create') }}" class="side-menu__item">
                                                            Create School
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('school_view')
                                                    <li class="slide">
                                                        <a href="{{ route('school.index') }}" class="side-menu__item">
                                                            Manage Schools
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany

                                    @canany(['school_class.view', 'school_class.create'])

                                        <li class="slide has-sub">

                                            <a href="javascript:void(0);" class="side-menu__item">

                                                <span class="shape1"></span>
                                                <span class="shape2"></span>

                                                <i class="ti-book side-menu__icon"></i>

                                                <span class="side-menu__label">
                                                    Class Management
                                                </span>

                                                <i class="fe fe-chevron-right side-menu__angle"></i>

                                            </a>

                                            <ul class="slide-menu child1">

                                                @can('school_class.create')
                                                    <li class="slide">
                                                        <a href="{{ route('school-class.create') }}" class="side-menu__item">
                                                            Add Class
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('school_class.view')
                                                    <li class="slide">
                                                        <a href="{{ route('school-class.index') }}" class="side-menu__item">
                                                            Manage Classes
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany
                                    @canany(['role_view', 'role_create'])

                                        <li class="slide has-sub">

                                            <a href="javascript:void(0);" class="side-menu__item">

                                                <span class="shape1"></span>
                                                <span class="shape2"></span>

                                                <i class="ti ti-shield-lock side-menu__icon"></i>

                                                <span class="side-menu__label">
                                                    Role Management
                                                </span>

                                                <i class="fe fe-chevron-right side-menu__angle"></i>

                                            </a>

                                            <ul class="slide-menu child1">

                                                @can('role_create')
                                                    <li class="slide">
                                                        <a href="{{ route('role.create') }}" class="side-menu__item">
                                                            Create Role
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('role_view')
                                                    <li class="slide">
                                                        <a href="{{ route('role.index') }}" class="side-menu__item">
                                                            Manage Roles
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany
                                </ul>
                                <div class="slide-right d-none" id="slide-right"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                    </svg></div>
                            </nav> <!-- End::nav -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 969px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar"
                style="width: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 239px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div> <!-- End::main-sidebar -->
</aside>
