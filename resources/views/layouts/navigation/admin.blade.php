{{-- Admin Navigation --}}
<li class="slide__category"><span class="category-name">Admin Dashboard</span></li>
<li class="slide {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
    <a href="{{ route("dashboard") }}" class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
        <span class="shape1"></span> <span class="shape2"></span> 
        <i class="ti-home side-menu__icon"></i> 
        <span class="side-menu__label">Dashboard</span> 
    </a> 
</li>

@can('courier.view')
    <li class="slide {{ request()->routeIs('couriers.*') ? 'active' : '' }}">
        <a href="{{ route('couriers.index') }}" class="side-menu__item {{ request()->routeIs('couriers.*') ? 'active' : '' }}">
            <i class="ti ti-truck-delivery side-menu__icon"></i>
            <span class="side-menu__label">Courier Management</span>
        </a>
    </li>
@endcan

@canany(['vendor.create', 'vendor.view'])
    <li class="slide has-sub {{ request()->routeIs('vendor.*') ? 'open' : '' }} {{ request()->routeIs('vendor.*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('vendor.*') ? 'active' : '' }}">
            <i class="ti-wallet side-menu__icon"></i>
            <span class="side-menu__label">Vendor Management</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs('vendor.*') ? 'double-menu-active' : '' }}">
            @can('vendor.create')
                <li class="slide">
                    <a href="{{ route('vendor.create') }}" class="side-menu__item {{ request()->routeIs('vendor.create') ? 'active' : '' }}">Create</a>
                </li>
            @endcan
            @can('vendor.view')
                <li class="slide">
                    <a href="{{ route('vendor.index') }}" class="side-menu__item {{ request()->routeIs('vendor.index') ? 'active' : '' }}">Vendors</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

<li class="slide__category"><span class="category-name">Product Management</span></li>
@canany(['category.view', 'category.create', 'size.view', 'color.view'])
    <li class="slide has-sub {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'open' : '' }} {{ request()->routeIs(['vendor.category.*', 'vendor.parent-category.*', 'vendor.size.*', 'vendor.color.*']) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['vendor.category.*', 'vendor.parent-category.*', 'vendor.size.*', 'vendor.color.*']) ? 'active' : '' }}">
            <i class="ti-package side-menu__icon"></i>
            <span class="side-menu__label">Product Attributes</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'double-menu-active' : '' }}">
            @canany(['parent-category.view', 'parent-category.create'])
                <li class="slide">
                    <a href="{{ route('parent-category.index') }}" class="side-menu__item {{ request()->routeIs('parent-category.*') ? 'active' : '' }}">Parent Categories</a>
                </li>
            @endcanany
            {{-- @canany(['category.view', 'category.create'])
                <li class="slide">
                    <a href="{{ route('category.index') }}" class="side-menu__item {{ request()->routeIs('category.*') ? 'active' : '' }}">Sub Categories</a>
                </li>
            @endcanany
            @can('size.view')
                <li class="slide">
                    <a href="{{ route('size.index') }}" class="side-menu__item {{ request()->routeIs('size.*') ? 'active' : '' }}">Manage Sizes</a>
                </li>
            @endcan
            @can('color.view')
                <li class="slide">
                    <a href="{{ route('color.index') }}" class="side-menu__item {{ request()->routeIs('color.*') ? 'active' : '' }}">Manage Colors</a>
                </li>
            @endcan --}}
        </ul>
    </li>
@endcanany
@can('product_approval_view')
    <li class="slide has-sub {{ request()->routeIs('product-approval.*') ? 'open' : '' }} {{ request()->routeIs('product-approval.*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('product-approval.*') ? 'active' : '' }}">
            <i class="ti-shopping-cart side-menu__icon"></i>
            <span class="side-menu__label">Product Approvals</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs('product-approval.*') ? 'double-menu-active' : '' }}">
            <li class="slide">
                <a href="{{ route('product-approval.index') }}" class="side-menu__item {{ request()->routeIs('product-approval.index') ? 'active' : '' }}">Approval Queue</a>
            </li>
            <li class="slide">
                <a href="{{ route('product-approval.approved') }}" class="side-menu__item {{ request()->routeIs('product-approval.approved') ? 'active' : '' }}">Approved Products</a>
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

@can('parent.view')
    <li class="slide has-sub {{ request()->routeIs('parent-user.*') ? 'open' : '' }} {{ request()->routeIs('parent-user.*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('parent-user.*') ? 'active' : '' }}">
            <i class="ti ti-users side-menu__icon"></i>
            <span class="side-menu__label">Parent Management</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs('parent-user.*') ? 'double-menu-active' : '' }}">
            <li class="slide">
                <a href="{{ route('parent-user.index') }}" class="side-menu__item {{ request()->routeIs('parent-user.index') ? 'active' : '' }}">Manage Parents</a>
            </li>
            <li class="slide">
                <a href="{{ route('parent-user.report') }}" class="side-menu__item {{ request()->routeIs('parent-user.report') ? 'active' : '' }}">Parent Report</a>
            </li>
        </ul>
    </li>
@endcan

@canany(['school.view', 'school.create'])
    <li class="slide has-sub {{ (request()->routeIs('school.*') && !request()->routeIs('school-standard.*')) ? 'open' : '' }} {{ (request()->routeIs('school.*') && !request()->routeIs('school-standard.*')) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ (request()->routeIs('school.*') && !request()->routeIs('school-standard.*')) ? 'active' : '' }}">
            <i class="ti ti-school side-menu__icon"></i>
            <span class="side-menu__label">School Management</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ (request()->routeIs('school.*') && !request()->routeIs('school-class.*')) ? 'double-menu-active' : '' }}">
            @can('school.create')
                <li class="slide">
                    <a href="{{ route('school.create') }}" class="side-menu__item {{ request()->routeIs('school.create') ? 'active' : '' }}">Create School</a>
                </li>
            @endcan
            @can('school.view')
                <li class="slide">
                    <a href="{{ route('school.index') }}" class="side-menu__item {{ request()->routeIs('school.index') ? 'active' : '' }}">Manage Schools</a>
                </li>
            @endcan
            @can('school_vendor.view')
                <li class="slide">
                    <a href="{{ route('school-vendor-mapping.index') }}" class="side-menu__item {{ request()->routeIs('school-vendor-mapping.*') ? 'active' : '' }}">School Vendor Mapping</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@canany(['role.view', 'role.create', 'admin.view'])
    <li class="slide has-sub {{ request()->routeIs(['role.*', 'admin.*']) ? 'open' : '' }} {{ request()->routeIs(['role.*', 'admin.*']) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['role.*', 'admin.*']) ? 'active' : '' }}">
            <i class="ti-user side-menu__icon"></i>
            <span class="side-menu__label">Access Control</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs(['role.*', 'admin.*']) ? 'double-menu-active' : '' }}">
            @canany(['role.view', 'role.create'])
                <li class="slide">
                    <a href="{{ route('role.index') }}" class="side-menu__item {{ request()->routeIs('role.index') ? 'active' : '' }}">Manage Roles</a>
                </li>
            @endcanany
            @can('admin.view')
                <li class="slide">
                    <a href="{{ route('admin.index') }}" class="side-menu__item {{ request()->routeIs('admin.index') ? 'active' : '' }}">Manage Admins</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@can('report.recent_orders.view')
    <li class="slide {{ request()->routeIs('reports.recent-orders.*') ? 'active' : '' }}">
        <a href="{{ route('reports.recent-orders.index') }}" class="side-menu__item {{ request()->routeIs('reports.recent-orders.*') ? 'active' : '' }}">
            <i class="ti ti-report side-menu__icon"></i>
            <span class="side-menu__label">Recent Orders Report</span>
        </a>
    </li>
@endcan
