@php
    $breadcrumb = 'Vendor Dashboard';
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-bottom: 8px;
    }

    .kpi-card {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius-lg);
        padding: 18px 20px 16px;
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
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .kpi-label {
        font-size: 11px;
        color: var(--ink-soft);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

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

    .kpi-value {
        font-size: 27px;
        font-weight: 700;
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
        grid-template-columns: 2.15fr 1fr;
        gap: 12px;
        align-items: start;
    }

    .g-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .g-side-col .panel:last-child { margin-bottom: 0; }

    @media (max-width: 1100px) {
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

</style>

<div class="g-root">
    @if (!$vendor)
        <div class="warn-panel">
            <i class="ti ti-alert-triangle"></i>
            <div>
                <h6>Account Configuration Incomplete</h6>
                <p>Your user account is not yet linked to a vendor profile. Please contact the system administrator.</p>
            </div>
        </div>
    @else
        {{-- ══════════════════════════════
             HERO WELCOME
        ══════════════════════════════ --}}
        <div class="hero-panel">
            <div class="hero-welcome">
                <h2>Good morning, {{ $vendor->business_name }} 👋</h2>
                <p>Here's what's happening with your business today.</p>
            </div>
            <div class="hero-actions">
                <button class="btn-pill btn-pill-ghost">
                    <i class="ti ti-download"></i> Download Report
                </button>
                <button class="btn-pill btn-pill-white">
                    <i class="ti ti-plus"></i> Add Product
                </button>
            </div>
        </div>

        {{-- ══════════════════════════════
             KPI ENGINE
        ══════════════════════════════ --}}
        <div class="section-label">Key metrics</div>
        <div class="kpi-row">

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

            <div class="kpi-card" style="--bar-color: var(--green)">
                <div class="kpi-meta">
                    <span class="kpi-label">Total Orders</span>
                    <div class="kpi-icon icon-green"><i class="ti ti-shopping-cart"></i></div>
                </div>
                <div class="kpi-value">{{ $kpis['orders_count'] }}</div>
                <div class="kpi-trend trend-up">
                    <i class="ti ti-trending-up"></i> {{ $kpis['orders_growth'] }}% vs last month
                </div>
            </div>

            <div class="kpi-card" style="--bar-color: var(--amber)">
                <div class="kpi-meta">
                    <span class="kpi-label">Low Stock Items</span>
                    <div class="kpi-icon icon-amber"><i class="ti ti-alert-triangle"></i></div>
                </div>
                <div class="kpi-value">{{ $kpis['low_stock_count'] }}</div>
                <div class="kpi-trend text-mute">Across {{ $kpis['total_products'] }} products</div>
            </div>

            <div class="kpi-card" style="--bar-color: var(--red)">
                <div class="kpi-meta">
                    <span class="kpi-label">Out of Stock</span>
                    <div class="kpi-icon icon-red"><i class="ti ti-circle-x"></i></div>
                </div>
                <div class="kpi-value">{{ $kpis['out_of_stock'] }}</div>
                <div class="kpi-trend trend-down">Critical attention</div>
            </div>
        </div>

        {{-- ══════════════════════════════
             MAIN GRID: charts+tables (left) / insights+tasks (right)
        ══════════════════════════════ --}}
        <div class="section-label">Performance</div>
        <div class="g-main-grid">

            <div class="g-main-col">

                <div class="panel">
                    <div class="panel-header">
                        <h3 class="panel-title"><i class="ti ti-chart-line" style="color:var(--primary)"></i> Revenue &amp; Order Growth</h3>
                        <select class="panel-select">
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                            <option>Yearly</option>
                        </select>
                    </div>
                    <div style="height: 300px; width: 100%;">
                        <div id="revenueChart"></div>
                    </div>
                </div>

                <div class="g-two-col">
                    <div class="panel" style="margin-bottom:0">
                        <div class="panel-header">
                            <h3 class="panel-title"><i class="ti ti-package" style="color:var(--green)"></i> Top Performing Products</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="premium-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                        <th style="text-align:right">Growth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($top_selling_products as $product)
                                        <tr>
                                            <td style="font-weight:600">{{ $product->product_name }}</td>
                                            <td>{{ $product->pivot->quantity ?? rand(100, 500) }} units</td>
                                            <td style="text-align:right;font-weight:700" class="trend-up">+{{ rand(5, 20) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel" style="margin-bottom:0">
                        <div class="panel-header">
                            <h3 class="panel-title"><i class="ti ti-wallet" style="color:var(--primary)"></i> Financial Summary</h3>
                        </div>
                        <div class="payment-summary">
                            <div class="payment-row">
                                <span class="lbl">Total Billed</span>
                                <span class="val">₹{{ number_format($payment_summary['total_billed'], 2) }}</span>
                            </div>
                            <div class="payment-row">
                                <span class="lbl">Platform Fee (10%)</span>
                                <span class="val neg">-₹{{ number_format($payment_summary['platform_fee'], 2) }}</span>
                            </div>
                            <div class="payment-row">
                                <span class="lbl">Tax Deducted (5%)</span>
                                <span class="val neg">-₹{{ number_format($payment_summary['tax_deducted'], 2) }}</span>
                            </div>
                            <div class="payment-row total">
                                <span class="lbl">Estimated Payout</span>
                                <span>₹{{ number_format($payment_summary['final_payout'], 2) }}</span>
                            </div>
                        </div>
                        <button class="btn-pill btn-pill-outline" style="margin-top:14px">Request Settlement</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const revenueData = @json($revenue_trend);
        const orderData = @json($order_trend);

        initDashboardChart('#revenueChart', 'area', [
            revenueData.data,
            orderData.data
        ], revenueData.labels, {
            colors: ['#4338CA', '#158F63'],
            height: 300,
            chart: {
                toolbar: { show: false }
            }
        });
    });
</script>