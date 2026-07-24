{{-- School Navigation --}}
<li class="slide__category"><span class="category-name">School Dashboard</span></li>
<li class="slide {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
    <a href="{{ route("dashboard") }}" class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
        <span class="shape1"></span> <span class="shape2"></span> 
        <i class="ti-home side-menu__icon"></i> 
        <span class="side-menu__label">Dashboard</span> 
    </a> 
</li>

<li class="slide__category"><span class="category-name">Product Management</span></li>

@canany(['school.product.approve', 'school.product.report'])
    <li class="slide has-sub {{ request()->routeIs('school.products.*') ? 'open' : '' }} {{ request()->routeIs('school.products.*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('school.products.*') ? 'active' : '' }}">
            <i class="ti-shopping-cart side-menu__icon"></i>
            <span class="side-menu__label">Product Management</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs('school.products.*') ? 'double-menu-active' : '' }}">
            @can('school.product.approve')
                <li class="slide">
                    <a href="{{ route('school.products.index') }}" class="side-menu__item {{ request()->routeIs('school.products.index') ? 'active' : '' }}">Approve Products</a>
                </li>
            @endcan
            @can('school.product.report')
                <li class="slide">
                    <a href="{{ route('school.products.approved') }}" class="side-menu__item {{ request()->routeIs('school.products.approved') ? 'active' : '' }}">Approved Products</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@can('tieup.approve')
    <li class="slide {{ request()->routeIs('tieups.*') ? 'active' : '' }}">
        <a href="{{ route('tieups.index') }}" class="side-menu__item {{ request()->routeIs('tieups.*') ? 'active' : '' }}">
      
      <i class="ti-briefcase side-menu__icon"></i>
            <span class="side-menu__label">Vendor Tie-ups</span>
        </a>
    </li>
@endcan
