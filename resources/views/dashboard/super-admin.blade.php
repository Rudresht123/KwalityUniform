@php
    $breadcrumb = 'Dashboard';
    $title = 'Project Dashboard';
@endphp
@php
    $boardColors = [
        'cbse' => 'var(--c-blue)',
        'icse' => 'var(--c-green)',
        'state' => 'var(--c-amber)',
        'up' => 'var(--c-violet)',

        // Future defaults
        'ib' => '#8b5cf6',
        'cambridge' => '#06b6d4',
        'nios' => '#ec4899',
    ];

    $defaultColors = [
        '#3b82f6',
        '#22c55e',
        '#f59e0b',
        '#8b5cf6',
        '#06b6d4',
        '#ef4444',
        '#14b8a6',
        '#e11d48',
        '#0ea5e9',
        '#84cc16',
    ];
@endphp
<style>
    * {
        box-sizing: border-box;
    }

    .g-root {
        color: var(--text-primary, #1e293b);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .section-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #6c757d;
        margin: 1.5rem 0 .75rem;
    }

    /* ── KPI Grid ── */
    .kpi-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .kpi-card {
        background: #fff;
        border: 1px solid #edf2f9;
        border-radius: 12px;
        padding: 14px 16px;
        transition: border-color .2s, transform .2s;
    }

    .kpi-card:hover {
        border-color: #6259ca;
        transform: translateY(-2px);
    }

    .kpi-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .kpi-label {
        font-size: 11px;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .kpi-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .kpi-value {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
    }

    .kpi-sub {
        font-size: 11px;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .icon-blue {
        background: rgba(42, 120, 214, .1);
        color: #2a78d6;
    }

    .icon-teal {
        background: rgba(27, 175, 122, .1);
        color: #1baf7a;
    }

    .icon-amber {
        background: rgba(237, 161, 0, .1);
        color: #eda100;
    }

    .icon-red {
        background: rgba(227, 73, 72, .1);
        color: #e34948;
    }

    .icon-violet {
        background: rgba(74, 58, 167, .1);
        color: #4a3aa7;
    }

    .icon-gray {
        background: #f1f5f9;
        color: #6c757d;
    }

    .text-ok {
        color: #1baf7a;
    }

    .text-warn {
        color: #eda100;
    }

    .text-err {
        color: #e34948;
    }

    .text-mute {
        color: #6c757d;
    }

    /* ── Panels ── */
    .panel {
        background: #fff;
        border: 1px solid #edf2f9;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 12px;
    }

    .panel-title {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }

    .panel-title i {
        font-size: 16px;
    }

    .panel-title .title-right {
        margin-left: auto;
        font-size: 11px;
        font-weight: 400;
        color: #6c757d;
    }

    /* ── Grid layouts ── */
    .charts-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .charts-3col {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 12px;
    }

    @media (max-width: 992px) {
        .charts-2col {
            grid-template-columns: 1fr;
        }

        .charts-3col {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .charts-3col {
            grid-template-columns: 1fr;
        }
    }

    /* ── Chart canvas wrappers ── */
    .ch {
        position: relative;
        width: 100%;
    }

    /* ── Legend ── */
    .legend-row {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 10px;
    }

    .leg {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #6c757d;
    }

    .leg-sq {
        width: 9px;
        height: 9px;
        border-radius: 2px;
        flex-shrink: 0;
    }

    /* ── Stock health ── */
    .stat-big {
        font-size: 36px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 2px;
    }

    .stat-sub {
        font-size: 11px;
        color: #6c757d;
    }

    .divider {
        width: 100%;
        height: 1px;
        background: #f1f5f9;
        margin: 12px 0;
    }

    .progress-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .prog-header {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .prog-header span:last-child {
        font-weight: 600;
        color: #1e293b;
    }

    .prog-bar {
        height: 6px;
        background: #f1f5f9;
        border-radius: 3px;
        overflow: hidden;
    }

    .prog-fill {
        height: 100%;
        border-radius: 3px;
    }

    /* ── Donut ring ── */
    .ring-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ring-legend {
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 1;
    }

    .ring-leg-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
    }

    .ring-leg-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-right: 6px;
    }

    .ring-leg-label {
        display: flex;
        align-items: center;
        color: #6c757d;
        flex: 1;
    }

    .ring-leg-val {
        font-weight: 600;
        color: #1e293b;
    }

    /* ── Board stacked bar label ── */
    .board-labels {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 8px;
    }
</style>

<div class="g-root">

    {{-- ══════════════════════════════
         KPI TILES
    ══════════════════════════════ --}}
    <div class="section-label">Key metrics</div>
    <div class="kpi-row">

        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Schools</span>
                <span class="kpi-icon icon-blue"><i class="ti ti-school"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['total_schools'] }}</div>
            <div class="kpi-sub text-ok"><i class="ti ti-circle-check" style="font-size:10px"></i>
                {{ $kpis['active_schools'] }} active</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Vendors</span>
                <span class="kpi-icon icon-teal"><i class="ti ti-users"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['total_vendors'] }}</div>
            <div class="kpi-sub text-ok"><i class="ti ti-circle-check" style="font-size:10px"></i>
                {{ $kpis['approved_vendors'] }} approved</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Products</span>
                <span class="kpi-icon icon-violet"><i class="ti-package"></i></span>
            </div>
            <div class="kpi-value">{{ number_format($kpis['total_products']) }}</div>
            <div class="kpi-sub text-ok"><i class="ti ti-circle-check" style="font-size:10px"></i>
                {{ number_format($kpis['approved_products']) }} live</div>
        </div>

        {{-- <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Pending</span>
                <span class="kpi-icon icon-amber"><i class="ti ti-clock"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['pending_products'] }}</div>
            <div class="kpi-sub text-warn"><i class="ti ti-alert-triangle" style="font-size:10px"></i> Needs review
            </div>
        </div> --}}

        {{-- <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Low stock</span>
                <span class="kpi-icon icon-red"><i class="ti ti-alert-triangle"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['low_stock_count'] }}</div>
            <div class="kpi-sub text-err">{{ $kpis['out_of_stock'] }} out of stock</div>
        </div> --}}

        {{-- <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Total SKUs</span>
                <span class="kpi-icon icon-gray"><i class="ti ti-barcode"></i></span>
            </div>
            <div class="kpi-value">{{ number_format($kpis['total_variants']) }}</div>
            <div class="kpi-sub text-mute">All variants</div>
        </div> --}}

        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Users</span>
                <span class="kpi-icon icon-gray"><i class="ti ti-users"></i></span>
            </div>
            <div class="kpi-value">{{ number_format($kpis['total_users']) }}</div>
            <div class="kpi-sub text-mute">All roles</div>
        </div>

        {{-- <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Standards</span>
                <span class="kpi-icon icon-gray"><i class="ti ti-book"></i></span>
            </div>
            <div class="kpi-value">{{ $kpis['total_standards'] }}</div>
            <div class="kpi-sub text-mute">Curriculum</div>
        </div> --}}

    </div>

    {{-- ══════════════════════════════
         REGISTRATION TREND — full width
    ══════════════════════════════ --}}
    <div class="section-label">Registration trends</div>
    <div class="panel">
        <div class="panel-title">
            <i class="ti ti-chart-line" style="color:#2a78d6"></i>
            Schools, vendors and Web Users — last 12 months
            <span class="title-right">{{ now()->subYear()->format('M Y') }} – {{ now()->format('M Y') }}</span>
        </div>

        <div class="ch">
            <div class="ch">
                <div id="registrationTrend" class="apex-chart"></div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════
         ROW: Donut | Vendor Bar | Stock Health
    ══════════════════════════════ --}}
    <div class="charts-3col">

        {{-- Product status donut --}}
        <div class="panel" style="margin-bottom:0">
            <div class="panel-title"><i class="ti ti-chart-donut" style="color:#4a3aa7"></i> Product status</div>
            <div class="ring-wrap">
                <div class="ch" style="height:120px;width:220px;flex-shrink:0">
                    <div id="donutChart"></div>
                </div>
                <div class="ring-legend">
                    <div class="ring-leg-item">
                        <span class="ring-leg-label"><span class="ring-leg-dot"
                                style="background:#1baf7a"></span>Approved</span>
                        <span class="ring-leg-val">{{ number_format($kpis['approved_products']) }}</span>
                    </div>
                    <div class="ring-leg-item">
                        <span class="ring-leg-label"><span class="ring-leg-dot"
                                style="background:#eda100"></span>Pending</span>
                        <span class="ring-leg-val">{{ $kpis['pending_products'] }}</span>
                    </div>
                    <div class="ring-leg-item">
                        <span class="ring-leg-label"><span class="ring-leg-dot"
                                style="background:#e34948"></span>Rejected</span>
                        <span class="ring-leg-val">{{ $kpis['rejected_products'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top vendors horizontal bar --}}
        <div class="panel" style="margin-bottom:0">
            <div class="panel-title"><i class="ti ti-chart-bar" style="color:#2a78d6"></i> Top vendors by products
            </div>
            <div class="ch">
                <div id="vendorBar"></div>
            </div>
        </div>

        {{-- Stock health --}}
        <div class="panel" style="margin-bottom:0">
            <div class="panel-title"><i class="ti ti-chart-donut" style="color:#eda100"></i> Stock health</div>
            @php
                $totalVariants = $kpis['total_variants'] ?: 1;
                $inStock = $totalVariants - $kpis['low_stock_count'] - $kpis['out_of_stock'];
                $inStockPct = round(($inStock / $totalVariants) * 100);
                $lowPct = round(($kpis['low_stock_count'] / $totalVariants) * 100, 1);
                $outPct = round(($kpis['out_of_stock'] / $totalVariants) * 100, 1);
            @endphp
            <div class="stat-big">{{ $inStockPct }}<span style="font-size:18px;color:#6c757d">%</span></div>
            <div class="stat-sub">variants in-stock</div>
            <div class="divider"></div>
            <div class="progress-list">
                <div>
                    <div class="prog-header"><span>In stock</span><span>{{ number_format($inStock) }}</span></div>
                    <div class="prog-bar">
                        <div class="prog-fill" style="width:{{ $inStockPct }}%;background:#1baf7a"></div>
                    </div>
                </div>
                <div>
                    <div class="prog-header"><span>Low stock</span><span>{{ $kpis['low_stock_count'] }}</span></div>
                    <div class="prog-bar">
                        <div class="prog-fill" style="width:{{ max($lowPct, 0.5) }}%;background:#eda100"></div>
                    </div>
                </div>
                <div>
                    <div class="prog-header"><span>Out of stock</span><span>{{ $kpis['out_of_stock'] }}</span></div>
                    <div class="prog-bar">
                        <div class="prog-fill"
                            style="width:{{ max($outPct, 0.2) }}%;background:#e34948;min-width:4px"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>

    {{-- ══════════════════════════════
         ROW: Monthly bar | Vendor approval grouped bar
    ══════════════════════════════ --}}
    <div class="charts-2col">

        <div class="panel" style="margin-bottom:0">
            <div class="panel-title">
                <i class="ti ti-chart-bar" style="color:#2a78d6"></i>
                Monthly school registrations
                <span class="title-right">Last 6 months</span>
            </div>
            <div class="ch">
                <div class="" id="schoolBar"></div>
            </div>
        </div>

        <div class="panel" style="margin-bottom:0">
            <div class="panel-title"><i class="ti ti-chart-area" style="color:#4a3aa7"></i> Products by Parent Category
            </div>
            <div class="ch" style="height:155px">
              <div id="parentCategoryChart"></div>
            </div>
        </div>

    </div>

    </div>

    <div class="sec-label">Inventory Overview</div>
    <div class="kpi-row">
    <div class="kpi-card">
        <div class="kpi-top">
            <span class="kpi-label">Total Stock</span>
            <span class="kpi-icon icon-violet"><i class="ti ti-box"></i></span>
        </div>
        <div class="kpi-value">{{ $inventorySummary['total_stock'] ?? 0 }}</div>
        <div class="kpi-sub text-mute">Units across all variants</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-top">
            <span class="kpi-label">Available</span>
            <span class="kpi-icon icon-teal"><i class="ti ti-circle-check"></i></span>
        </div>
        <div class="kpi-value">{{ $inventorySummary['available_stock'] ?? 0 }}</div>
        <div class="kpi-sub text-ok">Ready for sale</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-top">
            <span class="kpi-label">Reserved</span>
            <span class="kpi-icon icon-amber"><i class="ti ti-lock"></i></span>
        </div>
        <div class="kpi-value">{{ $inventorySummary['reserved_stock'] ?? 0 }}</div>
        <div class="kpi-sub text-warn">Allocated to orders</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-top">
            <span class="kpi-label">Low Stock</span>
            <span class="kpi-icon icon-amber"><i class="ti ti-alert-triangle"></i></span>
        </div>
        <div class="kpi-value">{{ $inventorySummary['low_stock_count'] ?? 0 }}</div>
        <div class="kpi-sub text-warn">Below threshold</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-top">
            <span class="kpi-label">Out of Stock</span>
            <span class="kpi-icon icon-red"><i class="ti ti-circle-x"></i></span>
        </div>
        <div class="kpi-value">{{ $inventorySummary['out_of_stock_count'] ?? 0 }}</div>
        <div class="kpi-sub text-err">Zero quantity</div>
    </div>
    </div>

    <div class="custom-card mb-4">
    <div class="panel-title">
        <i class="ti ti-chart-line" style="color:var(--c-blue)"></i>
        Product Upload Trend
    </div>
    <div id="productUploadChart"></div>
    </div>

    <div class="sec-label">Board distribution and recent activity</div>
    <div class="g2">

    <div class="custom-card">
        <div class="panel-title">
            <i class="ti ti-school" style="color:var(--c-blue)"></i>
            Active schools by board
        </div>
        <div id="boardStacked" class="apex-chart"></div>

        <div class="board-mini-grid">

            @foreach ($schoolBoards as $board => $count)
                @php
                    $color = $boardColors[$board] ?? $defaultColors[$loop->index % count($defaultColors)];
                @endphp

                <div class="board-mini">

                    <div class="bm-val" style="color:{{ $color }}">
                        {{ number_format($count) }}
                    </div>

                    <div class="bm-lbl">
                        {{ ucwords(str_replace('_', ' ', $board)) }}
                    </div>

                </div>
            @endforeach

        </div>

    </div>

        <div class="custom-card">
            <div class="panel-title">
                <i class="ti ti-activity" style="color:var(--c-green)"></i>
                Recent activity
                <span class="badge badge-green">Live</span>
            </div>
        <div class="activity-list" style="height: 400px;overflow:scroll;">
            @foreach ($recentActivity ?? [] as $act)
                <a href="{{ $act['url'] ?? '#' }}" class="act-row"
                    style="{{ $act['url'] ? 'text-decoration: none; color: inherit; display: flex;' : 'display: flex;' }}"
                    @if (!$act['url']) style="cursor: default;" @endif>
                    <div class="act-avatar" style="background:{{ $act['bg'] }};color:{{ $act['color'] }}">
                        <i class="ti {{ $act['icon'] }}"></i>
                    </div>
                    <div class="act-body">
                        <div class="act-name">{{ $act['name'] }}</div>
                        <div class="act-meta">{{ $act['meta'] }} &middot; {{ $act['time'] }}</div>
                    </div>
                    <span class="act-badge {{ $act['badge_class'] }}"
                        style="background:{{ $act['bg'] }};color:{{ $act['color'] }}">
                        {{ $act['badge'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

</div>

</div>

@push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ────────────────────────────────────
                  1. REGISTRATION TREND — area line
               ──────────────────────────────────── */

            ChartHelper.line({
                id: "registrationTrend",

                categories: @json($trends['labels']),

                series: [
                    ChartHelper.series("Schools", @json($trends['schools']), ChartHelper.colors
                        .blue),
                    ChartHelper.series("Vendors", @json($trends['vendors']), ChartHelper.colors
                        .green),
                    ChartHelper.series("Web Users", @json($trends['webusers']), ChartHelper.colors
                        .primary)
                ]
            });

            ChartHelper.line({
                id: "productUploadChart",
                categories: @json($productUploadTrend['labels'] ?? []),
                series: [
                    ChartHelper.series("Products", @json($productUploadTrend['counts'] ?? []), ChartHelper.colors.blue)
                ]
            });



            /* ────────────────────────────────────
               2. PRODUCT STATUS — doughnut
            ──────────────────────────────────── */
            ChartHelper.donut({

                id: "donutChart",

                height: 200,

                labels: [
                    "Approved",
                    "Pending",
                    "Rejected"
                ],

                series: [
                    {{ $kpis['approved_products'] }},
                    {{ $kpis['pending_products'] }},
                    {{ $kpis['rejected_products'] }}
                ],

                colors: [
                    "#1baf7a",
                    "#eda100",
                    "#e34948"
                ],

                plotOptions: {

                    pie: {

                        donut: {

                            size: "72%",

                            labels: {

                                show: true,

                                total: {

                                    show: true,

                                    label: "Products",

                                    formatter: function(w) {

                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);

                                    }

                                }

                            }

                        }

                    }

                },

                stroke: {

                    width: 3,

                    colors: ["#fff"]

                },

                legend: {

                    show: false

                },

                tooltip: {

                    y: {

                        formatter: function(val) {

                            return val + " Products";

                        }

                    }

                }

            });

            /* ────────────────────────────────────
               3. TOP VENDORS — horizontal bar
               Replace $topVendors with your controller variable:
               e.g. $topVendors = Vendor::withCount('products')->orderByDesc('products_count')->take(5)->get();
            ──────────────────────────────────── */
            ChartHelper.bar({

                id: "vendorBar",

                height: 180,

                categories: @json($topVendors->pluck('business_name')),

                series: [
                    ChartHelper.series(
                        "Products",
                        @json($topVendors->pluck('products_count')),
                        ChartHelper.colors.blue
                    )
                ],

                colors: [
                    "rgba(42,120,214,.85)"
                ],

                chart: {
                    stacked: false
                },

                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 8,
                        borderRadiusApplication: "end",
                        barHeight: "55%",
                        distributed: false
                    }
                },

                grid: {
                    borderColor: "#edf2f7",
                    strokeDashArray: 3
                },

                legend: {
                    show: false
                },

                dataLabels: {
                    enabled: true,
                    offsetX: 15,
                    style: {
                        fontSize: "11px",
                        fontWeight: 600
                    }
                },

                stroke: {
                    width: 0
                },

                xaxis: {
                    labels: {
                        style: {
                            fontSize: "11px",
                            colors: "#64748b"
                        }
                    }
                },

                yaxis: {
                    labels: {
                        style: {
                            fontSize: "12px",
                            colors: "#334155",
                            fontWeight: 500
                        }
                    }
                },

                tooltip: {

                    y: {

                        formatter: function(value) {
                            return value + " Products";
                        }

                    }

                }

            });

            /* ────────────────────────────────────
               4. MONTHLY SCHOOL REGISTRATIONS — column bar
               $trends['school_monthly']  → last 6 months count array
               $trends['school_labels']   → last 6 month name labels
            ──────────────────────────────────── */
            ChartHelper.bar({

                id: "schoolBar",

                height: 300,

                categories: @json($trends['school_labels'] ?? array_slice($trends['labels'], -6)),

                series: [
                    ChartHelper.series(
                        "Schools",
                        @json($trends['school_monthly'] ?? array_slice($trends['schools'], -6)),
                        ChartHelper.colors.blue
                    )
                ],

                colors: [
                    "#2A78D6"
                ],

                chart: {
                    stacked: false
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 8,
                        borderRadiusApplication: "end",
                        columnWidth: "45%",
                        distributed: false
                    }
                },

                grid: {
                    borderColor: "#edf2f7",
                    strokeDashArray: 3
                },

                stroke: {
                    width: 0
                },

                dataLabels: {
                    enabled: true,
                    offsetY: -20,
                    style: {
                        fontSize: "11px",
                        fontWeight: 600
                    }
                },

                legend: {
                    show: false
                },

                xaxis: {

                    labels: {
                        style: {
                            fontSize: "11px",
                            colors: "#64748b"
                        }
                    },

                    axisBorder: {
                        show: false
                    },

                    axisTicks: {
                        show: false
                    }

                },

                yaxis: {

                    labels: {
                        style: {
                            fontSize: "11px",
                            colors: "#64748b"
                        }
                    }

                },

                tooltip: {

                    y: {

                        formatter: function(value) {
                            return value + " Schools";
                        }

                    }

                }

            });

            /* ────────────────────────────────────
               5. PRODUCT DISTRIBUTION — Parent Category & Category
            ──────────────────────────────────── */
            ChartHelper.bar({
                id: "parentCategoryChart",
                height: 300,
                categories: @json(array_column($parentCategoryCounts ?? [], 'name')),
                series: [
                    ChartHelper.series(
                        "Products",
                        @json(array_column($parentCategoryCounts ?? [], 'product_count')),
                        ChartHelper.colors.blue
                    )
                ],
                colors: ["#2A78D6"],
                chart: { stacked: false },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 6
                    }
                },
                grid: { borderColor: "#edf2f7", strokeDashArray: 3 },
                legend: { show: false },
                tooltip: { y: { formatter: function(val) { return val + " Products"; } } }
            });

            ChartHelper.bar({
                id: "categoryChart",
                height: 300,
                categories: @json(array_column($categoryCounts ?? [], 'category_name')),
                series: [
                    ChartHelper.series(
                        "Products",
                        @json(array_column($categoryCounts ?? [], 'product_count')),
                        ChartHelper.colors.green
                    )
                ],
                colors: ["#1baf7a"],
                chart: { stacked: false },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 6,
                        columnWidth: "50%"
                    }
                },
                grid: { borderColor: "#edf2f7", strokeDashArray: 3 },
                legend: { show: false },
                tooltip: { y: { formatter: function(val) { return val + " Products"; } } }
            });



            /* ────────────────────────────────────
               6. SCHOOLS BY BOARD — stacked horizontal bar
               $schoolBoards = ['CBSE'=>52,'ICSE'=>38,'State'=>35,'IB'=>17]
               Pass this from your controller.
            ──────────────────────────────────── */
            ChartHelper.bar({

                id: "boardStacked",

              

                categories: @json(array_map(fn($board) => ucwords($board), array_keys($schoolBoards))),

                series: [
                    ChartHelper.series(
                        "Schools",
                        @json(array_values($schoolBoards)),
                        ChartHelper.colors.blue
                    )
                ],

                legend: {
                    show: false
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 6
                    }
                }

            });
        });
    </script>
@endpush
