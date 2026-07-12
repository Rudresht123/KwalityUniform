

<div class="g-root">

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
                <span class="kpi-icon icon-blue"><i class="ti ti-shopping-cart"></i></span>
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
                <span class="kpi-icon icon-gray"><i class="ti ti-user"></i></span>
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

    {{-- ══════════════════════════════
         MAIN GRID: charts (left) + at-a-glance sidebar (right)
    ══════════════════════════════ --}}
    <div class="section-label">Financial &amp; order trends</div>
    <div class="g-main-grid">

        {{-- LEFT: primary charts --}}
        <div class="g-main-col">

            <div class="charts-2col">
                <div class="panel">
                    <div class="panel-title">
                        <i class="ti ti-currency-dollar" style="color:var(--green)"></i>
                        Revenue Trend
                        <span class="title-right">Last 30 days</span>
                    </div>
                    <div class="ch">
                        <div id="revenueTrend"></div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-title">
                        <i class="ti ti-shopping-cart" style="color:var(--primary)"></i>
                        Orders Trend
                        <span class="title-right">Last 30 days</span>
                    </div>
                    <div class="ch">
                        <div id="orderTrend"></div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-chart-line" style="color:var(--primary)"></i>
                    Schools, vendors and web users
                    <span class="title-right">{{ now()->subYear()->format('M Y') }} – {{ now()->format('M Y') }}</span>
                </div>
                <div class="ch">
                    <div id="registrationTrend" class="apex-chart"></div>
                </div>
            </div>

            <div class="charts-2col">
                <div class="panel" style="margin-bottom:0">
                    <div class="panel-title">
                        <i class="ti ti-chart-bar" style="color:var(--primary)"></i>
                        Monthly school registrations
                        <span class="title-right">Last 6 months</span>
                    </div>
                    <div class="ch">
                        <div id="schoolBar"></div>
                    </div>
                </div>

                <div class="panel" style="margin-bottom:0">
                    <div class="panel-title">
                        <i class="ti ti-chart-area" style="color:var(--violet)"></i>
                        Products by parent category
                    </div>
                    <div class="ch" style="height:155px">
                        <div id="parentCategoryChart"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT: at-a-glance status sidebar --}}
        <div class="g-side-col">

            <div class="panel">
                <div class="panel-title"><i class="ti ti-chart-donut" style="color:var(--violet)"></i> Product status</div>
                <div class="ring-wrap">
                    <div class="ch" style="height:120px;width:100%;flex-shrink:0">
                        <div id="donutChart"></div>
                    </div>
                </div>
                <div class="ring-legend" style="margin-top:10px">
                    <div class="ring-leg-item">
                        <span class="ring-leg-label"><span class="ring-leg-dot" style="background:var(--green)"></span>Approved</span>
                        <span class="ring-leg-val">{{ number_format($kpis['approved_products']) }}</span>
                    </div>
                    <div class="ring-leg-item">
                        <span class="ring-leg-label"><span class="ring-leg-dot" style="background:var(--amber)"></span>Pending</span>
                        <span class="ring-leg-val">{{ $kpis['pending_products'] }}</span>
                    </div>
                    <div class="ring-leg-item">
                        <span class="ring-leg-label"><span class="ring-leg-dot" style="background:var(--red)"></span>Rejected</span>
                        <span class="ring-leg-val">{{ $kpis['rejected_products'] }}</span>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-title"><i class="ti ti-chart-donut" style="color:var(--amber)"></i> Stock health</div>
                @php
                    $totalVariants = $kpis['total_variants'] ?: 1;
                    $inStock = $totalVariants - $kpis['low_stock_count'] - $kpis['out_of_stock'];
                    $inStockPct = round(($inStock / $totalVariants) * 100);
                    $lowPct = round(($kpis['low_stock_count'] / $totalVariants) * 100, 1);
                    $outPct = round(($kpis['out_of_stock'] / $totalVariants) * 100, 1);
                @endphp
                <div class="stat-big">{{ $inStockPct }}<span style="font-size:18px;color:var(--ink-faint)">%</span></div>
                <div class="stat-sub">variants in-stock</div>
                <div class="divider"></div>
                <div class="progress-list">
                    <div>
                        <div class="prog-header"><span>In stock</span><span>{{ number_format($inStock) }}</span></div>
                        <div class="prog-bar">
                            <div class="prog-fill" style="width:{{ $inStockPct }}%;background:var(--green)"></div>
                        </div>
                    </div>
                    <div>
                        <div class="prog-header"><span>Low stock</span><span>{{ $kpis['low_stock_count'] }}</span></div>
                        <div class="prog-bar">
                            <div class="prog-fill" style="width:{{ max($lowPct, 0.5) }}%;background:var(--amber)"></div>
                        </div>
                    </div>
                    <div>
                        <div class="prog-header"><span>Out of stock</span><span>{{ $kpis['out_of_stock'] }}</span></div>
                        <div class="prog-bar">
                            <div class="prog-fill" style="width:{{ max($outPct, 0.2) }}%;background:var(--red);min-width:4px"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-activity" style="color:var(--green)"></i>
                    Recent activity
                    <span class="badge badge-green">Live</span>
                </div>
                <div class="activity-list" style="max-height:360px;overflow:auto;">
                    @foreach ($recentActivity ?? [] as $act)
                        <a href="{{ $act['url'] ?? '#' }}" class="act-row"
                            style="{{ $act['url'] ? 'text-decoration: none; color: inherit;' : 'cursor:default;' }}">
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

    {{-- ══════════════════════════════
         INVENTORY / UPLOAD TREND
    ══════════════════════════════ --}}
    <div class="section-label">Inventory overview</div>
    <div class="panel">
        <div class="panel-title">
            <i class="ti ti-chart-line" style="color:var(--primary)"></i>
            Product Upload Trend
        </div>
        <div id="productUploadChart"></div>
    </div>

    {{-- ══════════════════════════════
         BOARD DISTRIBUTION + VENDORS
    ══════════════════════════════ --}}
    <div class="section-label">Board distribution &amp; vendors</div>
    <div class="g2">

        <div class="panel">
            <div class="panel-title">
                <i class="ti ti-school" style="color:var(--primary)"></i>
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

        <div class="panel">
            <div class="panel-title"><i class="ti ti-chart-bar" style="color:var(--primary)"></i> Top vendors by products</div>
            <div class="ch">
                <div id="vendorBar"></div>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════
         OPERATIONS
    ══════════════════════════════ --}}
    <div class="section-label">Operations</div>
    <div class="charts-3col">
        {{-- Latest Orders --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-shopping-cart" style="color:var(--primary)"></i> Latest Orders</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latest_orders ?? [] as $order)
                            <tr>
                                <td class="mono">#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'Guest' }}</td>
                                <td>₹{{ number_format($order->grand_total, 2) }}</td>
                                <td><span class="act-badge badge-green">{{ $order->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pending Approvals --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-clock" style="color:var(--amber)"></i> Pending Approvals</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Vendor</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pending_approvals ?? [] as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->vendor->business_name ?? 'Unknown' }}</td>
                                <td>₹{{ number_format($product->price, 2) }}</td>
                                <td><a href="#" class="btn-xs btn-primary">Review</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Vendors --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-users" style="color:var(--teal)"></i> Recent Vendors</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>Contact</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_vendors ?? [] as $vendor)
                            <tr>
                                <td>{{ $vendor->business_name }}</td>
                                <td>{{ $vendor->phone }}</td>
                                <td><span class="badge badge-sm">{{ $vendor->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Return Requests --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-replace" style="color:var(--red)"></i> Return Requests</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Return ID</th>
                            <th>Order ID</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($return_requests ?? [] as $return)
                            <tr>
                                <td class="mono">#{{ $return->id }}</td>
                                <td class="mono">#{{ $return->order_id }}</td>
                                <td>{{ Str::limit($return->reason, 20) }}</td>
                                <td><span class="badge badge-sm">{{ $return->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Low Stock Products --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-alert-triangle" style="color:var(--amber)"></i> Low Stock Alerts</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Variant</th>
                            <th>Product</th>
                            <th>Stock</th>
                            <th>Threshold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventory_alerts ?? [] as $variant)
                            <tr>
                                <td class="mono">{{ $variant->sku }}</td>
                                <td>{{ $variant->product->name ?? 'Unknown' }}</td>
                                <td class="text-err">{{ $variant->stock_qty }}</td>
                                <td>{{ $variant->low_stock_alert }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Support Tickets --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-ticket" style="color:var(--ink-soft)"></i> Support Tickets</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($support_tickets ?? [] as $ticket)
                            <tr>
                                <td>{{ $ticket->user->name ?? 'Guest' }}</td>
                                <td>{{ Str::limit($ticket->subject, 20) }}</td>
                                <td>{{ $ticket->created_at->format('d M') }}</td>
                                <td><span class="badge badge-sm">{{ $ticket->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════
         SYSTEM HEALTH & INSIGHTS
    ══════════════════════════════ --}}
    <div class="section-label">System Health &amp; Insights</div>
    <div class="charts-3col">
        {{-- Top Selling Products --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-trending-up" style="color:var(--green)"></i> Top Selling Products</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Units Sold</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($top_selling_products ?? [] as $product)
                            <tr>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ $product['total_sold'] }}</td>
                                <td>-</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Schools --}}
        {{-- <div class="panel">
            <div class="panel-title"><i class="ti ti-school" style="color:var(--primary)"></i> Top Schools</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>School</th>
                            <th>Orders</th>
                            <th>Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_schools ?? [] as $school)
                            <tr>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->orders_count ?? 0 }}</td>
                                <td>{{ $school->students_count ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}

        {{-- Top Vendors --}}
        <div class="panel">
            <div class="panel-title"><i class="ti ti-award" style="color:var(--teal)"></i> Top Vendors</div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Vendor</th>
                            <th>Products</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topVendors ?? [] as $vendor)
                            <tr>
                                <td>{{ $vendor->business_name }}</td>
                                <td>{{ $vendor->products_count }}</td>
                                <td>{{ $vendor->total_revenue ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                id: "revenueTrend",
                categories: @json($revenue_trend['labels'] ?? []),
                series: [
                    ChartHelper.series("Revenue", @json($revenue_trend['values'] ?? []), ChartHelper.colors.green)
                ]
            });

            ChartHelper.line({
                id: "orderTrend",
                categories: @json($order_trend['labels'] ?? []),
                series: [
                    ChartHelper.series("Orders", @json($order_trend['values'] ?? []), ChartHelper.colors.blue)
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
                    "#158f63",
                    "#dc8a00",
                    "#d64545"
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
            ──────────────────────────────────── */
            ChartHelper.bar({

                id: "vendorBar",

                height: 220,

                categories: @json($topVendors->pluck('business_name')),

                series: [
                    ChartHelper.series(
                        "Products",
                        @json($topVendors->pluck('products_count')),
                        ChartHelper.colors.blue
                    )
                ],

                colors: [
                    "rgba(67,56,202,.85)"
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
                    borderColor: "#edeef7",
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
                            colors: "#6b6b85"
                        }
                    }
                },

                yaxis: {
                    labels: {
                        style: {
                            fontSize: "12px",
                            colors: "#1a1a2e",
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
                    "#4338CA"
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
                    borderColor: "#edeef7",
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
                            colors: "#6b6b85"
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },

                yaxis: {
                    labels: {
                        style: {
                            fontSize: "11px",
                            colors: "#6b6b85"
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
                colors: ["#4338CA"],
                chart: { stacked: false },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 6
                    }
                },
                grid: { borderColor: "#edeef7", strokeDashArray: 3 },
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
                colors: ["#158f63"],
                chart: { stacked: false },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 6,
                        columnWidth: "50%"
                    }
                },
                grid: { borderColor: "#edeef7", strokeDashArray: 3 },
                legend: { show: false },
                tooltip: { y: { formatter: function(val) { return val + " Products"; } } }
            });

            /* ────────────────────────────────────
               6. SCHOOLS BY BOARD — stacked horizontal bar
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