<div class="row g-4">

<div class="col-xl-9">

    <div class="row g-3">

        {{-- Revenue --}}
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-header-info">
                    <div class="card-icon success">
                        <i class="ti ti-currency-rupee"></i>
                    </div>

                    <span>Total Revenue</span>
                </div>

                <h2 id="kpi-todays-revenue">₹ {{  $order_stats['total_revenue'] }}</h2>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-header-info">
                    <div class="card-icon success">
                        <i class="ti ti-currency-rupee"></i>
                    </div>

                    <span>Revenue Today</span>
                </div>

                <h2 id="kpi-todays-revenue">₹ {{  $order_stats['revenue_today'] }}</h2>
            </div>
        </div>

        {{-- Orders --}}
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-header-info">
                    <div class="card-icon primary">
                        <i class="ti-shopping-cart"></i>
                    </div>

                    <span>Orders Today</span>
                </div>

                <h2 id="kpi-todays-orders">{{  $order_stats['orders_today'] }}</h2>
            </div>
        </div>

        {{-- Pending --}}
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-header-info">
                    <div class="card-icon warning">
                        <i class="ti ti-clock"></i>
                    </div>

                    <span>Pending Orders</span>
                </div>

                <h2 id="kpi-pending-orders">{{ $order_stats['pending_orders'] }}</h2>
            </div>
        </div>

        {{-- Dispatch --}}
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-header-info">
                    <div class="card-icon info">
                        <i class="ti ti-truck-delivery"></i>
                    </div>

                    <span>Ready to Dispatch</span>
                </div>

                <h2 id="kpi-ready-to-dispatch">{{ $order_stats['dispatch_orders'] }}</h2>
            </div>
        </div>

        {{-- Products --}}
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-header-info">
                    <div class="card-icon purple">
                        <i class="ti-package"></i>
                    </div>

                    <span>Active Products</span>
                </div>

                <h2 id="kpi-active-products">{{ $order_stats['total_products'] }}</h2>
            </div>
        </div>

      
    </div>

</div>
    {{-- RIGHT SIDE --}}
    <div class="col-xl-3">

        <div class="panel h-100">

            <div class="panel-header">
                <h3 class="panel-title">
                    Quick Actions
                </h3>
            </div>

            <div class="quick-action-list">

                <a href="{{ route('product.index') }}">
                    <i class="ti-plus"></i>

                    Add Product
                </a>

                <a href="{{ route('stock-management.index') }}">
                    <i class="ti-package"></i>

                    Inventory
                </a>

                <a href="{{ route('vendor.orders.dispatch') }}">
                    <i class="ti ti-truck-delivery"></i>

                    Dispatch Orders
                </a>

            
            </div>

        </div>

    </div>

</div>