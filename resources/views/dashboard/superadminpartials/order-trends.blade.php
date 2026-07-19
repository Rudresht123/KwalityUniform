<div class="section-label">Business Performance</div>

<div class="row">
    <div class="panel col-md-8">
    <div class="panel-header">
        <h3 class="panel-title">
            <i class="ti ti-chart-line" style="color:var(--primary)"></i>
            Order &amp; Sales Trend
        </h3>

        <select id="order-trend-filter" class="panel-select">
            <option value="week" selected>Last Week</option>
            <option value="month" >Last Month</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div >
        <div id="order_trend" class="data-content"></div>
    </div>
</div>
<!-- Product Status -->
 <div class="col-lg-4">
    <div class="panel">

        <div class="panel-header">
            <h3 class="panel-title">
                <i class="ti ti-chart-donut" style="color:var(--violet)"></i>
                Product Status
            </h3>

            <span class="badge bg-light text-dark">
                Total {{ number_format($kpis['total_products']) }}
            </span>
        </div>

        <div class="text-center py-3">
            <div id="donutChart" style="height:300px;"></div>
        </div>

        <div class="row g-3 mt-2">

            <div class="col-4">
                <div class="status-card success">
                    <div class="status-value">
                        {{ number_format($kpis['approved_products']) }}
                    </div>
                    <div class="status-label">
                        <span class="status-dot"></span>
                        Approved
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="status-card warning">
                    <div class="status-value">
                        {{ number_format($kpis['pending_products']) }}
                    </div>
                    <div class="status-label">
                        <span class="status-dot"></span>
                        Pending
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="status-card danger">
                    <div class="status-value">
                        {{ number_format($kpis['rejected_products']) }}
                    </div>
                    <div class="status-label">
                        <span class="status-dot"></span>
                        Rejected
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initial chart load
        loadOrderTrend("week");

        // Reload chart when filter changes
        document.getElementById('order-trend-filter')
            .addEventListener('change', function() {
                loadOrderTrend(this.value);
            });
    });

    /**
     * Fetch Order Trend
     */
    async function loadOrderTrend(filter = 'week') {
        try {
            const url = `{{ route('ajax.vendor.order-trend') }}?filter=${filter}`;
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            renderOrderTrendChart(data);
        } catch (error) {
            console.error('Error fetching order trend:', error);
        }
    }

    /**
     * Render Order Trend Chart
     */
    function renderOrderTrendChart(data) {
        ChartHelper.area({
            id: 'order_trend',
            height: 400,
            categories: data.labels,
            series: [
                ChartHelper.series(
                    'Orders',
                    data.data,
                    ChartHelper.colors.primary
                )
            ],
            stroke: { width: 3 },
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 0.35, opacityFrom: 0.35, opacityTo: 0.05, stops: [0, 100] }
            },
            markers: { size: 4, hover: { size: 6 } },
            xaxis: { title: { text: 'Date' } },
            yaxis: { title: { text: 'Orders' }, min: 0 },
            tooltip: {
                y: {
                    formatter(value) {
                        return `${value} Orders`;
                    }
                }
            }
        });
    }
</script>
