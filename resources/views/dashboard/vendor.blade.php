@php
    $breadcrumb = 'Vendor Dashboard';
    $title = 'Vendor Business Overview';
@endphp

<style>
    /* Mirroring Super Admin Dashboard Styles for Consistency */
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

    .charts-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    @media (max-width: 992px) {
        .charts-2col {
            grid-template-columns: 1fr;
        }
    }

    .act-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .act-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .act-body {
        flex-grow: 1;
    }

    .act-name {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
    }

    .act-meta {
        font-size: 11px;
        color: #6c757d;
    }

    .act-badge {
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
    }
</style>

<div class="g-root">
    @if (!$vendor)
        <div class="alert alert-warning border-0 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle fs-2 me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Account Configuration Incomplete</h6>
                    <p class="mb-0 small">Your user account is not yet linked to a vendor profile. Please contact the
                        system administrator.</p>
                </div>
            </div>
        </div>
    @else
        {{-- ══════════════════════════════
             WELCOME BANNER
        ══════════════════════════════ --}}
        <div class="card custom-card shadow-sm border-0 bg-primary text-white mb-4 overflow-hidden"
            style="background: linear-gradient(135deg, #2a78d6 0%, #4a3aa7 100%) !important;">
            <div class="card-body p-4 position-relative">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-1">Welcome, {{ $vendor->business_name }}!</h3>
                        <p class="mb-0 text-white-50">Monitor your product approvals, stock levels, and business growth.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fs-14 fw-bold shadow-sm">
                            <i class="ti ti-calendar-event me-1"></i> {{ now()->format('l, d M Y') }}
                        </span>
                    </div>
                </div>
                <div class="position-absolute end-0 bottom-0 opacity-10 mb-n4 me-n4">

                </div>
            </div>
        </div>

        {{-- ══════════════════════════════
             KPI TILES
        ══════════════════════════════ --}}
        <div class="section-label">Business Metrics</div>
        <div class="kpi-row">
            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Total Products</span>
                    <span class="kpi-icon icon-violet"><i class="ti ti-package"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['total_products'] }}</div>
                <div class="kpi-sub text-mute">All catalog items</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Approved</span>
                    <span class="kpi-icon icon-teal"><i class="ti ti-circle-check"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['approved_products'] }}</div>
                <div class="kpi-sub text-ok">Live on platform</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Pending</span>
                    <span class="kpi-icon icon-amber"><i class="ti ti-clock"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['pending_products'] }}</div>
                <div class="kpi-sub text-warn">Awaiting review</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Rejected</span>
                    <span class="kpi-icon icon-red"><i class="ti ti-circle-x"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['rejected_products'] }}</div>
                <div class="kpi-sub text-err">Action required</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Low Stock</span>
                    <span class="kpi-icon icon-amber"><i class="ti ti-alert-triangle"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['low_stock_count'] }}</div>
                <div class="kpi-sub text-warn">Refill needed</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Out of Stock</span>
                    <span class="kpi-icon icon-red"><i class="ti ti-circle-x"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['out_of_stock'] }}</div>
                <div class="kpi-sub text-err">Immediate action</div>
            </div>
        </div>



        {{-- Groth and trend sections --}}
        <div class="section-label">Growth & Trends</div>
        <div class="panel mb-4">
            <div class="panel-title">
                <i class="ti ti-chart-line" style="color:#6259ca"></i>
                Product Submission & Approval Trend
            </div>
            <div id="vendorProductChart"></div>
        </div>

        {{-- Product trend sections --}}
                <div class="section-label">Product Upload ans Inventory Trends</div>
        <div class="charts-2col">
        <div class="panel ">
            <div class="panel-title">
                <i class="ti ti-chart-line" style="color:#2a78d6"></i>
                Product Upload Trend
            </div>
            <div id="vendorProductUploadChart"></div>
        </div>
        

        <div class="panel" >
            <div class="panel-title">
                <i class="ti ti-chart-donut" style="color:#6259ca"></i>
                Inventory Distribution
            </div>
            <div id="vendorInventoryChart"></div>
            <div class="text-center mt-3">
                <span class="fw-bold" style="font-size: 18px;">Total Stock: {{ $inventorySummary['total_stock_qty'] ?? 0 }}</span>
            </div>
        </div>
    </div>


        <div class="section-label">Product Distribution</div>
        <div class="charts-2col">
            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-chart-bar" style="color:#2a78d6"></i>
                    By Parent Category
                </div>
                <div id="vendorParentCategoryChart"></div>
            </div>
            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-chart-bar" style="color:#1baf7a"></i>
                    By Category
                </div>
                <div id="vendorCategoryChart"></div>
            </div>
        </div>

        <div class="charts-2col">
            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-alert-triangle" style="color:#eda100"></i>
                    Critical Inventory Alerts
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr class="text-muted" style="font-size: 11px; text-transform: uppercase;">
                                <th>Product</th>
                                <th>Variant</th>
                                <th class="text-end">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventory_alerts as $alert)
                                <tr>
                                    <td class="fw-semibold" style="font-size: 13px;">
                                        {{ $alert->product->product_name }}</td>
                                    <td style="font-size: 12px;">
                                        {{ $alert->product->variants->first()->product_code ?? 'N/A' }}</td>
                                    <td class="text-end">
                                        <span class="badge {{ $alert->stock_qty == 0 ? 'bg-danger' : 'bg-warning' }}"
                                            style="font-size: 10px;">
                                            {{ $alert->stock_qty }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted small">No critical alerts at
                                        this time.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-bell" style="color:#f59e0b"></i>
                    Notifications
                </div>
                <div class="notification-list" style="max-height:400px;overflow:scroll;">
                    @forelse($notifications ?? [] as $note)
                        <div class="act-row">
                            <div class="act-avatar" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                                <i class="ti ti-bell"></i>
                            </div>
                            <div class="act-body">
                                <div class="act-name">{{ $note['description'] }}</div>
                                <div class="act-meta">
                                    {{ \Carbon\Carbon::parse($note['created_at'])->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted small">No notifications at this time.</div>
                    @endforelse
                </div>
            </div>

            {{-- ══════════════════════════════
                 RECENT ACTIVITY
            ══════════════════════════════ --}}
            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-activity" style="color:#1baf7a"></i>
                    Recent Activity
                </div>
                <div class="activity-list" style="max-height:400px;overflow:scroll;">
                    @forelse($recentActivity as $act)
                        <div class="act-row">
                            <div class="act-avatar"
                                style="background:{{ $act['bg'] }};color:{{ $act['color'] }}">
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
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted small">No recent activities found.</div>
                    @endforelse
                </div>
            </div>
        </div>
</div>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($productTrends ?? ['labels' => [], 'submitted' => [], 'approved' => []]);

        const options = {
            series: [{
                name: 'Submitted',
                data: chartData.submitted
            }, {
                name: 'Approved',
                data: chartData.approved
            }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                fontFamily: 'inherit'
            },
            colors: ['#6259ca', '#1baf7a'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: chartData.labels,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: '#6c757d',
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#6c757d',
                        fontSize: '12px'
                    }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
                padding: {
                    left: 0,
                    right: 0
                }
            },
            tooltip: {
                x: {
                    format: 'dd MMM'
                },
                theme: 'light'
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontSize: '12px',
                markers: {
                    radius: 12
                }
            }
        };

        const chart = new ApexCharts(document.querySelector('#vendorProductChart'), options);
        chart.render();

        // --- Product Upload Trend ---
        const uploadTrendData = @json($productUploadTrend ?? ['labels' => [], 'counts' => []]);
        if (uploadTrendData.labels.length > 0) {
            new ApexCharts(document.querySelector('#vendorProductUploadChart'), {
                chart: { type: 'line', height: 300, toolbar: { show: false }, zoom: { enabled: false } },
                series: [{ name: 'Uploads', data: uploadTrendData.counts }],
                xaxis: { categories: uploadTrendData.labels },
                colors: ['#2a78d6'],
                stroke: { curve: 'smooth', width: 3 },
                markers: { size: 4 },
                dataLabels: { enabled: false },
                tooltip: { theme: 'light' }
            }).render();
        }

        // --- Inventory Distribution Doughnut ---
        const invSummary = @json($inventorySummary ?? []);
        if (invSummary) {
            new ApexCharts(document.querySelector('#vendorInventoryChart'), {
                chart: { type: 'donut', height: 300 },
                series: [
                    {{ $inventorySummary['healthy_stock_count'] ?? 0 }},
                    {{ $inventorySummary['low_stock_count'] ?? 0 }},
                    {{ $inventorySummary['out_of_stock_count'] ?? 0 }}
                ],
                labels: ['Healthy', 'Low Stock', 'Out of Stock'],
                colors: ['#22c55e', '#fb923c', '#ef4444'],
                legend: { position: 'bottom' },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Items',
                                    formatter: function() {
                                        return "{{ $inventorySummary['total_stock_qty'] ?? 0 }}";
                                    }
                                }
                            }
                        }
                    }
                }
            }).render();
        }

        // --- Parent Category Distribution ---
        const parentCatData = @json($parentCategoryCounts ?? []);
        if (parentCatData.length > 0) {
            new ApexCharts(document.querySelector('#vendorParentCategoryChart'), {
                chart: { type: 'bar', height: 300, toolbar: { show: false } },
                series: [{ name: 'Products', data: parentCatData.map(i => i.product_count) }],
                xaxis: { categories: parentCatData.map(i => i.name) },
                colors: ['#2a78d6'],
                plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
                dataLabels: { enabled: false },
                tooltip: { y: { formatter: (val) => val + " Products" } }
            }).render();
        }

        // --- Category Distribution ---
        const catData = @json($categoryCounts ?? []);
        if (catData.length > 0) {
            new ApexCharts(document.querySelector('#vendorCategoryChart'), {
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Products',
                    data: catData.map(i => i.product_count)
                }],
                xaxis: {
                    categories: catData.map(i => i.category_name)
                },
                colors: ['#1baf7a'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 4,
                        columnWidth: '60%'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    y: {
                        formatter: (val) => val + " Products"
                    }
                }
            }).render();
        }
    });
    ChartHelper.radialBar({

    id: "inventoryChart",

    height: 320,

    series: [
        {{ $inventorySummary['available_stock'] ?? 0 }},
        {{ $inventorySummary['reserved_stock'] ?? 0 }},
        {{ $inventorySummary['low_stock_count'] ?? 0 }},
        {{ $inventorySummary['out_of_stock_count'] ?? 0 }}
    ],

    labels: [
        "Available",
        "Reserved",
        "Low Stock",
        "Out of Stock"
    ],

    colors: [
        "#22c55e",
        "#f59e0b",
        "#fb923c",
        "#ef4444"
    ],

    plotOptions: {
        radialBar: {
            hollow: {
                size: "35%"
            },
            dataLabels: {
                total: {
                    show: true,
                    label: "Total",
                    formatter: function () {
                        return "{{ $inventorySummary['total_stock'] ?? 0 }}";
                    }
                }
            }
        }
    },

    legend: {
        show: true,
        position: "bottom"
    }

});
</script>
