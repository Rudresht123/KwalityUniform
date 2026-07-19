<div class="section-label">Business Performance</div>

<div class="panel">
    <div class="panel-header">
        <h3 class="panel-title">
            <i class="ti ti-chart-line" style="color:var(--primary)"></i>
            Revenue &amp; Sales Trend
        </h3>

        <select id="revenu-trend-filter" class="panel-select">
            <option value="week" selected>Last Week</option>
            <option value="month">Last Month</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div>
        <div id="revenu_trend" class="data-content"></div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {

    loadRevenueTrend('week');

    document
        .getElementById('revenu-trend-filter')
        .addEventListener('change', function () {

            loadRevenueTrend(this.value);

        });

});
    /**
     * Fetch Order Trend
     */
    async function loadRevenueTrend(filter = 'week') {

    const url = `{{ route('ajax.vendor.revenu-trend') }}?filter=${filter}`;

    const response = await fetch(url);

    const data = await response.json();

    renderRevenueTrendChart(data);
}



    /**
     * Render Order Trend Chart
     */
    function renderRevenueTrendChart(data) {

        ChartHelper.area({

            id: 'revenu_trend',

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
