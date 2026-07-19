  <div class="dashboard-greeting">
        <div class="greeting-content">
            <h1>
                {{ $greeting['icon'] }}
                {{ $greeting['title'] }}, {{ auth()->user()->name }}
            </h1>

            <p>{{ $greeting['message'] }}</p>
        </div>

        <div class="greeting-date">
            <div>{{ now()->format('l') }}</div>
            <span>{{ now()->format('d M Y • h:i A') }}</span>
        </div>
    </div>

    {{-- ══════════════════════════════
         KPI TILES
    ══════════════════════════════ --}}
    <div class="section-label">Key metrics</div>
    <div class="kpi-row">

        <div class="kpi-card" style="--bar-color: var(--green)">
            <div class="kpi-top">
                <span class="kpi-label">Revenue (Today)</span>
                <span class="kpi-icon icon-green"><i class="ti ti-currency-dollar"></i></span>
            </div>
            <div class="kpi-value">₹{{ number_format($kpis['revenue_today'], 2) }}</div>
            <div class="kpi-sub text-mute">Total: ₹{{ number_format($kpis['total_revenue'], 2) }}</div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--primary)">
            <div class="kpi-top">
                <span class="kpi-label">Orders (Today)</span>
                <span class="kpi-icon icon-blue"><i class="ti-shopping-cart"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['orders_today'] }}</div>
            <div class="kpi-sub text-mute">Total: {{ $kpis['total_orders'] }}</div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--teal)">
            <div class="kpi-top">
                <span class="kpi-label">Vendors</span>
                <span class="kpi-icon icon-teal"><i class="ti ti-users"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['total_vendors'] }}</div>
            <div class="kpi-sub text-ok"><i class="ti ti-circle-check" style="font-size:10px"></i>
                {{ $kpis['approved_vendors'] }} approved</div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--primary)">
            <div class="kpi-top">
                <span class="kpi-label">Schools</span>
                <span class="kpi-icon icon-blue"><i class="ti ti-school"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['total_schools'] }}</div>
            <div class="kpi-sub text-ok"><i class="ti ti-circle-check" style="font-size:10px"></i>
                {{ $kpis['active_schools'] }} active</div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--violet)">
            <div class="kpi-top">
                <span class="kpi-label">Products</span>
                <span class="kpi-icon icon-violet"><i class="ti-package"></i></span>
            </div>
            <div class="kpi-value">{{ number_format($kpis['total_products']) }}</div>
            <div class="kpi-sub text-ok"><i class="ti ti-circle-check" style="font-size:10px"></i>
                {{ number_format($kpis['approved_products']) }} live</div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--ink-faint)">
            <div class="kpi-top">
                <span class="kpi-label">Customers</span>
                <span class="kpi-icon icon-gray"><i class="ti-user"></i></span>
            </div>
            <div class="kpi-value">{{ number_format($kpis['total_customers']) }}</div>
            <div class="kpi-sub text-mute">Combined users</div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--amber)">
            <div class="kpi-top">
                <span class="kpi-label">Pending</span>
                <span class="kpi-icon icon-amber"><i class="ti ti-clock"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['pending_products'] }}</div>
            <div class="kpi-sub text-warn"><i class="ti ti-alert-triangle" style="font-size:10px"></i> Needs review
            </div>
        </div>

        <div class="kpi-card" style="--bar-color: var(--red)">
            <div class="kpi-top">
                <span class="kpi-label">Returns</span>
                <span class="kpi-icon icon-red"><i class="ti ti-replace"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['total_returns'] }}</div>
            <div class="kpi-sub text-err">Pending returns</div>
        </div>

    </div>
