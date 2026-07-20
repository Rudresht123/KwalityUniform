{{-- Vendor Navigation --}}
<li class="slide__category"><span class="category-name">Vendor Dashboard</span></li>
<li class="slide {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
    <a href="{{ route("dashboard") }}" class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}"> 
        <span class="shape1"></span> <span class="shape2"></span> 
        <i class="ti-home side-menu__icon"></i> 
        <span class="side-menu__label">Dashboard</span> 
    </a> 
</li>

<li class="slide__category"><span class="category-name">Product Management</span></li>

@canany(['product.view', 'product.create'])
    <li class="slide has-sub {{ request()->routeIs('product.*') ? 'open' : '' }} {{ request()->routeIs('product.*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('product.*') ? 'active' : '' }}">
            <i class="ti-shopping-cart side-menu__icon"></i>
            <span class="side-menu__label">Product Management</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs('product.*') ? 'double-menu-active' : '' }}">
            @can('product.create')
                <li class="slide">
                    <a href="{{ route('product.create') }}" class="side-menu__item {{ request()->routeIs('product.create') ? 'active' : '' }}">Add Product</a>
                </li>
            @endcan
            @can('product.view')
                <li class="slide">
                    <a href="{{ route('product.index') }}" class="side-menu__item {{ request()->routeIs('product.index') ? 'active' : '' }}">Manage Products</a>
                </li>
            @endcan
            @can('product_assignment.view')
                <li class="slide">
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('product-assignment.*') ? 'active' : '' }}">Product Assignments</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany

@can('vendor.fulfillment.hub.view')
    <li class="slide {{ request()->routeIs('vendor.fulfillment.hub') ? 'active' : '' }}">
        <a href="{{ route('vendor.fulfillment.hub') }}" class="side-menu__item {{ request()->routeIs('vendor.fulfillment.hub') ? 'active' : '' }}">
            <i class="ti ti-box side-menu__icon"></i>
            <span class="side-menu__label">Fulfillment Hub</span>
        </a>
    </li>
@endcan
@can('vendor.fulfillment.view')
    <li class="slide {{ request()->routeIs('vendor.orders.dispatch') ? 'active' : '' }}">
        <a href="{{ route('vendor.orders.dispatch') }}" class="side-menu__item {{ request()->routeIs('vendor.orders.dispatch') ? 'active' : '' }}">
            <i class="ti-truck side-menu__icon"></i>
            <span class="side-menu__label">Dispatch Hub</span>
        </a>
    </li>
@endcan

@canany(['category.view', 'category.create', 'size.view', 'color.view'])
    <li class="slide has-sub {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'open' : '' }} {{ request()->routeIs(['vendor.category.*', 'vendor.parent-category.*', 'vendor.size.*', 'vendor.color.*']) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['vendor.category.*', 'vendor.parent-category.*', 'vendor.size.*', 'vendor.color.*']) ? 'active' : '' }}">
            <i class="ti-package side-menu__icon"></i>
            <span class="side-menu__label">Product Attributes</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs(['category.*', 'parent-category.*', 'size.*', 'color.*']) ? 'double-menu-active' : '' }}">
            @canany(['category.view', 'category.create'])
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
            @endcan
        </ul>
    </li>
@endcanany

@can('stock_view')
    <li class="slide has-sub {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'open' : '' }} {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'active' : '' }}">
            <i class="ti-dropbox side-menu__icon"></i>
            <span class="side-menu__label">Inventory Management</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1 {{ request()->routeIs(['stock.*', 'stock-management.*', 'stock-adjustment.*', 'school-product-approval.*']) ? 'double-menu-active' : '' }}">
            <li class="slide">
                <a href="{{ route('vendor.stock.index') }}" class="side-menu__item {{ request()->routeIs('vendor.stock.index') ? 'active' : '' }}">Stock Management</a>
            </li>
            <li class="slide">
                <a href="{{ route('stock.index') }}" class="side-menu__item {{ request()->routeIs('stock.index') ? 'active' : '' }}">Low Stock Alert</a>
            </li>
            <li class="slide">
                <a href="{{ route('vendor.stock.history.report') }}" class="side-menu__item {{ request()->routeIs('vendor.stock.history.report') ? 'active' : '' }}">Stock History</a>
            </li>
            <li class="slide">
                <a href="{{ route('vendor.recent-orders.index') }}" class="side-menu__item {{ request()->routeIs('vendor.recent-orders.index') ? 'active' : '' }}">Recent Orders</a>
            </li>
        </ul>
    </li>
@endcan
