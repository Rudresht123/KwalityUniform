<aside class="app-sidebar sticky" id="sidebar"> 
    <div class="main-sidebar-header"> 
        <a href="{{ route('dashboard') }}" class="header-logo"> 
            <img src="{{ asset('assets/images/logo.svg') }}" class="logo-fixed" alt="logo"> 
        </a> 
    </div>

    <style>
        .header-logo {
            display: flex !important;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 15px 10px;
            width: 100%;
        }

        .logo-fixed {
            display: block !important;
            max-height: 40px;
            width: auto;
            max-width: 80%;
            object-fit: contain;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
            visibility: visible !important;
            opacity: 1 !important;
            /* White background effect */
            background-color: #ffffff;
          /* //  padding: 5px 12px; */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header-logo:hover .logo-fixed {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2)) brightness(1.1);
        }

        @media (max-width: 991.98px) {
            .main-sidebar-header {
                padding: 10px;
            }
            .logo-fixed {
                max-height: 30px !important;
                padding: 4px 10px;
            }
        }
    </style>
    <!-- End::main-sidebar-header --> <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -14.4px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer">
                    
                </div>
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
                                    <li class="slide {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
                                        <a href="{{ route("dashboard") }}" class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
                                            <span class="shape1"></span> <span class="shape2"></span> 
                                            <i class="ti-home side-menu__icon"></i> 
                                            <span class="side-menu__label">Dashboard</span> 
                                        </a> 
                                    </li> <!-- End::slide -->
                                    <!-- Start::slide -->
                                    @can('partnership.view')
                                        <li class="slide {{ request()->routeIs('partnership.*') ? 'active' : '' }}">
                                            <a href="{{ route('partnership.index') }}" class="side-menu__item {{ request()->routeIs('partnership.index') ? 'active' : '' }}">
                                                <i class="ti ti-user-check side-menu__icon"></i>
                                                <span class="side-menu__label">Partnership Requests</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @canany(['vendor.create', 'vendor.view'])

                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('vendor.*')) ? 'open' : '' }} {{ request()->routeIs('vendor.*') ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('vendor.*') ? 'active' : '' }}">
                                                <i class="ti-wallet side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    Vendor Management
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>

                                            <ul class="slide-menu child1 {{ request()->routeIs('vendor.*') ? 'double-menu-active' : '' }}">

                                                @can('vendor.create')
                                                    <li class="slide">
                                                        <a href="{{ route('vendor.create') }}" class="side-menu__item {{ request()->routeIs('vendor.create') ? 'active' : '' }}">
                                                            Create
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('vendor.view')
                                                    <li class="slide">
                                                        <a href="{{ route('vendor.index') }}" class="side-menu__item {{ request()->routeIs('vendor.index') ? 'active' : '' }}">
                                                            Vendors
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany 

                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">Product Management</span></li>
                                    <!-- End::slide__category -->

                                    @if(auth()->user()->hasRole('vendor'))
                                    @canany(['product.view', 'product.create'])

                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('product.*')) ? 'open' : '' }} {{ request()->routeIs('product.*') ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('product.*') ? 'active' : '' }}">
                                                <i class="ti-shopping-cart side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    Product Management
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>

                                            <ul class="slide-menu child1 {{ request()->routeIs('product.*') ? 'double-menu-active' : '' }}">

                                                @can('product.create')
                                                    <li class="slide">
                                                        <a href="{{ route('product.create') }}" class="side-menu__item {{ request()->routeIs('product.create') ? 'active' : '' }}">
                                                            Add Product
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('product.view')
                                                    <li class="slide">
                                                        <a href="{{ route('product.index') }}" class="side-menu__item {{ request()->routeIs('product.index') ? 'active' : '' }}">
                                                            Manage Products
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('product_assignment.view')
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('product-assignment.*') ? 'active' : '' }}">
                                                            Product Assignments
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany
                                    @endif


                                    @if(userRole() === 'super-admin')
                                    @can('product_approval_view')
                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('product-approval.*')) ? 'open' : '' }} {{ request()->routeIs('product-approval.*') ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('product-approval.*') ? 'active' : '' }}">
                                                <i class="ti-shopping-cart side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    Product Approvals
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>

                                            <ul class="slide-menu child1 {{ request()->routeIs('product-approval.*') ? 'double-menu-active' : '' }}">

                                                <li class="slide">
                                                    <a href="{{ route('product-approval.index') }}" class="side-menu__item {{ request()->routeIs('product-approval.index') ? 'active' : '' }}">
                                                        Approval Queue
                                                    </a>
                                                </li>
                                                <li class="slide">
                                                    <a href="{{ route('product-approval.approved') }}" class="side-menu__item {{ request()->routeIs('product-approval.approved') ? 'active' : '' }}">
                                                        Approved Products
                                                    </a>
                                                </li>

                                            </ul>

                                        </li>
                                    @endcan
                                    @endif

                                    @if(!auth()->user()->hasRole('vendor'))
                                    @canany(['school.product.approve', 'school.product.report'])
                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('school.products.*')) ? 'open' : '' }} {{ request()->routeIs('school.products.*') ? 'active' : '' }}">
                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('school.products.*') ? 'active' : '' }}">
                                                <i class="ti-shopping-cart side-menu__icon"></i>
                                                <span class="side-menu__label">Product Management</span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>
                                            <ul class="slide-menu child1 {{ request()->routeIs('school.products.*') ? 'double-menu-active' : '' }}">
                                                @can('school.product.approve')
                                                    <li class="slide">
                                                        <a href="{{ route('school.products.index') }}" class="side-menu__item {{ request()->routeIs('school.products.index') ? 'active' : '' }}">
                                                            Approve Products
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('school.product.report')
                                                    <li class="slide">
                                                        <a href="{{ route('school.products.approved') }}" class="side-menu__item {{ request()->routeIs('school.products.approved') ? 'active' : '' }}">
                                                            Approved Products
                                                        </a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endcan
                                    @endif

                                    @canany(['category.view', 'category.create', 'size.view', 'color.view'])


                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*'])) ? 'open' : '' }} {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'active' : '' }}">
                                                <i class="ti-package side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    Product Attributes
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>

                                            <ul class="slide-menu child1 {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'double-menu-active' : '' }}">

                                                @canany(['category.view', 'category.create'])
                                                    <li class="slide">
                                                        <a href="{{ route('parent-category.index') }}" class="side-menu__item {{ request()->routeIs('parent-category.*') ? 'active' : '' }}">
                                                            Parent Categories
                                                        </a>
                                                    </li>

                                                    <li class="slide">
                                                        <a href="{{ route('category.index') }}" class="side-menu__item {{ request()->routeIs('category.*') ? 'active' : '' }}">
                                                            Sub Categories
                                                        </a>
                                                    </li>
                                                @endcanany

                                                @can('size.view')
                                                    <li class="slide">
                                                        <a href="{{ route('size.index') }}" class="side-menu__item {{ request()->routeIs('size.*') ? 'active' : '' }}">
                                                            Manage Sizes
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('color.view')
                                                    <li class="slide">
                                                        <a href="{{ route('color.index') }}" class="side-menu__item {{ request()->routeIs('color.*') ? 'active' : '' }}">
                                                            Manage Colors
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany

                                    @can('stock_view')
                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*'])) ? 'open' : '' }} {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'active' : '' }}">
                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'active' : '' }}">
                                                <i class="ti-dropbox side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    Inventory Management
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>
                                            <ul class="slide-menu child1 {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'double-menu-active' : '' }}">
                                                <li class="slide">
                                                    <a href="{{ route('stock-management.index') }}" class="side-menu__item {{ request()->routeIs('stock-management.index') ? 'active' : '' }}">
                                                        Stock Management
                                                    </a>
                                                </li>
                                                <li class="slide">
                                                    <a href="{{ route('stock.index') }}" class="side-menu__item {{ request()->routeIs('stock.index') ? 'active' : '' }}">
                                                        Low Stock Alert
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endcan

                                    @can('global_settings.view')
                                        <li class="slide {{ request()->routeIs('global-settings.*') ? 'active' : '' }}">
                                            <a href="{{ route('global-settings.index') }}" class="side-menu__item {{ request()->routeIs('global-settings.index') ? 'active' : '' }}">
                                                <i class="ti-settings side-menu__icon"></i>
                                                <span class="side-menu__label">Global Settings</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('user.view')
                                        <li class="slide {{ request()->routeIs('user-status-report.*') ? 'active' : '' }}">
                                            <a href="{{ route('user-status-report.index') }}" class="side-menu__item {{ request()->routeIs('user-status-report.index') ? 'active' : '' }}">
                                                <i class="ti ti-user-check side-menu__icon"></i>
                                                <span class="side-menu__label">User Status Report</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @if(!auth()->user()->hasRole('vendor'))
                                    @can('parent.view')
                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('parent-user.*')) ? 'open' : '' }} {{ request()->routeIs('parent-user.*') ? 'active' : '' }}">
                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('parent-user.*') ? 'active' : '' }}">
                                                <i class="ti ti-users side-menu__icon"></i>
                                                <span class="side-menu__label">Parent Management</span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>
                                            <ul class="slide-menu child1 {{ request()->routeIs('parent-user.*') ? 'double-menu-active' : '' }}">
                                                <li class="slide">
                                                    <a href="{{ route('parent-user.index') }}" class="side-menu__item {{ request()->routeIs('parent-user.index') ? 'active' : '' }}">
                                                        Manage Parents
                                                    </a>
                                                </li>
                                                <li class="slide">
                                                    <a href="{{ route('parent-user.report') }}" class="side-menu__item {{ request()->routeIs('parent-user.report') ? 'active' : '' }}">
                                                        Parent Report
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endcan
                                    @endif

                                    @canany(['school.view', 'school.create'])


                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || (request()->routeIs('school.*') && !request()->routeIs('school-standard.*'))) ? 'open' : '' }} {{ (request()->routeIs('school.*') && !request()->routeIs('school-standard.*')) ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ (request()->routeIs('school.*') && !request()->routeIs('school-standard.*')) ? 'active' : '' }}">

                                                <span class="shape1"></span>
                                                <span class="shape2"></span>

                                                <i class="ti ti-school side-menu__icon"></i>

                                                <span class="side-menu__label">
                                                    School Management
                                                </span>

                                                <i class="fe fe-chevron-right side-menu__angle"></i>

                                            </a>

                                            <ul class="slide-menu child1 {{ (request()->routeIs('school.*') && !request()->routeIs('school-class.*')) ? 'double-menu-active' : '' }}">

                                                @can('school.create')
                                                    <li class="slide">
                                                        <a href="{{ route('school.create') }}" class="side-menu__item {{ request()->routeIs('school.create') ? 'active' : '' }}">
                                                            Create School
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('school.view')
                                                    <li class="slide">
                                                        <a href="{{ route('school.index') }}" class="side-menu__item {{ request()->routeIs('school.index') ? 'active' : '' }}">
                                                            Manage Schools
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany

                                    @canany(['school_board.view', 'school_board.create'])
                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('school-boards.*')) ? 'open' : '' }} {{ request()->routeIs('school-boards.*') ? 'active' : '' }}">
                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('school-boards.*') ? 'active' : '' }}">
                                                <span class="shape1"></span>
                                                <span class="shape2"></span>
                                                <i class="ti ti-list-details side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    School Board Management
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>
                                            <ul class="slide-menu child1 {{ request()->routeIs('school-boards.*') ? 'double-menu-active' : '' }}">
                                                @can('school_board.create')
                                                    <li class="slide">
                                                        <a href="{{ route('school-boards.create') }}" class="side-menu__item {{ request()->routeIs('school-boards.create') ? 'active' : '' }}">
                                                            Add Board
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('school_board.view')
                                                    <li class="slide">
                                                        <a href="{{ route('school-boards.index') }}" class="side-menu__item {{ request()->routeIs('school-boards.index') ? 'active' : '' }}">
                                                            Manage Boards
                                                        </a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endcanany

                                    @canany(['school_standard.view', 'school_standard.create'])

                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs('school-standard.*')) ? 'open' : '' }} {{ request()->routeIs('school-standard.*') ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('school-standard.*') ? 'active' : '' }}">

                                                <span class="shape1"></span>
                                                <span class="shape2"></span>

                                                <i class="ti-book side-menu__icon"></i>

                                                <span class="side-menu__label">
                                                    Standard Management
                                                </span>

                                                <i class="fe fe-chevron-right side-menu__angle"></i>

                                            </a>

                                            <ul class="slide-menu child1 {{ request()->routeIs('school-standard.*') ? 'double-menu-active' : '' }}">

                                                @can('school_standard.create')
                                                    <li class="slide">
                                                        <a href="{{ route('school-standard.create') }}" class="side-menu__item {{ request()->routeIs('school-standard.create') ? 'active' : '' }}">
                                                            Add Standard
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('school_standard.view')
                                                    <li class="slide">
                                                        <a href="{{ route('school-standard.index') }}" class="side-menu__item {{ request()->routeIs('school-standard.index') ? 'active' : '' }}">
                                                            Manage Standards
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('school_section.view')
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('school-section.*') ? 'active' : '' }}">
                                                            Manage Sections
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany
                                    @canany(['role.view', 'role.create', 'admin.view'])

                                        <li class="slide has-sub {{ (userRole() === 'super-admin' || request()->routeIs(['role.*', 'admin.*'])) ? 'open' : '' }} {{ request()->routeIs(['role.*', 'admin.*']) ? 'active' : '' }}">

                                            <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['role.*', 'admin.*']) ? 'active' : '' }}">

                                                <span class="shape1"></span>
                                                <span class="shape2"></span>

                                                <i class="ti-user side-menu__icon"></i>

                                                <span class="side-menu__label">
                                                    Access Control
                                                </span>

                                                <i class="fe fe-chevron-right side-menu__angle"></i>

                                            </a>

                                            <ul class="slide-menu child1 {{ request()->routeIs(['role.*', 'admin.*']) ? 'double-menu-active' : '' }}">

                                                @canany(['role.view', 'role.create'])
                                                    <li class="slide">
                                                        <a href="{{ route('role.index') }}" class="side-menu__item {{ request()->routeIs('role.index') ? 'active' : '' }}">
                                                            Manage Roles
                                                        </a>
                                                    </li>
                                                @endcanany

                                                @can('admin.view')
                                                    <li class="slide">
                                                        <a href="{{ route('admin.index') }}" class="side-menu__item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                                                            Manage Admins
                                                        </a>
                                                    </li>
                                                @endcan

                                            </ul>

                                        </li>

                                    @endcanany

                                    @can('audit.view')
                                        <li class="slide {{ request()->routeIs('audit.*') ? 'active' : '' }}">
                                            <a href="{{ route('audit.index') }}" class="side-menu__item {{ request()->routeIs('audit.*') ? 'active' : '' }}">
                                                <i class="ti ti-history side-menu__icon"></i>
                                                <span class="side-menu__label">Audit Logs</span>
                                            </a>
                                        </li>
                                    @endcan
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
