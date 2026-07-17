@php
    $breadcrumb = 'Dashboard';
    $title = 'Vendor Business Overview';
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('assets/js/dashboard-charts.js') }}"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap');

    .g-root, .g-root * {
        box-sizing: border-box;
    }

    .g-root {
        --bg: #f4f5fb;
        --surface: #ffffff;
        --surface-soft: #fafaff;
        --ink: #1a1a2e;
        --ink-soft: #6b6b85;
        --ink-faint: #9a9ab0;
        --line: #eaeaf3;

        --primary: #4338ca;
        --primary-ink: #372e8a;
        --primary-soft: #edecfd;

        --amber: #dc8a00;
        --amber-soft: #fdf1dd;
        --green: #158f63;
        --green-soft: #e4f6ee;
        --red: #d64545;
        --red-soft: #fce9e9;
        --teal: #0e829b;
        --teal-soft: #e3f4f8;
        --violet: #6f4ff2;
        --violet-soft: #efeafe;
        --blue-soft: #e7f3ff;
        --gray-soft: #f1f1f7;

        --radius-lg: 18px;
        --radius-md: 12px;
        --radius-sm: 8px;
        --shadow-card: 0 1px 2px rgba(26,26,46,.04), 0 10px 24px -18px rgba(26,26,46,.18);

        color: var(--ink);
        background: var(--bg);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        padding: 20px;
        border-radius: 20px;
        min-height: 100vh;
    }

    .g-root .ti {
        font-size: 1.2em;
        line-height: 1;
    }

    .g-root h1, .g-root h2, .g-root h3,
    .g-root .kpi-value, .g-root .stat-big, .g-root .panel-title {
        font-family: 'Sora', 'Inter', sans-serif;
    }

    .g-root .mono { font-family: 'JetBrains Mono', monospace; }

    /* ── Eyebrow / section labels ── */
    .section-label {
        position: relative;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: var(--ink-soft);
        margin: 28px 0 12px;
        padding-left: 14px;
    }

    .section-label:first-child { margin-top: 0; }

    .section-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 2px;
        width: 4px;
        height: 12px;
        border-radius: 2px;
        background: linear-gradient(180deg, var(--primary), var(--violet));
    }

    /* ── Hero welcome ── */
    .hero-panel {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        background: linear-gradient(120deg, var(--primary) 0%, #6f4ff2 100%);
        border-radius: var(--radius-lg);
        padding: 26px 28px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 16px 32px -18px rgba(67,56,202,.55);
    }

    .hero-panel::after {
        content: '';
        position: absolute;
        right: -60px;
        top: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .hero-panel::before {
        content: '';
        position: absolute;
        right: 60px;
        bottom: -80px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }

    .hero-welcome { position: relative; z-index: 1; }

    .hero-welcome h2 {
        font-weight: 700;
        margin-bottom: 6px;
        color: #fff;
        font-size: 24px;
    }

    .hero-welcome p {
        color: rgba(255,255,255,.82);
        margin: 0;
        font-size: 13.5px;
    }

    .hero-actions {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-pill {
        font-size: 12.5px;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: transform .15s ease, opacity .15s ease;
    }

    .btn-pill:hover { transform: translateY(-1px); }

    .btn-pill-white {
        background: #fff;
        color: var(--primary-ink);
    }

    .btn-pill-ghost {
        background: rgba(255,255,255,.14);
        color: #fff;
        border: 1px solid rgba(255,255,255,.35);
    }

    .btn-pill-outline {
        background: transparent;
        color: var(--primary);
        border: 1.5px solid var(--primary-soft);
        width: 100%;
        justify-content: center;
    }

    .btn-pill-outline:hover { background: var(--primary-soft); }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .page-header h1 { font-size: 28px; font-weight: 800; }

    /* ── Setup warning ── */
    .warn-panel {
        display: flex;
        align-items: center;
        gap: 16px;
        background: var(--amber-soft);
        border: 1px solid rgba(220,138,0,.25);
        border-radius: var(--radius-lg);
        padding: 20px 22px;
        color: var(--ink);
    }

    .warn-panel i { font-size: 26px; color: var(--amber); flex-shrink: 0; }
    .warn-panel h6 { font-weight: 700; margin-bottom: 3px; font-family: 'Sora', sans-serif; }
    .warn-panel p { margin: 0; font-size: 12.5px; color: var(--ink-soft); }

    /* ── KPI Grid ── */
    .kpi-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px;
        margin-bottom: 8px;
    }

    .kpi-card {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 16px 18px 14px;
        box-shadow: var(--shadow-card);
        transition: transform .18s ease, box-shadow .18s ease;
        overflow: hidden;
    }

    .kpi-card::after {
        content: '';
        position: absolute;
        left: 0; right: 0; bottom: 0;
        height: 3px;
        background: var(--bar-color, var(--primary));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .25s ease;
    }

    .kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 30px -18px rgba(26,26,46,.28);
    }

    .kpi-card:hover::after { transform: scaleX(1); }

    .kpi-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
    }

    .kpi-label {
        font-size: 11px;
        color: var(--ink-soft);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .kpi-meta .kpi-icon { margin-left: auto; }
    .kpi-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .icon-blue { background: var(--primary-soft); color: var(--primary); }
    .icon-green { background: var(--green-soft); color: var(--green); }
    .icon-amber { background: var(--amber-soft); color: var(--amber); }
    .icon-red { background: var(--red-soft); color: var(--red); }
    .icon-violet { background: var(--violet-soft); color: var(--violet); }

    .kpi-value {
        font-size: 26px;
        font-weight: 800;
        color: var(--ink);
        line-height: 1;
        letter-spacing: -.2px;
        margin-bottom: 9px;
    }

    .kpi-trend {
        font-size: 11.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .trend-up { color: var(--green); }
    .trend-down { color: var(--red); }
    .text-mute { color: var(--ink-faint); font-weight: 500 !important; }

    /* ── Layout grids ── */
    .g-main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 12px;
        align-items: start;
    }

    .g-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .g-side-col .panel:last-child { margin-bottom: 0; }

    @media (max-width: 1200px) {
        .g-main-grid, .g-two-col { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
        .g-root { padding: 12px; }
    }

    /* ── Panels ── */
    .panel {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 20px 22px 22px;
        margin-bottom: 12px;
        box-shadow: var(--shadow-card);
    }

    .panel-title {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
    }

    /* ── Quick Actions ── */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .action-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 20px;
        border-radius: var(--radius-md);
        background: var(--surface-soft);
        border: 1px solid var(--line);
        text-decoration: none;
        color: var(--ink);
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        transition: all .2s ease;
    }
    .action-card:hover {
        transform: translateY(-2px);
        background: var(--surface);
        border-color: var(--primary-soft);
        box-shadow: var(--shadow-card);
        color: var(--primary);
    }
    .action-card i {
        font-size: 22px;
        color: var(--primary);
    }

    /* ── Tabbed Panel ── */
    .tab-nav {
        display: flex;
        border-bottom: 1px solid var(--line);
        margin-bottom: 18px;
    }
    .tab-nav-item {
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        color: var(--ink-soft);
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        cursor: pointer;
    }
    .tab-nav-item.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
    }
    .tab-content { display: none; }
    .tab-content.active { display: block; }

    /* ── Skeleton Loaders ── */
    .skeleton {
        background-color: #e2e8f0;
        border-radius: 4px;
        animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        50% { opacity: .5; }
    }
    .skeleton-text { height: 1em; }
    .skeleton-h-20 { height: 20px; }
    .skeleton-h-40 { height: 40px; }
    .skeleton-w-100 { width: 100%; }
    .skeleton-w-60 { width: 60%; }

    .kpi-card .kpi-value.skeleton {
        height: 27px;
        width: 70%;
        margin-bottom: 9px;
    }
    .kpi-card .kpi-trend.skeleton {
        height: 12px;
        width: 90%;
    }

    /* Hide content until loaded */
    .g-root[data-loading="true"] .data-content {
        display: none;
    }
    .g-root[data-loading="false"] .skeleton-container {
        display: none;
    }

    /* ── Table styles ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th, .data-table td {
        padding: 12px 10px;
        text-align: left;
        font-size: 12.5px;
        border-bottom: 1px solid var(--line);
    }
    .data-table th { font-weight: 600; color: var(--ink-soft); }
    .data-table td { color: var(--ink); }
    .data-table tr:last-child td { border-bottom: none; }

</style>
    
<div class="g-root" data-loading="true">
    @if (!$vendor)
        <div class="warn-panel">
            <i class="ti ti-alert-triangle"></i>
            <div>
                <h6>Account Configuration Incomplete</h6>
                <p>Your user account is not yet linked to a vendor profile. Please contact the system administrator.</p>
            </div>
        </div>
    @else
        <div class="page-header">
            <h1>Good morning, {{ $vendor->business_name }} 👋</h1>
            <div class="page-filters">
                {{-- Filter component will go here --}}
            </div>
        </div>

        {{-- ROW 1: QUICK ACTIONS & KEY KPIS --}}
        <div class="g-main-grid">
            <div class="panel">
                <div class="panel-header" style="border:0; padding-bottom:0; margin-bottom:12px;">
                    <h3 class="panel-title">Quick Actions</h3>
                </div>
                <div class="quick-actions-grid">
                    <a href="{{ route('product.index') }}" class="action-card"><i class="ti-plus"></i> Add Product</a>
                    <a href="{{ route('stock-management.index') }}" class="action-card"><i class="ti-package"></i> Manage Inventory</a>
                    <a href="{{ route('vendor.orders.dispatch') }}" class="action-card"><i class="ti ti-truck-delivery"></i> Dispatch Orders</a>
                    <a href="#" class="action-card"><i class="ti ti-file-download"></i> Download Reports</a>
                </div>

                
            </div>
            

            <div class="panel">
                <div class="panel-header" style="border:0; padding-bottom:0; margin-bottom:12px;">
                    <h3 class="panel-title">Today's Snapshot</h3>
                </div>
                <div class="kpi-row">
                    <div class="kpi-card">
                        <div class="kpi-meta"><span class="kpi-label">Today's Revenue</span></div>
                        <div class="kpi-value skeleton-container"><div class="skeleton skeleton-h-20 skeleton-w-60"></div></div>
                        <div class="kpi-value data-content" id="kpi-todays-revenue"></div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-meta"><span class="kpi-label">Today's Orders</span></div>
                        <div class="kpi-value skeleton-container"><div class="skeleton skeleton-h-20 skeleton-w-60"></div></div>
                        <div class="kpi-value data-content" id="kpi-todays-orders"></div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-meta"><span class="kpi-label">Pending Orders</span></div>
                        <div class="kpi-value skeleton-container"><div class="skeleton skeleton-h-20 skeleton-w-60"></div></div>
                        <div class="kpi-value data-content" id="kpi-pending-orders"></div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-meta"><span class="kpi-label">Ready to Dispatch</span></div>
                        <div class="kpi-value skeleton-container"><div class="skeleton skeleton-h-20 skeleton-w-60"></div></div>
                        <div class="kpi-value data-content" id="kpi-ready-to-dispatch"></div>
                    </div>
                </div>
            </div>

            
        </div>

        {{-- ROW 2: CORE ANALYTICS --}}
        <div class="section-label">Business Performance</div>
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title"><i class="ti ti-chart-line" style="color:var(--primary)"></i> Revenue &amp; Sales Trend</h3>
                <select class="panel-select">
                    <option>Last 30 Days</option>
                    <option>Last 90 Days</option>
                    <option>This Year</option>
                </select>
            </div>
            <div style="height: 300px; width: 100%;">
                <div class="skeleton-container"><div class="skeleton skeleton-w-100" style="height:300px;"></div></div>
                <div id="revenueChart" class="data-content"></div>
            </div>
        </div>

        {{-- ROW 3: SECONDARY KPIS & CHARTS --}}
        <div class="g-main-grid">
            <div class="panel">
                <div class="panel-header">
                    <h3 class="panel-title"><i class="ti ti-pie-chart" style="color:var(--violet)"></i> Order Status Distribution</h3>
                </div>
                <div style="height: 260px;">
                    <div class="skeleton-container"><div class="skeleton skeleton-w-100" style="height:260px; border-radius: 50%;"></div></div>
                    <div id="orderStatusChart" class="data-content"></div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-header">
                    <h3 class="panel-title"><i class="ti ti-building-warehouse" style="color:var(--amber)"></i> Inventory Health</h3>
                </div>
                <div style="height: 260px;">
                    <div class="skeleton-container"><div class="skeleton skeleton-w-100" style="height:260px;"></div></div>
                    <div id="inventoryHealthChart" class="data-content"></div>
                </div>
            </div>
        </div>

        {{-- ROW 4: TABBED DATA GRIDS --}}
        <div class="section-label">Operations</div>
        <div class="panel">
            {{-- <div class="tab-nav">
                <div class="tab-nav-item active" data-tab="recent-orders">Recent Orders</div>
                <div class="tab-nav-item" data-tab="top-products">Top Products</div>
                <div class="tab-nav-item" data-tab="low-stock">Low Stock Alerts</div>
            </div> --}}

            <div class="skeleton-container">
                <div class="skeleton skeleton-h-20 skeleton-w-100 mb-2"></div>
                <div class="skeleton skeleton-h-20 skeleton-w-100 mb-2"></div>
                <div class="skeleton skeleton-h-20 skeleton-w-100"></div>
            </div>

           <!-- <div class="data-content">
                <div id="tab-recent-orders" class="tab-content active">
                    <table class="data-table">
                        <thead>
                            <tr><th>Order ID</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr>
                        </thead>
                        <tbody id="recent-orders-body">
                            {{-- Data will be injected by JS --}}
                        </tbody>
                    </table>
                </div>
                <div id="tab-top-products" class="tab-content">
                     <table class="data-table">
                        <thead>
                            <tr><th>Product</th><th>Category</th><th>Units Sold</th><th>Revenue</th></tr>
                        </thead>
                        <tbody id="top-products-body">
                            {{-- Data will be injected by JS --}}
                        </tbody>
                    </table>
                </div>
                <div id="tab-low-stock" class="tab-content">
                    <table class="data-table">
                        <thead>
                            <tr><th>Product</th><th>SKU</th><th>Stock</th><th>Status</th></tr>
                        </thead>
                        <tbody id="low-stock-body">
                            {{-- Data will be injected by JS --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>-->

        {{-- ROW 5: TERTIARY ANALYTICS --}}
        <div class="g-two-col">
            <div class="panel">
                <div class="panel-header">
                    <h3 class="panel-title"><i class="ti ti-school" style="color:var(--green)"></i> Revenue by School</h3>
                </div>
                <div style="height: 280px;">
                    <div class="skeleton-container"><div class="skeleton skeleton-w-100" style="height:280px;"></div></div>
                    <div id="revenueBySchoolChart" class="data-content"></div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-header">
                    <h3 class="panel-title"><i class="ti ti-category-2" style="color:var(--primary)"></i> Revenue by Category</h3>
                </div>
                <div style="height: 280px;">
                    <div class="skeleton-container"><div class="skeleton skeleton-w-100" style="height:280px;"></div></div>
                    <div id="revenueByCategoryChart" class="data-content"></div>
                </div>
            </div>
        </div>

        {{-- Old code for reference, can be removed --}}
        <div style="display:none">
            <div class="kpi-card" style="--bar-color: var(--primary)">
                <div class="kpi-meta">
                    <span class="kpi-label">Total Revenue</span>
                    <div class="kpi-icon icon-blue"><i class="ti ti-currency-dollar"></i></div>
                </div>
                <div class="kpi-value">₹{{ number_format($kpis['revenue'], 2) }}</div>
                <div class="kpi-trend trend-up">
                    <i class="ti ti-trending-up"></i> {{ $kpis['revenue_growth'] }}% vs last month
                </div>
            </div>
            <div class="panel" style="margin-bottom:0">
                <div class="panel-header">
                    <h3 class="panel-title"><i class="ti ti-alert-circle" style="color:var(--red)"></i> Critical Inventory Alerts</h3>
                </div>
                <div class="table-responsive">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Variant</th>
                                <th style="text-align:center">Current Stock</th>
                                <th style="text-align:right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventory_alerts as $alert)
                                <tr>
                                    <td style="font-weight:600">{{ $alert->product->product_name }}</td>
                                    <td class="text-mute">{{ $alert->product->variants->first()->product_code ?? 'N/A' }}</td>
                                    <td style="text-align:center;font-weight:700">{{ $alert->stock_qty }}</td>
                                    <td style="text-align:right">
                                        <span class="priority-pill {{ $alert->stock_qty == 0 ? 'p-high' : 'p-medium' }}">
                                            {{ $alert->stock_qty == 0 ? 'Out of Stock' : 'Low Stock' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center;padding:28px 0;color:var(--ink-faint)">No critical alerts. Your inventory is healthy!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="g-side-col">
                <div class="panel">
                    <div class="panel-header">
                        <h3 class="panel-title"><i class="ti ti-lightbulb" style="color:var(--amber)"></i> AI Business Insights</h3>
                    </div>
                    @foreach($ai_insights as $insight)
                        <div class="insight-card insight-{{ $insight['type'] }}">
                            <div class="insight-icon">
                                <i class="ti {{ $insight['icon'] }}"></i>
                            </div>
                            <div>
                                <div class="insight-text">{{ $insight['text'] }}</div>
                                <a href="#" class="insight-action">
                                    {{ $insight['action'] }} <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="panel">
                    <div class="panel-header">
                        <h3 class="panel-title"><i class="ti ti-list-check" style="color:var(--primary)"></i> Upcoming Tasks</h3>
                    </div>
                    <div class="task-list">
                        @foreach($upcoming_tasks as $task)
                            <div class="task-item">
                                <div class="task-checkbox {{ $task['done'] ? 'checked' : '' }}"></div>
                                <div style="flex:1">
                                    <div class="task-name {{ $task['done'] ? 'done' : '' }}">
                                        {{ $task['task'] }}
                                    </div>
                                    <span class="priority-pill p-{{ $task['priority'] }}">
                                        {{ $task['priority'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="text-align:center;margin-top:14px">
                        <a href="#" style="color:var(--primary);font-weight:700;font-size:12px;text-decoration:none">View All Tasks <i class="ti ti-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="card custom-card">
        <div class="table-responsive">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Variant</th>
                                <th style="text-align:center">Current Stock</th>
                                <th style="text-align:right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventory_alerts as $alert)
  
                                <tr>
                                    <td style="font-weight:600">{{ $alert->product->product_name }}</td>
                                    <td class="text-mute">{{ $alert->product->variants->first()->sku ?? 'N/A' }}</td>
                                    <td style="text-align:center;font-weight:700">{{ $alert->stock_qty }}</td>
                                    <td style="text-align:right">
                                        <span class="priority-pill {{ $alert->stock_qty == 0 ? 'p-high' : 'p-medium' }}">
                                            {{ $alert->stock_qty == 0 ? 'Out of Stock' : 'Low Stock' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center;padding:28px 0;color:var(--ink-faint)">No critical alerts. Your inventory is healthy!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rootEl = document.querySelector('.g-root');
        
        async function fetchDashboardData() {
            try {
                // The URL to your new API endpoint
                const response = await fetch('/api/vendor/dashboard-data');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                populateDashboard(data);

            } catch (error) {
                console.error("Failed to fetch dashboard data:", error);
                // Optionally, show an error message to the user in the UI
            } finally {
                rootEl.dataset.loading = 'false';
            }
        }

        fetchDashboardData();
        
        function populateDashboard(data) {
            // KPIs
            document.getElementById('kpi-todays-revenue').textContent = `₹${data.kpis.todays_revenue.toLocaleString()}`;
            document.getElementById('kpi-todays-orders').textContent = data.kpis.todays_orders;
            document.getElementById('kpi-pending-orders').textContent = data.kpis.pending_orders;
            document.getElementById('kpi-ready-to-dispatch').textContent = data.kpis.ready_to_dispatch;

            // Charts
            initDashboardChart('#revenueChart', 'area', data.charts.revenue_trend.series, data.charts.revenue_trend.labels, {
                colors: ['#4338CA', '#158F63'], height: 300, chart: { toolbar: { show: false } }
            });

            initDashboardChart('#orderStatusChart', 'donut', data.charts.order_status.series, data.charts.order_status.labels, {
                colors: ['#F7B84B', '#4338CA', '#0E829B', '#158F63', '#D64545'], height: 300, legend: { position: 'bottom' }
            });

            initDashboardChart('#inventoryHealthChart', 'bar', data.charts.inventory_health.series, data.charts.inventory_health.labels, {
                colors: ['#158F63', '#F7B84B', '#D64545'], height: 260, chart: { stacked: true, toolbar: { show: false } },
                plotOptions: { bar: { horizontal: true } }, xaxis: { labels: { show: false } }
            });

            initDashboardChart('#revenueBySchoolChart', 'bar', data.charts.revenue_by_school.series, data.charts.revenue_by_school.labels, {
                colors: ['#158F63'], height: 280, plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
                xaxis: { labels: { show: false } }
            });

            initDashboardChart('#revenueByCategoryChart', 'bar', data.charts.revenue_by_category.series, data.charts.revenue_by_category.labels, {
                colors: ['#4338CA'], height: 280, plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
                xaxis: { labels: { show: false } }
            });

            // Tables
            const recentOrdersBody = document.getElementById('recent-orders-body');
            recentOrdersBody.innerHTML = data.tables.recent_orders.map(order => `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.customer}</td>
                    <td>${order.amount}</td>
                    <td>${order.status}</td>
                    <td>${order.date}</td>
                </tr>
            `).join('');
        }

        // Tab functionality
        const tabNavItems = document.querySelectorAll('.tab-nav-item');
        const tabContents = document.querySelectorAll('.tab-content');
        tabNavItems.forEach(item => {
            item.addEventListener('click', () => {
                tabNavItems.forEach(i => i.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                item.classList.add('active');
                document.getElementById(`tab-${item.dataset.tab}`).classList.add('active');
            });
        });

        // Old chart initializations (for reference, can be removed)
        /*
        const paymentSummary = @json($payment_summary);
        const topProducts = @json($top_selling_products);
        initDashboardChart('#financialSummaryChart', 'donut', ...);
        initDashboardChart('#topProductsChart', 'bar', ...);
        */
    });
</script>