<div class="section-label">Business Performance</div>

<div class="panel">
    <div class="panel-header">
        <h3 class="panel-title">
            <i class="ti ti-chart-line" style="color:var(--primary)"></i>
            Revenue &amp; Sales Trend
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

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Initial chart load from Blade
        renderOrderTrendChart( loadOrderTrend("week"));

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

        const url = `{{ route('ajax.vendor.revenu-trend') }}?filter=${filter}`;

        const response = await fetch(url);

        const data = await response.json();

        renderOrderTrendChart(data);
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

            stroke: {
                width: 3
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 0.35,
                    opacityFrom: 0.35,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },

            markers: {
                size: 4,
                hover: {
                    size: 6
                }
            },

            xaxis: {
                title: {
                    text: 'Date'
                }
            },

            yaxis: {
                title: {
                    text: 'Orders'
                },
                min: 0
            },

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
